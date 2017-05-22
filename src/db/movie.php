<?php
define("INNER_ACCESS","1");
include_once("db/config.php");

class st_movie
{
	var $vid;
	var $uid;
	var $upload_ts;
	var $title;
	var $desc;
	var $pop;

	var $ss;
	var $tags;
	
	function st_movie()
	{
		$this->tags=array();
	}
	
	function get_movie_info()
	{
		$sql="select * from st_movie where vid=$this->vid";
		//echo $sql;
		$result=mysql_query($sql);
		if(!$result)
			return 1;
		if($row=mysql_fetch_array($result))
		{
			// get basic info
			$this->vid=$row['vid'];
			$this->uid=$row['uid'];
			$this->upload_ts=$row['upload_ts'];
			$this->title=$row['title'];
			$this->desc=$row['description'];
			$this->pop=$row['pop'];
			
			$this->title=str_replace("'","'",$this->title);
			$this->title=str_replace("<","&lt;",$this->title);
			$this->title=str_replace(">","&gt;",$this->title);
			$this->desc=str_replace("'","'",$this->desc);
			$this->desc=str_replace("<","&lt;",$this->desc);
			$this->desc=str_replace(">","&gt;",$this->desc);
			// get tags
			$sql="select * from st_tags where vid=$this->vid";
			$result=mysql_query($sql);
			if(!$result)
				return 1;
			while($row=mysql_fetch_array($result))
			{
				array_push($this->tags,$row['tag']);
			}
			return 0;
		}
		else
			return 2;
	}
	
	function update_movie_pop()
	{
		$pop=$this->pop+1;
		$sql="update st_movie set pop=$pop where vid=$this->vid";
		if(mysql_query($sql)==1)
			return 0;
		else
			return 1;
	}
	
	function get_rate()
	{
		$sql="select avg(rate) from st_rates where vid=$this->vid";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		printf("%.1f",$row['avg(rate)']);
	}
	
	function add_movie()
	{
		$sql="insert into st_movie values ($this->vid,$this->uid,null,'$this->title','$this->desc',0)";
		mysql_query($sql);
		$i=0;
		while($tag=$this->tags[$i++])
		{
			$sql="insert into st_tags values(0,$this->vid,'$tag')";
			mysql_query($sql);
		}
	}
	
};
?>