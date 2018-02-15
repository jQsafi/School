<link href="<?php echo base_url();?>template/css/bootstrap-datetimepicker.min.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>template/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('class_routine_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo translate('add_class_routine');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane active" id="list">
				<div class="accordion" id="accordion2">
                	<?php 
					$toggle = true;
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
						?>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $row['class_id'];?>">
                                        <i class="icon-rss icon-1x"></i> Class <?php echo $row['name'];?>
                                    </a>
                                </div>
								<div>
								<a style="margin-top: -35px;float:right;" href="<?php echo base_url(); ?>index.php?admin/routineprint/<?php echo $row['class_id']; ?>" class="btn btn-gray" rel="tooltip" data-placement="right" 
			   data-original-title="" window="new" win_height="816px" win_width="1200px">
				<span><?php echo translate('print'); ?></span></a>
				                 </div>
                                <div id="collapse<?php echo $row['class_id'];?>" class="accordion-body collapse <?php if($toggle){echo 'in';$toggle=false;}?>">
                                    <div class="accordion-inner">
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-normal">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                if($d==1)$day='saturday';
                                                else if($d==2)$day='sunday';
                                                else if($d==3)$day='monday';
                                                else if($d==4)$day='tuesday';
                                                else if($d==5)$day='wednesday';
                                                else if($d==6)$day='thursday';
                                                else if($d==7)$day='friday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $row['class_id']);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                            	<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?> by
																<?php 
																$techer_id = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->teacher_id;
                                                                echo $this->db->get_where('teacher', array('teacher_id' => $techer_id))->row()->name;			
																?>
																<?php echo '<br>'.'Start-'.$row2['time_start'].' End-'.$row2['time_end'].'';?>
                                                            	<span class="caret"></span>
                                                            </button>
															<ul class="dropdown-menu">
																<li><a data-toggle="modal" href="#modal-form" onclick="modal('edit_class_routine',<?php echo $row2['class_routine_id'];?>)"><i class="icon-cog"></i> edit</a></li>
																<li><a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>')">
                                                                		<i class="icon-trash"></i> delete</a></li>
															</ul>
														</div>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
						<?php
					endforeach;
					?>
  				</div>
			</div>
            <!----TABLE LISTING ENDS--->
            
			 <div>  <a style="margin-top: -8px;float:center;" href="<?php echo base_url(); ?>index.php?admin/routineprint/all" class="btn btn-gray" rel="tooltip" data-placement="right" 
			   data-original-title="" window="new" win_height="816px" win_width="1200px">
				<span><?php echo translate('all routine print'); ?></span></a>  </div>
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/class_routine/create' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('class');?></label>
                                <div class="controls">
                                    <select name="class_id" class="uniform" onchange="show_subjects(this.value)" style="width:100%;">
									<option value=""></option>
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('subject');?></label>
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
                                    foreach($subjects as $row2): ?>
                                    <option value="<?php echo $row2['subject_id'];?>"
                                        <?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>
                                    </option>
                                    <?php endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="subject_id_0" 
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="" style="float:left;">
                                    <option value="">Select a class first</option>
                            </select>
									
									<!--<select name="subject_id" class="uniform" style="width:100%;">
                                    	<?php 
										//$subjects = $this->db->get('subject')->result_array();
										//foreach($subjects as $row):
										?>
                                    		<option value="<?php //echo $row['subject_id'];?>"><?php //echo $row['name'];?></option>
                                        <?php
										//endforeach;
										?>
                                    </select>-->
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('day');?></label>
                                <div class="controls">
                                    <select name="day" class="uniform" style="width:100%;">
									    <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('starting_time');?></label>
                                <div class="controls">
                                   <div id="startdate" class="input-append date">
										<input name="starting_time" type="text"></input>
											<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
									</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('ending_time');?></label>
                                <div class="controls">
                                   <div id="enddate" class="input-append date">
										<input name="ending_time" type="text"></input>
											<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_class_routine');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
<script type="text/javascript">
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
        document.getElementById('exam_id_'+ exam_id ).style.display = 'block' ;
	document.getElementById('exam_id_'+ exam_id ).setAttribute("name" , "exam_sub_id");
  }

</script> 
<script type="text/javascript">
      $('#startdate').datetimepicker({
		format: 'HH:mm PP',
		pickDate: false,
        pickSeconds: false,
        pick12HourFormat: true
      });
	  $('#enddate').datetimepicker({
        format: 'HH:mm PP',
		pickDate: false,
        pickSeconds: false,
        pick12HourFormat: true
      });
    </script>