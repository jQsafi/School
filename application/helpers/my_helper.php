<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function make_select($tablename='',$value='',$name='',$selected='',$orderby='',$serial='asc')
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->select($value.",".$name);
		$ci->db->from($tablename);
		if($orderby)
			$ci->db->order_by($orderby,$serial);
		$result=$ci->db->get();
		$optionstr='';
		foreach($result->result() as $row)
		{
			$optionvalue=$row->$value;
			$optionname=$row->$name;
			if($selected==$optionvalue)
				$optionstr.="<option value='".$optionvalue."' selected>".$optionname."</option>";
			else
			$optionstr.="<option value='".$optionvalue."'>".$optionname."</option>";
		}
		return $optionstr;
	}
	function get_single_value($row,$table,$condition=array())
	{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where($condition);
		$ci->db->select($row);
		$ci->db->from($table);
		$result=$ci->db->get();
		$value=0;
		foreach($result->result() as $rows)
		{
			$value=$rows->$row;
		}
		if(!$result->num_rows())
		{
			$value='-';
		}
		return $value;
	}
	function us_date_format($date='',$format='')
	{
		if(!$format)
		$format="d/m/Y";
		if(!$date)
		$date=date($format);
		$date=date($format,strtotime($date));
		return $date;
	}
	function number_to_word($num)
	{
		if(!$num)
		return 'X';
		if(!is_numeric($num))
		return $num;
		$super_str="<sup>th</sup>";
	    if ($num % 100 >= 11 and $num % 100 <= 13)
	    {
	        $super_str="<sup>th</sup>";
	    }
	    elseif ( $num % 10 == 1 )
	    {
	        $super_str="<sup>st</sup>";
	    }
	    elseif ( $num % 10 == 2 )
	    {
	        $super_str="<sup>nd</sup>";
	    }
	    elseif ( $num % 10 == 3 )
	    {
	        $super_str="<sup>rd</sup>";
	    }
	    else
	    {
	        $super_str="<sup>th</sup>";
	    }
		if($num<10)
		{
			$num="<b style='display:none'>0</b>".$num;
		}
		return $num.$super_str;
	}
	function translate($main_word,$case='')
	{
		if(!$case)
		$case='capitalize';
		$ci=& get_instance();
		$ci->load->helper('language');
		$word=$ci->lang->line($main_word,FALSE);
		if(!$word)
		$word=str_replace('_',' ',$main_word);
		if($ci->input->cookie('language')!='english')
		return $word;
		if($case=='nochange')
		return $word;
		if($case=='upper_case')
		{
			$word=strtoupper($word);
		}
		if($case=='capitalize')
		{
			$word=ucwords($word);
		}
		if($case=='lower_case')
		{
			$word=strtolower($word);
		}
		return $word;
	}
?>