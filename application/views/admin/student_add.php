    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <?php if ($this->session->userdata('user_role') != 'accountant') { ?>
                    <li class="active" >
                        <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                            <?php echo translate('student_admission'); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">

			<?php
			$total_student=get_single_value('count(student_id)','student');
			$maximum=get_single_value('maximum_student','controls');
			?>
                <!----CREATION FORM STARTS---->
                <div class="tab-pane box add-student-container active " id="add" style="padding: 5px">
                    <?php if ($total_student <= $maximum) { ?>
                        <div class="box-content">
                            <?php echo form_open('admin/student_add/create/', array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data')); ?>
                            <div class="padded">  
								<h3> Basic Information</h3>
								<hr>
								<div class="control-group">
                                    <label class="control-label"><?php echo translate('name'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" name="name" placeholder="Enter Name"/>
                                        <input type="text" class="validate[required]" name="nick_name" placeholder="<?=translate('nick_name')?>"/>
                                    </div>
                                </div>
								
								 <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('father_info'); ?></label>
                                    <div class="controls">
                                    <p>
                                        <input type="text" class="w300" name="father_name" placeholder="Enter Name"/>
                                        <input type="number" class="w100" name="father_age" placeholder="Age"/>
                                        <input type="text" class="" name="father_education" placeholder="Enter Education"/>
                                        <input type="text" class="" name="father_occupation" placeholder="Enter Occupation"/>
                                        </p>
                                        <p>
										<input type="number" class="w300" name="father_mobile" placeholder="Enter mobile number"/>
										<input type="text" class="datepicker fill-up" name="father_birthday" placeholder="Enter birthday"/>
										</p>
                                    </div>
                                    
                                    <div class="controls">
                                    <p>
                                    <select name="father_blood_group" class="uniform" style="width:100%;">
											<option value="">Select Blood Group</option>
                                            <option value="O-"><?php echo translate('O-');?></option>
                                            <option value="O+"><?php echo translate('O+');?></option>
                                            <option value="A-"><?php echo translate('A-');?></option>
                                            <option value="A+"><?php echo translate('A+');?></option>
                                            <option value="B-"><?php echo translate('B-');?></option>
                                            <option value="B+"><?php echo translate('B+');?></option>
                                            <option value="AB-"><?php echo translate('AB-');?></option>
                                            <option value="AB+"><?php echo translate('AB+');?></option>
										</select>
                                    <input type="text" class="w300" name="father_nidnumber" placeholder="Enter national id number"/>
                                    </p>
                                    
                                    </div>
                                </div>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('mother_info'); ?></label>
                                    <div class="controls">
                                    <p>
                                        <input type="text" class="w300" name="mother_name" placeholder="Enter name"/>
                                        <input type="number" class="w100" name="mother_age" placeholder="Age"/>
                                        <input type="text" class="" name="mother_education" placeholder="Enter education"/>
                                        <input type="text" class="" name="mother_occupation" placeholder="Enter occupation"/>
                                      </p>
                                      <p>
									  <input type="number" class="w300" name="mother_mobile" placeholder="Enter mobile number"/>
									  <input type="text" class="datepicker fill-up" name="mother_birthday" placeholder="Enter birthday"/>
									  </p>
                                      
                                    </div>
                                     <div class="controls">
                                    <p>
                                    <select name="mother_blood_group" class="uniform" style="width:100%;">
											<option value="">Select Blood Group</option>
                                            <option value="O-"><?php echo translate('O-');?></option>
                                            <option value="O+"><?php echo translate('O+');?></option>
                                            <option value="A-"><?php echo translate('A-');?></option>
                                            <option value="A+"><?php echo translate('A+');?></option>
                                            <option value="B-"><?php echo translate('B-');?></option>
                                            <option value="B+"><?php echo translate('B+');?></option>
                                            <option value="AB-"><?php echo translate('AB-');?></option>
                                            <option value="AB+"><?php echo translate('AB+');?></option>
										</select>
                                        <input type="text" class="w300" name="mother_nidnumber" placeholder="Enter national id number"/>
                                    </p>
                                    </div>  
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('present_address'); ?></label>
                                    <div class="controls">
                                        <textarea rows="4" cols="55" class="" name="present_address" placeholder="Enter village, post office, upozilla, district name."></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('permanent_address'); ?></label>
                                    <div class="controls">
                                        <textarea rows="4" cols="55" class="" name="permanent_address" placeholder="Enter village, post office, upozilla, district name."></textarea>
                                    </div>
                                </div>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('guardian_info'); ?></label>
                                    <div class="controls">
                                        <p>
                                            <input type="text" class="w300" name="guardian_name" placeholder="Enter name"/>
                                            <input type="number" class="w100" name="guardian_age" placeholder="Age"/>                                        
                                            <input type="text" class="" name="guardian_profession" placeholder="Enter occupation"/> 
                                        </p>                                        
                                        <p>
                                            <input type="text" class="w300" name="guardian_income" placeholder="Enter anual income (TK)"/>
                                            <input type="text" class="w300" name="guardian_land" placeholder="Enter the amount of land"/>
                                        </p>
										<p>
											<input type="text" class="w300" name="guardian_nid" placeholder="Enter NID"/>
											<input type="text" class="datepicker fill-up" name="guardian_birthday" placeholder="Enter birthday"/>
											<input type="text" class="datepicker fill-up" name="guardian_birthday" placeholder="Enter birthday"/>
										</p>
										<p>
										<input type="number" class="w300" name="gardian_mobile" placeholder="Enter mobile number"/>
										<select name="gardian_blood_group" class="uniform" style="width:100%;">
											<option value="">Select Blood Group</option>
                                            <option value="O-"><?php echo translate('O-');?></option>
                                            <option value="O+"><?php echo translate('O+');?></option>
                                            <option value="A-"><?php echo translate('A-');?></option>
                                            <option value="A+"><?php echo translate('A+');?></option>
                                            <option value="B-"><?php echo translate('B-');?></option>
                                            <option value="B+"><?php echo translate('B+');?></option>
                                            <option value="AB-"><?php echo translate('AB-');?></option>
                                            <option value="AB+"><?php echo translate('AB+');?></option>
										</select>
										</p>
                                        <p style="margin: 0;">
                                            <textarea rows="4" cols="55" class="" name="guardian_address" placeholder="Enter village, post office, upozilla, district name."></textarea>
                                        </p>
                                    </div>
                                </div>   
								
								<div class="control-group">
                                    <label class="control-label"><?php echo translate('birthday'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="datepicker fill-up" name="birthday" placeholder="Enter birthday"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('sex'); ?></label>
                                    <div class="controls">
                                        <select name="sex" class="uniform" style="width:100%;">
                                            <option value="male"><?php echo translate('male'); ?></option>
                                            <option value="female"><?php echo translate('female'); ?></option>
                                        </select>
                                    </div>
                                </div>
								<div class="control-group">
                                    <label class="control-label"><?php echo translate('maritial_status'); ?></label>
                                    <div class="controls">
                                        <select name="maritial_status" class="uniform" style="width:100%;">
											<option value="unmarried"><?php echo translate('unmarried'); ?></option>
                                            <option value="married"><?php echo translate('married'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('religion'); ?></label>
                                    <div class="controls">
                                        <select name="religion" class="uniform" style="width:100%;">
											<option value="">Select Religion</option>
											<?php
												echo make_select('religion','religion_id','religion_name');
											?>
										</select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('nationality'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="nationality" placeholder="Enter nationality"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('phone'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="phone" placeholder="Enter phone"/>
                                    </div>
                                </div>
								 <div class="control-group">
                                    <label class="control-label"><?php echo translate('photo'); ?></label>
                                    <div class="controls" style="width:210px;">
                                        <input type="file" class="" name="userfile" id="imgInp" />
                                    </div>
                                </div>
								<div class="control-group">
                                    <label class="control-label"><?php echo translate('relation'); ?></label>
                                    <div class="controls">
                                        <select name="relation_id" class="uniform" style="width:100%;">
											<option value="">Select Relation</option>
											<?php
												echo make_select('relation','relation_id','relation_name');
											?>
										</select>
                                    </div>
                                </div>
								</br>
								<h3> Academic Information</h3>
								<hr>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('Admission Form No'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="admission_form_no" placeholder="Enter admission form no"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('Registration No'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="registration_no" placeholder="Enter registration no"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('Student Id'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="student_unique_ID" placeholder="XX-XX-XXX" maxlength="7"/>
                                    </div>
                                </div>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('previous_exam_description'); ?></label>
                                    <div class="controls">
                                        <p>
                                            <input type="text" class="w300" name="prev_institution_name" placeholder="Enter institution name"/> 
											<input type="text" class="w300" name="prev_class_id" placeholder="Enter Class"/> 
                                            <input type="text" class="datepicker fill-up" name="prev_passing_yrs" placeholder="Enter passing years"/>                                        
                                            <input type="text" class="" name="prev_gpa" placeholder="Enter GPA"/> 
                                        </p>                                        
                                        <p>

                                        </p>
                                        <p style="margin: 0;">
                                            <textarea rows="4" cols="55" class="" name="prev_institution_address" placeholder="Enter village, post office, upozilla, district name."></textarea>
                                        </p>
                                    </div>
                                </div>

                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('TC_students_info'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="w300" name="tc_institution_name" placeholder="Enter institution name"/> 
                                        <input type="number" class="" name="tc_form_no" placeholder="Enter TC form no"/>                                            
                                        <input type="text" class="datepicker fill-up" name="tc_date" placeholder="Enter date"/>
                                    </div>
                                </div>
								
								<br>
                                <h3><label style="font-size: 16px; font-weight: 600;" for="admission_type_first">Admission information</label></h3>
								<hr>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('first_admission_info'); ?></label>
                                    <div class="controls">
                                        <select name="class_id" class="uniform validate[required]" style="width:100%;" id="class_id" onchange="classselection(this.value)">
                                            <option value="">- Select class -</option>
                                            <?php
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <select name="group" class="uniform" style="width:100%;" onchange="groupselectionold(this.value)" id="group_id">
                                            <option value="">Select group</option>
                                            <?php
												echo make_select('group','group_id','group_name');
											?>
                                        </select>
										<select name="section" class="uniform" style="width:100%;">
											<option value=""><?=translate('section')?></option>
											<?=make_select('class_section','section_name','section_name')?>
										</select>
                                        <!--<input type="text" class="" name="section" placeholder="Enter section"/>-->
                                        <input type="text" class="validate[required]" name="roll" placeholder="Enter roll no"/>&nbsp;
										<!--<input type="text" class="validate[required] w150" name="academic_year" placeholder="Enter Academic Year "/>-->
										<select name="academic_year" class="uniform validate[required]" style="width:100%;">
											<option value=""><?=translate('academic_year')?></option>
											<?=make_select('academic_year','academic_year','academic_year')?>
										</select>
                                    </div>
							<?php
								$subjects=$this->db->from('subject')->order_by('status,group_id')->get()->result();
								$subject_list='';
								foreach($subjects as $subject)
								{
									$subject_id=$subject->subject_id;
									$name=$subject->name;
									$class_id=$subject->class_id;
									$group_id=$subject->group_id;
									$status=$subject->status;
									
									$li_class='subjectlist class-'.$class_id;
									if($group_id)
										$li_class.=' group group_subject class-'.$class_id.'-group-'.$group_id;
									if($status)
										$li_class.=' fourth_subject';
									$sub_name="subject[]";
									if($group_id)
									{
										$sub_name="mainsubject[]";
									}
									if($status)
									{
										$sub_name="forthsubject[]";
									}
									$sub_checkbox="<input type='checkbox' name='".$sub_name."' value='".$subject_id."'>";
									if(!$group_id and !$status)
									{
										$sub_checkbox="<input type='checkbox' name='".$sub_name."' value='".$subject_id."' disabled='disabled' checked='checked'>";
									}
									if($status)
									$name.=" [Fourth Subject]";
									$subject_list.="<li class='".$li_class."'>".$sub_checkbox.$name."</li>";
								}
							?>
							
								<div class="control-group">
									<?php
										//echo $subject_str;
									?>
									<ul class="unstyled subjects">
									<?=$subject_list?>
									</ul>
								</div>
                                </div>
								<br>
                                <h3>If same guardian have other students in this institution</h3>
								<hr>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('other_students_info'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="w300" name="other_student_name" placeholder="Enter name"/>
                                        <select name="others_class_id" class="uniform" style="width:100%;">
                                            <option value="">- Select class -</option>
                                            <?php
                                            $classes = $this->db->get('class')->result_array();
                                            foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id']; ?>">
                                                    <?php echo $row['name']; ?>
                                                </option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                        <select name="group_others" class="uniform" style="width:100%;">
                                            <option value=" ">- Select group -</option>
                                            <?php
												echo make_select('group','group_id','group_name');
											?>
                                        </select>
										<select name="others_section" class="uniform" style="width:100%;">
											<option value=""><?=translate('others_section')?></option>
											<?=make_select('class_section','section_name','section_name')?>
										</select>
                                        <input type="text" class="" name="others_roll" placeholder="Enter roll no"/>  
                                    </div>
                                </div>
                                
								</br>
								<h3>On-line User Control</h3>
								<hr>			
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('email'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="email" placeholder="Enter email"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('password'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="password" placeholder="Enter password"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-gray"><?php echo translate('add_student'); ?></button>
                            </div>
                            <?php
                            echo form_close();
                        }else {
                            echo "<h4>You have exceed the number of students. Please contact with authoried person.</h4>";
                        }
                        ?>
                    </div>                
                </div>
                <!----CREATION FORM ENDS--->  
            </div>
        </div>
    </div>

<style>
	.subjects>li
	{
		display:none;
	}
</style>
<script>

$(document).ready(function () 
{
	$("#class_id,#group_id").change(function()
	{
		var class_id=$("#class_id").val();
		var group_id=$("#group_id").val();
		$(".subjectlist").hide();
		$(".class-"+class_id).show();
		if(group_id)
		{
			$(".group").hide();
			$(".class-"+class_id+"-group-"+group_id).show();
		}
		$('input[type="checkbox"]').not("[disabled]").removeAttr('checked');
	});
var limit = 3;
var forth = 1;
$('input.single-checkbox').on('change', function(evt) {

   if($(this).siblings(':checked').length >= limit) {
       alert('Select maximum ' + limit + ' Subjects!');
       this.checked = false;
   }
});


$('input.forth-checkbox').on('change', function(evt) {

   if($(this).siblings(':checked').length >= forth) {
       alert('Select maximum ' + forth + ' Subjects!');
       this.checked = false;
   }
});


	   $("input[name='mainsubject[]']").change(function () 
	   {
	      /*var maxAllowed = 3;
	      var cnt = $("input[name='mainsubject[]']:checked").length;
	      if (cnt > maxAllowed)
	      {
	         $(this).prop("checked", "");
	         alert('Select maximum ' + maxAllowed + ' Subjects!');
	     }*/
  });
  
  $("input[name='forthsubject[]']").change(function () {
	      var maxAllowed = 1;
	      var cnt = $("input[name='forthsubject[]']:checked").length;
	      if (cnt > maxAllowed)
	      {
	         $(this).prop("checked", "");
	         alert('Select maximum ' + maxAllowed + ' Subject!');
	     }
  });
  
  });
  


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	
	function classselection(value){
	if(value<9)
		{
		$("#Humanities").css({ "display": "none" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });	
		}
	
	}

	function groupselectionold(value){
	var classid=$("#class_id").val();
	if(classid==10||classid==9)
	{
	if(value==1)
		{
		$("#science").css({ "display": "block" }); 
		$("#Business").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value==2)
		{
		$("#Business").css({ "display": "block" });
		$("#science").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value==3)
		{
		$("#Humanities").css({ "display": "block" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });		
		}
	}
	/*else if(classid==11)
	{
	if(value=="science")
		{
		$("#science").css({ "display": "block" }); 
		$("#Business").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		}
	if(value=="commerce")
		{
		$("#Business").css({ "display": "block" });
		$("#science").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		}
	if(value=="humanities")
		{
		$("#Humanities").css({ "display": "block" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });	
        $("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });		
		}
	}*/
	
	
	} 
	  
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>