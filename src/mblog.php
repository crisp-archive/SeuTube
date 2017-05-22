<?php
define("INNER_ACCESS","1");
include_once("db/config.php");
include_once("db/user.php");
class st_mblog
{
	var $uid;
	var $username;
	var $mb_name;
	var $mb_bio;
	var $mb_num;
	var $icon;
	
	function st_mblog($uid)
	{
		$this->uid=$uid;
	}
	
	function get_mb_info()
	{
		$su=new st_user($this->uid,"","");
		$su->get_user_info_by_id();
		$this->username=$su->username;
		$this->mb_name=$su->mb_name;
		$this->mb_bio=$su->mb_bio;
		$this->mb_num=$su->mb_num;
		$this->icon=$su->icon;
	}
	
	function get_post_num()
	{
		$sql="select count(*) from st_mblog where uid=$this->uid";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		return $row['count(*)'];
	}
	
	function get_broadcast_num()
	{
		$sql="select count(*) from st_mblog where uid=$this->uid or uid in(select fuid from st_friends where uid=$this->uid)";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		return $row['count(*)'];
	}
	
	function get_listener_num()
	{
		$sql="select count(*) from st_friends where fuid=$this->uid";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		return $row['count(*)'];
	}
	
	function get_listened_num()
	{
		$sql="select count(*) from st_friends where uid=$this->uid";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		return $row['count(*)'];
	}
	
	function is_friends($uid,$fuid)
	{
		$sql="select * from st_friends where uid=$uid and fuid=$fuid";
		$result=mysql_query($sql);
		if(mysql_fetch_array($result))
			return true;
		else
			return false;
	}
	
	function make_friend($uid,$fuid)
	{
		$sql="insert into st_friends values(0,$uid,$fuid)";
		return mysql_query($sql);
	}
	
	function unmake_friend($uid,$fuid)
	{
		$sql="delete from st_friends where uid=$uid and fuid=$fuid";
		return mysql_query($sql);
	}
	
	function post($t)
	{
		$st=str_replace("'","'",$t);
		$sql="insert into st_mblog values(0,$this->uid,'$st',null)";
		$result=mysql_query($sql);
		return $result;
	}
};
?>