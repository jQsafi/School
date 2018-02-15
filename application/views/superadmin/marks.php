<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<link rel="shortcut icon" href="<?=base_url()?>images/wemax_edu.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css" />
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">-->
        <link href="<?php echo base_url();?>template/css/schoolsoft.css" media="screen" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
        <script src="<?php echo base_url();?>template/js/html5shiv.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/excanvas.js" type="text/javascript"></script>
        <![endif]-->
        <script src="<?php echo base_url();?>template/js/ekattor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url();?>template/js/sp8.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/sp-8-form-validation.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body style="padding:10px">
<div class="box box-border" id="main_body">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('manage_marks');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/marks');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_exam');?></td>
                        <td><?php echo translate('Sub_exam');?></td>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
                        <td><?php echo translate('select_subject');?></td>
                	</tr>
                	<tr>
                        <td>
                            <select name="exam_id" class=""  style="float:left;"  onchange="show_subExam(this.value)"  >
                                <option value=""><?php echo translate('select_an_exam'); ?></option>
                                <?php
                                $exams = $this->db->where(array('parent_id' => 0))->get('exam')->result_array();
                                foreach ($exams as $row):
                                    ?>
                                    <option value="<?php echo $row['exam_id']; ?>"
                                            <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>>
                                                <?php echo translate('exam_name:'); ?> <?php echo $row['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                       
                      <td>
                        	 
							<?php 
                                foreach($exams as $row): ?>
                                <?php
								$subExam	=	$this->crud_model->get_subExam_by_exam($row['exam_id']);
								$sub_exam_count=count($subExam);
								?>
                                <select name="<?php if($exam_id == $row['exam_id'])echo 'exam_sub_id';else echo 'temp';?>" 
                                      id="exam_id_<?php echo $row['exam_id'];?>" 
                                          style="display:<?php if($exam_id == $row['exam_id']) echo 'block'; else echo 'none';?>;" class=""  style="float:left;" sub_exam="<?=$sub_exam_count?>">
                                  
                                    <option value="">Sub Exam of <?php echo $row['name'];?></option>
                                    <?php 
                                    foreach($subExam as $row2): ?>
                                    <option value="<?php echo $row2['exam_id'];?>"
                                        <?php if(isset($sub_exam_id) && $sub_exam_id == $row2['exam_id'])
                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>
                                    </option>
                                    <?php endforeach;?>
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="exam_id_0" 
                              style="display:<?php if(isset($sub_exam_id) && $sub_exam_id >0 || $sub_exam_id ==99999)echo 'none';else echo 'block';?>;" class="" style="float:left;">
                                    <option value="">Select a Exam first</option>
                             </select> 
                            
                            
                        </td>
                        <td>
                        	<select name="class_id" class=""  onchange="show_subjects(this.value);showgroup(this.value);"  style="float:left;">
                                <option value=""><?php echo translate('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            Class <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
						<td>
                        	<select name="group_name" class="" style="width:100%;" id="std_group_name">
							<option value="">Select Group</option>
                            <?php
								echo make_select('group','group_id','group_name',$group_name);
							?>
                            </select>
                        </td>
						
                        <td>
                        	<!-----SELECT SUBJECT ACCORDING TO SELECTED CLASS--------->
							<?php 
                                $classes	=	$this->crud_model->get_classes(); 
                                foreach($classes as $row): ?>
                                
                                <select name="<?php if($class_id == $row['class_id'])echo 'subject_id';else echo 'temp';?>" 
                                      id="subject_id_<?php echo $row['class_id'];?>" 
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class=""  style="float:left;">
                                  
                                    <option value="">Subject of class <?php echo $row['name'];?></option>
                                    
                                    <?php 
                                    $subjects	=	$this->crud_model->get_subjects_by_class($row['class_id']); 
                                    foreach($subjects as $row2):
									$group_id=$row2['group_id'];
									//if($status==0)
									{
									?>
                                    <option value="<?php echo $row2['subject_id'];?>" 
									<?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"'; echo 'group='.$group_id;?>>
												<?php echo $row2['name'];?>
                                    </option>
                                    <?php 
									}
									endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="subject_id_0" 
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="" style="float:left;">
                                    <option value="">Select a class first</option>
                            </select>
                        </td>
						<td>
							<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo translate('manage_marks');?>" class="btn btn-normal btn-gray" /> </form>
						</td>
                        
                	</tr>
					<?php if($exam_id >0 && $class_id >0 && $subject_id >0 && $sub_exam_id >=0 ):?>
					<?php
					$condition=array(
					'class_id'=>$class_id,
					'exam_id'=>$exam_id,
					'sub_exam_id'=>$sub_exam_id,
					'subject_id'=>$subject_id
					);
					$this->db->where($condition);
					$this->db->from('full_mark');
					$fresult=$this->db->get()->result();
					$written_full_mark=0;
					$written_pass_mark=0;
					$objective_full_mark=0;
					$objective_pass_mark=0;
					$practical_full_mark=0;
					$practical_pass_mark=0;
					$sba_full_mark=0;
					$sba_pass_mark=0;
					foreach($fresult as $fm)
					{
						$written_pass_mark=$fm->written_pass_mark;
						$objective_pass_mark=$fm->objective_pass_mark;
						$practical_pass_mark=$fm->practical_pass_mark;
						$sba_pass_mark=$fm->sba_pass_mark;
					}
					?>
					<tr>
					<td colspan="2">
						<?php echo form_open('admin/full_mark');?>
						<input type="hidden" name="group_id" value="<?=$group_name?>"/>
						<input type="hidden" name="class_id" value="<?=$class_id?>"/>
						<input type="hidden" name="exam_id" value="<?=$exam_id?>"/>
						<input type="hidden" name="sub_exam_id" value="<?=$sub_exam_id?>"/>
						<input type="hidden" name="subject_id" value="<?=$subject_id?>"/>
						<table class="table table-normal box">
							<thead>
								<tr>
									<th>
										&nbsp;
									</th>
									<th>
										Pass Mark
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<th>
										Written
									</th>
									<td>
										<input type="text" number class="input" name="written_pass_mark" value="<?=$written_pass_mark?>"/>
									</td>
								</tr>
								<tr>
									<th>
										Objective
									</th>
									<td>
										<input type="text" number class="input" name="objective_pass_mark" value="<?=$objective_pass_mark?>"/>
									</td>
								</tr>
								<tr>
									<th>
										Practical
									</th>
									<td>
										<input type="text" number class="input" name="practical_pass_mark" value="<?=$practical_pass_mark?>"/>
									</td>
								</tr>
								<tr>
									<th>
										SBA
									</th>
									<td>
										<input type="text" number class="input" name="sba_pass_mark" value="<?=$sba_pass_mark?>"/>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<button type="submit" class="btn btn-normal btn-gray">Save</button>
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					</td>
					<td colspan="4">
						<a href="<?=site_url('admin/manage_attendance/'.$class_id.'/'.$exam_id.'/'.$sub_exam_id.'/'.$group_name)?>" class="btn btn-red" window="new" win_height="800px" win_width="800px">
							<?=translate('manage_attendance_mark')?>
						</a>
					</td>
					</tr>
					<?php 
						endif;
					?>
					
                </table>
               
                </center>
                
                
                <br /><br />
                
                
                <?php if($exam_id >0 && $class_id >0 && $subject_id >0 && $sub_exam_id >=0 ):?>
                <?php 
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
						    //echo $this->db->last_query();
							foreach($students as $row):
							$this->db->select('subject_id,name,group_id');
							$this->db->from('subject');
							$this->db->where('class_id',$class_id);
							$this->db->where('group_id',0);
							$this->db->where('status',0);
							$result   = $this->db->get();
							$subjects = array();
							foreach($result->result() as $sub){
								$sub_list[] = $sub->subject_id;
							}
							$subjects=explode('SC',$row['subject_id']);
							foreach($subjects as $sub)
							{
								if($sub)
								$sub_list[]=$sub;
							}
							if($group_name)
							{
								$sub_list[]=$row['fourth_id'];
							}
							if(count($sub_list) and ($subject_id and !in_array($subject_id,$sub_list)))
							{
								continue;	
							}
							$verify_data	=	array(	'exam_id' => $exam_id ,
														'class_id' => $class_id ,
														'subject_id' => $subject_id , 
														'sub_exam_id' => $sub_exam_id , 
														'student_id' => $row['student_id']);
							$query = $this->db->get_where('mark' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark' , $verify_data);
						 endforeach;
				?>
                            <?php echo form_open('admin/marks'); ?>
                
                <table class="table table-normal box">
                    <thead>
                        <tr>
							<td><?=translate('roll')?></td>
                            <td><?=translate('student_name')?></td>
                            <td><?php echo translate('Written');?></td>
                            <td><?php echo translate('objective');?></td>
                            <td><?php echo translate('practical');?></td>
                            <td><?php echo translate('SBA');?></td>
							<td><?php echo translate('full_mark');?><br><input type="checkbox" name="same" id="same" class="input" checked="true" style="width:10px;"/>
							All values are same?</td>
                            <!--<td><?php echo translate('attendance');?></td>
                            <td><?php echo translate('classday');?></td>
                            <td><?php echo translate('comment');?></td>-->
                        </tr>
					</thead>
					<tbody>
                            <?php
							
							if($group_name)
								$students = $this->db->get_where('student', array('class_id' => $class_id,'group' => $group_name))->result_array();
								else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
                           // $students = $this->crud_model->get_students($class_id);
						//  echo $this->db->last_query();
						
                            $i=0;
                            foreach ($students as $row):

                                $verify_data = array('exam_id' => $exam_id,
                                    'class_id' => $class_id,
                                    'subject_id' => $subject_id,
                                    'sub_exam_id' => $sub_exam_id , 
                                    'student_id' => $row['student_id']);

                                $query = $this->db->get_where('mark', $verify_data);
                                $marks = $query->result_array();
                            
                                foreach ($marks as  $row2):
                                    ?>
                                    <tr>
										<td>
                                            <?php echo $row['roll']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <input type="hidden" name="marks[<?php echo $i;?>][mark_id]" value="<?php echo $row2['mark_id']; ?>" />
                                            <input type="hidden" name="marks[<?php echo $i;?>][class_id]" value="<?php echo $class_id; ?>" />
                                            <input type="hidden" name="marks[<?php echo $i;?>][student_id]" value="<?php echo $row['student_id']; ?>" />
                                            <input type="hidden" name="marks[<?php echo $i;?>][sub_exam_id]" value="<?php echo $sub_exam_id; ?>" />
                                            <input type="hidden" name="marks[<?php echo $i;?>][exam_id]" value="<?php echo $exam_id; ?>" />
											<input type="hidden" name="marks[<?php echo $i;?>][subject_id]" value="<?php echo $subject_id; ?>" />
                                            <input type="hidden" name="exam_sub_id" value="<?php echo $sub_exam_id; ?>" />
                                            <input type="hidden" name="group_name" value="<?php echo $group_name; ?>" />
                                            
                                            
                                            <input type="text" value="<?php echo $row2['formation']; ?>" name="marks[<?php echo $i;?>][formation]"  />

                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $row2['objective']; ?>" name="marks[<?php echo $i;?>][objective]"  />

                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $row2['practical']; ?>" name="marks[<?php echo $i;?>][practical]"  />

                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $row2['sba']; ?>" name="marks[<?php echo $i;?>][sba]"  />

                                        </td>
										<td>
                                            <input type="text" value="<?php echo $row2['total_marks']; ?>" name="marks[<?php echo $i;?>][total_marks]" class="total_mark"  />

                                        </td>
                                        <!--<td>
                                            <input type="text" value="<?php echo $row2['attendance']; ?>" name="marks[<?php echo $i;?>][attendance]"  />
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $row2['classday']; ?>" name="marks[<?php echo $i;?>][classday]"  />
                                        </td>
                                        <td>
                                            <textarea style="height:26px;" name="marks[<?php echo $i;?>][comment]"><?php echo $row2['comment']; ?></textarea>
                                        </td>-->
                                      
                                    </tr>
                                    
                                    <?php  endforeach;$i++;?>
                                    
                                    
                         	<?php endforeach; ?>
                        <tr>
                            <td colspan="10" style="text-align: center;"><button type="submit" class="btn btn-normal btn-gray "> Update Marks </button></td>
                        </tr>
						</tbody>
                  </table>
                                            
                                            
                                            
                                            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>" />
                                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                                            <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>" />
                                            <input type="hidden" name="exam_sub_id" value="<?php echo $sub_exam_id; ?>" />
                                            <input type="hidden" name="operation" value="update" />
                                    
                                    </form>
            
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
<?php
	$this->load->view('modal_hidden');
?>
<script type="text/javascript">
$(function()
{
	$("#std_group_name").trigger('change');
});
$("#std_group_name").change(function()
{
	var group=$(this).val();
	$("[group]").hide();
	$("[group="+group+"]").show();
	$("[group=0]").show();
});
  function show_subjects(class_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('subject_id_'+i).style.display = 'none' ;
	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      document.getElementById('subject_id_'+class_id).style.display = 'block' ;
	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
  }
  function showgroup(class_id)
  {
  	/*if(class_id<9)
	{
		$("#std_group_name").val('');
		$("#std_group_name").attr('disabled','false');
	}
	else
	{
		$("#std_group_name").removeAttr('disabled','true');
	}*/
  }
  function show_subExam(exam_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('exam_id_'+i).style.display = 'none' ;
	  		  document.getElementById('exam_id_'+i).setAttribute("name" , "temp");
			  $("#exam_id_"+ i).removeAttr('required');
          }
          catch(err){}
      }
	  if(exam_id >0)
	  {
        document.getElementById('exam_id_'+ exam_id ).style.display = 'block' ;
		document.getElementById('exam_id_'+ exam_id ).setAttribute("name" , "exam_sub_id");
		var sub_exam_count=$("#exam_id_"+ exam_id).attr('sub_exam');
		sub_exam_count=parseInt(sub_exam_count,10);
		if(sub_exam_count>0)
		document.getElementById('exam_id_'+ exam_id ).setAttribute("required" , "true");
		}
  }
$(".total_mark").keyup(function()
	{
		if($("#same").is(':checked'))
		{
			var cv=$(this).val();
			$(".total_mark").val(cv);
		}
	});
</script> 
</body>
</html>