<html>
<head>
	<title>
		Progress Card of <?php echo get_single_value('name','student',array('student_id'=>$student_id));?>-<?php echo date("Y");?>
	</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>template/css/marksheet.css">
<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url();?>template/css/font.css">

<style type="text/css">
	.container {
		
	}
	
	.exam-wraper {
		float: left;
        background: #fff;
		font-family: sans-serif;
	}
	
	.number-total {
		background-color: #8cff38;
		font-weight: bold;
	}
	
	.result-card {
		border-collapse: collapse;
		border-spacing: 0;
		border-color: black;
		border-left: 1px solid black;
	}
	
	.total-row {
		background-color: #ffbebe;
	}
	
	.hm-row {
		background-color: #a3fff8;
	}
	
	.gpa-row {
		background-color: #bcb0ff;
	}
	
	.lgp-row {
		background-color: #ffffb0;
	}
	
	.result-card table,
	td,
	th {
		font-size: 12px;
                text-align: center;
	}
	
	.number-input-header td {
		writing-mode: tb-rl;
		-webkit-transform: rotate(-90deg);
		-moz-transform: rotate(-90deg);
		-o-transform: rotate(-90deg);
		-ms-transform: rotate(-90deg);
		height: 80px;
	}
	
	.result-card td {
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
        border-left: 1px;
		padding: 2px;
		border-color: black;
	}
	table.result-card tbody:first-child .result-card td {
		 
                border-left: 1;
	}
	.result-card th {
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
		border-color: black;
		border-left: 0;
	}
	
	.result-card .result-card-054q,
	.result-card-s6z2 {
		text-align: center
	}
	
	.result-card .result-card-0ord {
		text-align: right
	}
        
        tbody{ float: left;}
        
        
        
        .mainCon {
	  text-align: center;
	  margin-bottom: 30px;
	  font-family: sans-serif;
	}	
	.mainCon h1, .mainCon h2, .mainCon h3{
	  line-height:26px;
	  margin: 0;
	}
	.mainCon h1 {
	  line-height:normal;
	  font-size: 26px;
	}
	.mainCon h2 {
	  font-size: 20px;
	}
	.mainCon h3 {
	  font-size: 16px;
	  line-height: 16px;
	}

.mainT {
  background: none repeat scroll 0 0 #fff;
  border: 1px solid #000;
  margin-bottom: 15px;
  padding: 0;
  text-align: center;
  width: 100%;
  font-family: sans-serif;
}

.mainT > tbody {
  width: 100%;
}
.mainT tr {
  float: left;
  width: 100%;
}
.mainT td {
  padding: 5px;
  vertical-align: top;
  width: 800px;
  text-align:left;
}

.mainT td:last-child{
	text-align: left;
	padding-left: 31%;
}

.sPhoto{
    text-align: left;
width: 130px !important;
}
.mainT td p {
  line-height: 16px;
  margin: 0;
  text-align: left;
}

.signature {
	float:left;
	display:block;
	width: 100%;
	font-family: sans-serif;
	margin-top:100px;
	margin-bottom:30px;
}

.signature td{
	width: 800px;
}


</style>
 
<div class="mainCon">
    <h1><?php echo get_single_value('description','settings',array('type'=>'system_name'));?></h1>
    <h2><?php echo get_single_value('description','settings',array('type'=>'address'));?></h2>
    <h3>Progress Card <?php echo date("Y");?></h3>

</div>

<?php 
        $this->db->from('student');
        $this->db->where('student.student_id', $student_id);	
        $query_result = $this->db->get();
        $student = $query_result->row();
         
?>

            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
<?php
	$this->load->language('mark_sheet') ;
	$marks_header=$this->lang->line('marks_header');
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	$this->db->select('distinct(exam_id)');
	$this->db->from('marksheet');
	$this->db->where('class_id',$class_id);
	$result=$this->db->get();
	$main_exam_head_str='';
	$sub_exam_head_str='';
	$marks_header_str='';
	$main_exam_head_str.='<tr class=main_exam><th rowspan=3>Subject Name</th>';
	$sub_exam_head_str.='<tr class=sub_exam>';
	$marks_header_str.='<tr class=marks_header>';
	$header_row_span_count=0;
	foreach($result->result() as $row)
	{
		$exam_id=$row->exam_id;
		$exams[]=$row->exam_id;
		$main_exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$colspan_count=$sub_exam_count*11;
		if(!$colspan_count)
			$colspan_count=11;
		if($sub_exam_count>$header_row_span_count)
			$header_row_span_count=$sub_exam_count;
		if($sub_exam_count)
		{
			$main_exam_head_str.='<td colspan='.$colspan_count.'>'.$main_exam_name.'</td>';
		}
		else
		{
			$main_exam_head_str.='<td colspan='.$colspan_count.' rowspan=2>'.$main_exam_name.'</td>';	
			$marks_header_str.=$marks_header;
		}
		$main_exam_head_str.='<td colspan=3>Final Result</td>';
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$sub_exam_name=$sub_xm->name;
			$sub_exam_head_str.='<td colspan=11>'.$sub_exam_name.'</td>';
			$marks_header_str.=$marks_header;
		}
		$sub_exam_head_str.='<td rowspan=2>Grand Total</td><td rowspan=2>GPA</td><td rowspan=2>Letter Grade</td>';
	}
	$main_exam_head_str.='<td colspan=3>Grand Final Result</td>';
	$sub_exam_head_str.='<td rowspan=2>Grand Total</td><td rowspan=2>GPA</td><td rowspan=2>Letter Grade</td>';
	$main_exam_head_str.='</tr>';
	$sub_exam_head_str.='</tr>';
	$marks_header_str.='</tr>';
	
	
 	$this->db->select('subject_id,name,group_id');
	$this->db->from('subject');
	$this->db->where('class_id',$class_id);
	$result=$this->db->get();
	$subjects=array();
	foreach($result->result() as $row)
	{
		if($fourth_subject==$row->subject_id)
		{
			continue;	
		}
		$subjects[]=$row->subject_id;	
	}
	$subjects[]=$fourth_subject;
	$total_subject=count($subjects);
	$total_str='';
	$sub_exam_str='';
	$merit_str='';
	$total_str.='<tr class=total><td>Total</td>';
	$merit_str.='<tr class=merit><td>Merit</td>';
	$final_gpa=0;
	$subject_counter=0;
	$total_gpa=0;
	$this->db->select('distinct(exam_id)');
	$this->db->from('marksheet');
	$this->db->where('class_id',$class_id);
	$result=$this->db->get();
	$header_row_span_count=0;
	$exam_counter=0;
	$gran_final_gpa=0;
	$final_totals=array();
	$over_all_total=0;
	foreach($result->result() as $row)
	{
		$exam_counter++;
		$exam_id=$row->exam_id;
		$final_totals[$exam_id]['total']=0;
		$final_totals[$exam_id]['gpa']=0;
		$final_gpa=final_gpa($student_id,$class_id,$exam_id);
		$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
		$this->db->from('exam');
		$this->db->where('parent_id',$exam_id);
		$sub_xm_res=$this->db->get();
		foreach($sub_xm_res->result() as $sub_xm)
		{
			$sub_exam_id=$sub_xm->exam_id;
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id,
			//'subject_id !='=>$fourth_subject
			);
			$heigst_mark_condition=array(
			'class_id'=>$class_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id
			);
			$total_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'sub_exam_id'=>$sub_exam_id,
			'exam_id'=>$exam_id,
			'subject_id !='=>$fourth_subject
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$total=get_single_value('sum(sub_total)','mark',$total_condition);
			$temp_subject_id=get_single_value('subject_id','mark',$mark_condition);
			$will_added=0;
			//if($temp_subject_id==$fourth_subject)
			{
				$fourt_condition=array(
					'class_id'=>$class_id,
					'student_id'=>$student_id,
					'sub_exam_id'=>$sub_exam_id,
					'exam_id'=>$exam_id,
					'subject_id'=>$fourth_subject
					);
				$fourth_full_mark=get_single_value('total_marks','mark',$fourt_condition);
				$fourth_total=get_single_value('sub_total','mark',$fourt_condition);
				$fourty=($fourth_full_mark*40)/100;
				$will_add=$fourth_total-$fourty;
				if($will_add<0)
				{
					$will_add=0;	
				}
			}
			$total+=$will_add;
			$final_totals[$exam_id]['total']+=$total;
			$total_heigst=total_heigst($class_id,$exam_id,$sub_exam_id);
			$eighty=$total*0.8;
			$twenty=$total*0.2;
			$final_gpa=sub_total_gpa($student_id,$class_id,$exam_id,$sub_exam_id,$fourth_subject);
			$final_totals[$exam_id]['gpa']+=$final_gpa;
			$lg=get_letter_grade($final_gpa);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td>'.$total.'</td>';
			$total_str.='<td>'.$total_heigst.'</td>';
			$total_str.='<td>'.$eighty.'</td>';
			$total_str.='<td>'.$twenty.'</td>';
			$total_str.='<td>'.$final_gpa.'</td>';
			$total_str.='<td>'.$lg.'</td>';
			$merit_list=merit_list_sub($student_id,$class_id,$exam_id,$sub_exam_id);
			$merit_str.='<td colspan=11>'.$merit_list.'</td>';
		}
		if(!$sub_exam_count)
		{
			$mark_condition=array(
			'class_id'=>$class_id,
			'student_id'=>$student_id,
			'exam_id'=>$exam_id,
			'subject_id !='=>$fourth_subject
			);
			$heigst_mark_condition=array(
			'class_id'=>$class_id,
			'exam_id'=>$exam_id
			);
			$full_mark=get_single_value('sum(total_marks)','mark',$mark_condition);
			$formation=get_single_value('sum(formation)','mark',$mark_condition);
			$objective=get_single_value('sum(objective)','mark',$mark_condition);
			$practical=get_single_value('sum(practical)','mark',$mark_condition);
			$sba=get_single_value('sum(sba)','mark',$mark_condition);
			$total=get_single_value('sum(sub_total)','mark',$mark_condition);
			$will_add=fourth_subject_calculation($student_id,$class_id,$exam_id);
			if($will_add<0)
			$will_add=0;
			$total+=$will_add;
			$final_totals[$exam_id]['total']+=$total;
			$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
			$eighty=$total*0.8;
			$twenty=$total*0.2;
			$final_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
			$lg=get_letter_grade($final_gpa);
			$total_str.='<td>'.$full_mark.'</td>';
			$total_str.='<td>'.$formation.'</td>';
			$total_str.='<td>'.$objective.'</td>';
			$total_str.='<td>'.$practical.'</td>';
			$total_str.='<td>'.$sba.'</td>';
			$total_str.='<td>'.$total.'</td>';
			$total_str.='<td>'.$heigst.'</td>';
			$total_str.='<td>'.$eighty.'</td>';
			$total_str.='<td>'.$twenty.'</td>';
			$total_str.='<td>'.$final_gpa.'</td>';
			$total_str.='<td>'.$lg.'</td>';
			$merit_list=merit_list_sub($student_id,$class_id,$exam_id);
			$merit_str.='<td colspan=11>'.$merit_list.'</td>';
		}
		$merit_list=merit_list_sub($student_id,$class_id,$exam_id);
		$merit_str.='<td colspan=3>'.$merit_list.'</td>';
		$total_str.='<td colspan=3></td>';
	}
	$merit_list=merit_list_sub($student_id,$class_id);
	$merit_str.='<td colspan=3>'.$merit_list.'</td>';
	$total_str.='<td colspan=3></td>';
	$total_str.='<tr>';
	$over_all_total_marks=0;
	$over_all_total_grade=0;
	foreach($final_totals as $exam_id=>$totals)
	{
		$total_mark=$totals['total'];
		$final_totals[$exam_id]['total']=$total_mark;
		$over_all_total_marks+=$total_mark;
		$final_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
		if($final_gpa==0)
		{
			$over_all_total_grade=0;
			break;	
		}
		$over_all_total_grade+=$final_gpa;
		$final_lg=get_letter_grade($total_gpa);
		$final_totals[$exam_id]['lg']=$final_lg;
		$final_totals[$exam_id]['gpa']=$total_gpa;
	}
	$over_all_total_grade=$over_all_total_grade/count($final_totals);
	$over_all_total_lg=get_letter_grade($over_all_total_grade);
	$gran_final_gpa=$gran_final_gpa/$exam_counter;
	$temp_gpa=(int)$gran_final_gpa;
	if($gran_final_gpa>=3.5 and $gran_final_gpa<4.00)
	{
		$temp_gpa=3.5;
	}
	$grand_final_lg=get_single_value('name','grade',array('grade_point'=>$temp_gpa));
	foreach($subjects as $subject_id)
	{
		$subject_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
		$main_exam_str.='<td>'.$subject_name.'</td>';
		$this->db->select('distinct(exam_id)');
		$this->db->from('marksheet');
		$this->db->where('class_id',$class_id);
		$result=$this->db->get();
		$header_row_span_count=0;
		$exam_counter=0;
		foreach($result->result() as $row)
		{
			$exam_counter++;
			$exam_id=$row->exam_id;
			$sub_exam_count=get_single_value('count(name)','exam',array('parent_id'=>$exam_id));
			$colspan_count=$sub_exam_count*11;
			if(!$colspan_count)
				$colspan_count=11;
			if($sub_exam_count>$header_row_span_count)
				$header_row_span_count=$sub_exam_count;
			$this->db->from('exam');
			$this->db->where('parent_id',$exam_id);
			$sub_xm_res=$this->db->get();
			foreach($sub_xm_res->result() as $sub_xm)
			{
				$sub_exam_id=$sub_xm->exam_id;
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$sub_exam_id,
				'exam_id'=>$exam_id
				);
				$heigst_mark_condition=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'sub_exam_id'=>$sub_exam_id,
				'exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$eighty=$total*0.8;
				$twenty=$total*0.2;
				$hundred=($total*100)/$full_mark;
				$mark_from=((int)($hundred/10))*10;
				$gpa=get_gpa($total,$full_mark);
				$lg=get_single_value('name','grade',array('grade_point'=>$gpa));
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$eighty.'</td>';
				$main_exam_str.='<td>'.$twenty.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
			}
			if(!$sub_exam_count)
			{
				$mark_condition=array(
				'class_id'=>$class_id,
				'student_id'=>$student_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id
				);
				$heigst_mark_condition=array(
				'class_id'=>$class_id,
				'subject_id'=>$subject_id,
				'exam_id'=>$exam_id
				);
				$full_mark=get_single_value('total_marks','mark',$mark_condition);
				$formation=get_single_value('formation','mark',$mark_condition);
				$objective=get_single_value('objective','mark',$mark_condition);
				$practical=get_single_value('practical','mark',$mark_condition);
				$sba=get_single_value('sba','mark',$mark_condition);
				$total=get_single_value('sub_total','mark',$mark_condition);
				$heigst=get_single_value('max(sub_total)','mark',$heigst_mark_condition);
				$eighty=$total*0.8;
				$twenty=$total*0.2;
				$gpa=get_gpa($total,$full_mark);
				$lg=get_single_value('name','grade',array('grade_point'=>$gpa));
				$main_exam_str.='<td>'.$full_mark.'</td>';
				$main_exam_str.='<td>'.$formation.'</td>';
				$main_exam_str.='<td>'.$objective.'</td>';
				$main_exam_str.='<td>'.$practical.'</td>';
				$main_exam_str.='<td>'.$sba.'</td>';
				$main_exam_str.='<td>'.$total.'</td>';
				$main_exam_str.='<td>'.$heigst.'</td>';
				$main_exam_str.='<td>'.$eighty.'</td>';
				$main_exam_str.='<td>'.$twenty.'</td>';
				$main_exam_str.='<td>'.$gpa.'</td>';
				$main_exam_str.='<td>'.$lg.'</td>';
				$final_gpa+=$gpa;
			}
			if($subject_counter==0)
			{
				$final_exam_gpa=final_gpa($student_id,$class_id,$exam_id,$fourth_subject);
				$sub_exam_str.='<td rowspan='.(count($subjects)).'>'.$final_totals[$exam_id]['total'].'</td>';
				$sub_exam_str.='<td rowspan='.(count($subjects)).'>'.$final_exam_gpa.'</td>';
				$sub_exam_str.='<td rowspan='.(count($subjects)).'>'.get_letter_grade($final_exam_gpa).'</td>';
			}
			$main_exam_str.=$sub_exam_str;
			$sub_exam_str='';
		}
		if($subject_counter==0)
		{
			$main_exam_str.='<td rowspan='.$total_subject.'>'.$over_all_total_marks.'</td>';
			$main_exam_str.='<td rowspan='.$total_subject.'>'.$over_all_total_grade.'</td>';
			$main_exam_str.='<td rowspan='.$total_subject.'>'.get_letter_grade($over_all_total_grade).'</td>';
		}
		$main_exam_str.='<tr>';
		$subject_counter++;
	}
	$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
?>
<table class="mainT table table-normal box">
    <tr>
        <td class="sPhoto">
			<img width="90" height="90" src="<?php echo base_url(). 'uploads/student_image/'. $student->student_id.'.jpg';?>" alt="No Photo"></td>
        <td>
            <p><strong>Name : </strong><?php echo $student->name;?></p>
            <p><strong>Student ID : </strong><?php echo $student->student_unique_ID;?></p>
			<p><strong>Father's Name : </strong><?php echo $student->father_name;?></p>
			<p><strong>Mother's Name : </strong><?php echo $student->mother_name;?></p>
            <p><strong>Result Publish Date : </strong><?php echo $publish_date;?></p>
        </td>
        <td>
            <p><strong>Class : </strong><?php echo get_single_value('name_word','class',array('class_id'=>$student->class_id)); ?></p>
            <p><strong>Group : </strong><?php echo ucfirst($student->group);?></p>
            <p><strong>Section : </strong><?php echo $student->section;?></p>
            <p><strong>Roll: </strong><?php echo $student->roll;?></p>
            <p><strong>Session : </strong><?php echo date('Y');?></p>
            
        </td>
    </tr>
</table>
                 
            <div class="exam-wraper" style=" min-width: 800px;">
		<table class="result-card">
					<?php
				echo $main_exam_head_str.$sub_exam_head_str.$marks_header_str;
				echo $main_exam_str;
				echo $total_str;
				echo $merit_str;
				?>
        </table>
				
	</div>                         
            
            <?php  endif;?>
			<table class="table table-normal box signature">
		<tr>
			<td>Guardian Signature</td>
			<td>Class Teacher Signature</td>
			<td>Headmaster/Principal Signature</td>
		</tr>
	</table>
	</body>
</html>