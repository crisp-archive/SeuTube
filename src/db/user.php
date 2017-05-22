<?php
define("INNER_ACCESS","1");
include_once("db/config.php");

class st_user
{
	var $uid;
	var $username;
	var $password;
	var $email;
	var $pop;
	var $icon;
	var $video_per_page;
	var $score;
	var $reg_date;
	var $mb_name;
	var $mb_bio;
	var $mb_num;
	
	function st_user($uid,$username,$password)
	{
		$this->uid=$uid;
		$this->username=$username;
		$this->password=$password;
	}
	
	function get_user_info_by_name()
	{
		$sql="select * from st_user where username='$this->username'";
		$result=mysql_query($sql);
		if(!$result)
			return 1;
		else
		{
			$row=mysql_fetch_array($result);
			if($row)
			{
				$this->uid=$row['uid'];
				$this->username=$row['username'];
				$this->email=$row['email'];
				$this->pop=$row['pop'];
				$this->icon=$row['icon'];
				$this->video_per_page=$row['video_per_page'];
				$this->score=$row['score'];
				$this->reg_date=$row['reg_date'];
				$this->mb_name=$row['mb_name'];
				$this->mb_bio=$row['mb_bio'];
				$this->mb_num=$row['mb_num'];
				return 0;
			}
			else
				return 2;
		}
	}
	
	function get_user_info_by_id()
	{
		$sql="select * from st_user where uid=$this->uid";
		$result=mysql_query($sql);
		if(!$result)
			return 1;
		else
		{
			$row=mysql_fetch_array($result);
			if($row)
			{
				$this->uid=$row['uid'];
				$this->username=$row['username'];
				$this->email=$row['email'];
				$this->pop=$row['pop'];
				$this->icon=$row['icon'];
				$this->video_per_page=$row['video_per_page'];
				$this->score=$row['score'];
				$this->reg_date=$row['reg_date'];
				$this->mb_name=$row['mb_name'];
				$this->mb_bio=$row['mb_bio'];
				$this->mb_num=$row['mb_num'];
				return 0;
			}
			else
				return 2;
		}
	}
	
	function check_status()
	{
		$sql="select * from st_user where username='$this->username'";
		$result=mysql_query($sql);
		if(!$result)
		{
			return false;
		}
		$row=mysql_fetch_array($result);
		if($row)
		{
			$pw=$row['password'];
			if($pw==$this->password)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	function is_name_exist()
	{
		$sql = "select count(*) from st_user where username='$this->username'";
		$result = mysql_query($sql); 
		if ($row = mysql_fetch_array($result))
		{ 
			if($row["count(*)"] == 0)
				return true;
			else
				return false;
		}
		return false;
	}
	
	function register_user()
	{
		$this->mb_name="$this->username";
		$this->mb_bio="什么都没有";
		$sql = "insert into st_user values(0,'$this->username','$this->password','$this->email',0,'/images/a.jpg',10,50,null,'$this->mb_name','$this->mb_bio',10)";
		$result = mysql_query($sql);
		if ($result == 1)
		{
			$this->get_user_info_by_name();
			$sql= "insert into st_recent values(0,$this->uid,0,0,0,0,0,0,0,0,0,0)";
			$result=mysql_query($sql);
			if($result==1)
				return true;
			else
				return false;
		}
		else
			return false;
	}
	
	function update_user_info()
	{
		$sql="update st_user set password='$this->password',email='$this->email',icon='$this->icon',video_per_page=$this->video_per_page,mb_name='$this->mb_name',mb_bio='$this->mb_bio',mb_num=$this->mb_num where uid=$this->uid";
		$result=mysql_query($sql);
		if ($result == 1)
		{
			return true;
		}
		else
			return false;
	}
	
	function login()
	{
		if($this->check_status())
		{
			$this->get_user_info_by_name();
			setcookie("uid",$this->uid,time()+60*60*24*30);
			setcookie("username",$this->username,time()+60*60*24*30);
			setcookie("password",$this->password,time()+60*60*24*30);
			return true;
		}
		else
			return false;
	}
	
	function logoff()
	{
		setcookie("username","",0);
		setcookie("password","",0);
		setcookie("uid","",0);
	}
	
};
?>