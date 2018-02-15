
<style>
    table.dataTable {
        border: 1px solid #d5d5d5;
    }
    table.dataTable thead th, table.dataTable thead th div {
        height: 45px !important;
    }
    #list label {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 0;
        min-width: 105px;
    }
    #list .control-group {
        margin-bottom: 0;
    }
    #list .controls, #list .controls select, #list .controls input {
        display: inline-block;
        margin-bottom: 0;
    }
</style>
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
    <div class="box-header">
        <?php $grand_total = 0; ?>
        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('Attendance Report'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open('admin/attendance_report',array('target'=>"_blcnk")); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
               
                            
                            
                            
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('class'); ?></label>
                                <div class="controls">
                                          <select name="class_id" class=""  onchange="show_subjects(this.value);showgroup(this.value);"  style="float:left;" required="">
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
                                </div>
                            </div> 
                        </td>
                        <td>
                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('group_name'); ?></label>
                                <div class="controls">
                                   <select name="group_name" id="std_group_name">
							<option value="">Select Group</option>
                            <?php
								echo make_select('group','group_id','group_name',$group_name);
							?>
                            </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Subject'); ?></label>
                                <div class="controls">
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
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Section'); ?></label>
                                <div class="controls">
                                    <select name="section_name" class="expenseName">
                                        <option value="">Please select</option>
                                   
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Student id'); ?></label>
                                <div class="controls">
                                <select name="student_id" class="chzn-select classId" required="">
                                    <option class="" value="0">Please select student</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student_<?php echo $row['class_id']; ?>" value="<?php echo $row['student_id']; ?>"  <?php if ($student_id == $row['student_id']) echo 'selected'; ?>>
                                            <?php echo $row['student_unique_ID'].' ';echo $row['name'];if($row['class_id']){?> Class <?php echo $this->crud_model->get_class_name($row['class_id']);}if($row['roll']){?> Roll <?php echo $row['roll'];}?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Attendance_type'); ?></label>
                                <div class="controls">
                                    <select name="Attendance_type" class="Attendance_type">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($attendstype as $key => $value) { ?>
                                                <option value="<?php echo $value['short_form']; ?>" ><?php echo $value['attendance_type']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date from'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="attendance_date_from" value="<?php echo $this->session->userdata('expense_date_from'); ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date to'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="attendance_date_to" value="<?php echo $this->session->userdata('expense_date_to'); ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="operation" value="selection" /> 
                           <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray"/> 
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />
        </div>
        <!----TABLE LISTING ENDS--->

    </div>
</div>
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

  function show_subExam(exam_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('exam_id_'+i).style.display = 'none' ;
	  		  document.getElementById('exam_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
	  if(exam_id >0)
	  {
        document.getElementById('exam_id_'+ exam_id ).style.display = 'block' ;
		document.getElementById('exam_id_'+ exam_id ).setAttribute("name" , "exam_sub_id");
		}
  }




</script> 

