
<?php
$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$exam_id));
if($exam_id=='all')
{
	$last_exam_id=get_single_value('exam_id','mark',array('student_id'=>$student_id));
	$publish_date=get_single_value('publishing_date','exam',array('exam_id'=>$last_exam_id));	
}
$this->db->from('student');
$this->db->where('student.student_id', $student_id);	
$query_result = $this->db->get();
$student = $query_result->row();
$group_name=get_single_value('group_name','group',array('group_id'=>$student->group));
?>
<table class="marksheet-header-table">
    <tr>
        <td class="sPhoto">
			<img width="90" height="90" src="<?php echo base_url(). 'uploads/student_image/'. $student->student_id.'.jpg';?>" alt="No Photo"></td>
        <td>
            <p><strong>Name</strong>: <b><?php echo $student->name;?></b></p>
            <?php if($student->student_unique_ID):?>
			<p><strong>Student ID</strong>: <?php echo $student->student_unique_ID;?></p>
			<?php endif;?>
			<p><strong>Father's Name</strong>: <?php echo $student->father_name;?></p>
			<p><strong>Mother's Name</strong>: <?php echo $student->mother_name;?></p>
            <p><strong>Result Publish Date</strong>: <?php echo $publish_date;?></p>
        </td>
        <td>
            <p><strong>Class</strong>: <?php echo get_single_value('name','class',array('class_id'=>$class_id)); ?></p>
			<?php
			if($student->group):
			?>
            <p><strong>Group</strong>: <?php echo $group_name;?></p>
			<?php
			endif;
			if($student->section):
			?>
            <p><strong>Section</strong>: <?php echo $student->section;?></p>
			<?php endif;?>
            <p><strong>Roll</strong>: <?php echo $student->roll;?></p>
            <p><strong>Session</strong>: <?php echo date('Y');?></p>
            
        </td>
    </tr>
</table>