<?php
	$this->db->select('class_id,name');
	$this->db->from('class');
	$classes=$this->db->get()->result();
	$group_subjects=get_single_value('subject_id','student',array('student_id'=>$student_id));
	$subject_ids=explode('SC',$group_subjects);
	$group_subjects=array();
	foreach($subject_ids as $id)
	{
		if($id)
		{
			$group_subjects[]=$id;
		}
	}
	$subject_str='';
	$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$student_id));
	foreach($classes as $classt)
	{
		$class_id=$classt->class_id;
		$class_name=$classt->name;
		$subject_str.='<ul class="unstyled class-subject class-'.$class_id.'">';

		$subject_str.='<li class="list-header">General Subject</li>';
		$this->db->where('class_id',$class_id);
		$this->db->where('group_id',0);
		$this->db->where('status',0);
		$subjects=$this->db->from('subject')->get()->result();
		foreach($subjects as $subject)
		{
			$subject_id=$subject->subject_id;
			$subject_namae=$subject->name;
			$subject_str.='<li><input type="checkbox" name="subject" disabled="disabled" checked="checked" value='.$subject_id.'>'.$subject_namae.'</li>';
		}
		$this->db->select('group_id,group_name');
		$groups=$this->db->from('group')->get()->result();
		$group_subject_str='';
		foreach($groups as $group)
		{
			$group_id=$group->group_id;
			$group_name=$group->group_name;
			$this->db->where('class_id',$class_id);
			$this->db->where('group_id',$group_id);
			$this->db->where('status',0);
			$subjects=$this->db->from('subject')->get()->result();
			foreach($subjects as $subject)
			{
				$subject_id=$subject->subject_id;
				$subject_namae=$subject->name;
				if(in_array($subject_id,$group_subjects))
				$str.='<li><input type="checkbox" name="mainsubject[]" value='.$subject_id.' checked="true">'.$subject_namae.'</li>';
				else
				$str.='<li><input type="checkbox" name="mainsubject[]" value='.$subject_id.'>'.$subject_namae.'</li>';
			}
			if($str)
			{
				$ul_class_name="class-".$class_id."-group-".$group_id;
				$group_subject_str.='<ul class="unstyled group-subject '.$ul_class_name.'">';		
				$group_subject_str.='<li class="list-header">Group Subject</li>';
				$group_subject_str.=$str;
				$group_subject_str.='</ul>';
			}
			$str='';
			$this->db->where('class_id',$class_id);
			$this->db->where('group_id',$group_id);
			$this->db->where('status',1);
			$subjects=$this->db->from('subject')->get()->result();
			foreach($subjects as $subject)
			{
				$subject_id=$subject->subject_id;
				$subject_namae=$subject->name;
				$str.='<li><input type="checkbox" name="forthsubject[]" value='.$subject_id;
				if($fourth_subject==$subject_id)
				$str.=' checked="true"';
				$str.='>'.$subject_namae.'</li>';
				/*else
				$str.='<li><input type="checkbox" name="forthsubject[]" value='.$subject_id.'>'.$subject_namae.'</li>';*/
			}
			if($str)
			{
				$ul_class_name="class-".$class_id."-group-".$group_id;
				$group_subject_str.='<ul class="unstyled group-subject '.$ul_class_name.'">';
				$group_subject_str.='<li class="list-header">Fourth Subject</li>';
				$group_subject_str.=$str;
				$group_subject_str.='</ul>';
			}
		}
		$subject_str.=$group_subject_str;
		$nogroup_fourth_str='';
		$this->db->where('class_id',$class_id);
		$this->db->where('group_id','0');
		$this->db->where('status',1);
		$subjects=$this->db->from('subject')->get()->result();
		foreach($subjects as $subject)
		{
			$subject_id=$subject->subject_id;
			$subject_namae=$subject->name;
			$nogroup_fourth_str.='<li><input type="checkbox" name="forthsubject[]" value='.$subject_id;
			if($fourth_subject==$subject_id)
			{
				$nogroup_fourth_str.=' checked=true ';
			}
				$nogroup_fourth_str.='>'.$subject_namae.'</li>';
		}
		if($nogroup_fourth_str)
		{
			$subject_str.='<ul class="unstyled class-'.$class_id.'-all"><li class="list-header">Fourth Subject for all group</li>'.$nogroup_fourth_str.'</ul>';
		}
		$subject_str.='</ul>';
	}
?>
<div class="tab-pane box active edit-student-container" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('admin/student/' . $row['class_id']. '/do_update/' . $row['student_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"></label>
                    <div class="controls" style="width:210px;">
                        <div class="avatar">
                            <img style="width:210px;" id="blah" class="avatar-large" src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" height="100"  />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('photo'); ?></label>
                    <div class="controls" style="width:210px;">
                        <input type="file" class="" name="userfile" id="imgInp" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Admission Form No'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="admission_form_no" value="<?php echo $row['admission_form_no']; ?>" placeholder="Enter admission form no"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Registration No'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="registration_no" value="<?php echo $row['registration_no']; ?>" placeholder="Enter registration no"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Student Id'); ?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="student_unique_ID"  value="<?php echo $row['student_unique_ID']; ?>" placeholder="XX-XX-XXX"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('name'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="name" value="<?php echo $row['name']; ?>" placeholder="Enter Student Name"/>
						<input type="text" class="" name="nick_name" value="<?php echo $row['nick_name']; ?>" placeholder="<?=$nick_name?>"/>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label"><?php echo translate('maritial_status'); ?></label>
                    <div class="controls">
                        <select name="maritial_status" class="uniform" style="width:100%;">
							<option value="unmarried" <?php if($row['maritial_status']=='unmarried') echo "selected";?>><?php echo translate('unmarried'); ?></option>
                            <option value="married" <?php if($row['maritial_status']=='married') echo "selected";?>><?php echo translate('married'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('father_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="father_name" value="<?php echo $row['father_name']; ?>" placeholder="Enter Name"/>
                        <input type="number" class="w100" name="father_age" value="<?php echo $row['father_age']; ?>" placeholder="Enter Age"/>
                        <input type="text" class="" name="father_education" value="<?php echo $row['father_education']; ?>"placeholder="Enter Education"/>
                        <input type="text" class="" name="father_occupation" value="<?php echo $row['father_occupation']; ?>" placeholder="Enter Occupation"/>
						<input type="text" class="" name="father_mobile" value="<?php echo $row['father_mobile']; ?>" placeholder="Enter Mobile Number"/>
						<input type="text" class="datepicker fill-up" name="father_birthday" value="<?php echo $row['father_birthday']; ?>" placeholder="Birthday"/>
						<?php
							$father_blood_group=$row['father_blood_group'];
						?>
						<select name="father_blood_group" class="uniform" style="width:100%;">
								<option value="">Select Blood Group</option>
                                <option value="O-" <?php if($father_blood_group=='O-') echo " selected"; ?> ><?php echo translate('O-');?></option>
                                <option value="O+" <?php if($father_blood_group=='O+') echo " selected"; ?> ><?php echo translate('O+');?></option>
                                <option value="A-" <?php if($father_blood_group=='A-') echo " selected"; ?> ><?php echo translate('A-');?></option>
                                <option value="A+" <?php if($father_blood_group=='A+') echo " selected"; ?> ><?php echo translate('A+');?></option>
                                <option value="B-" <?php if($father_blood_group=='B-') echo " selected"; ?> ><?php echo translate('B-');?></option>
                                <option value="B+" <?php if($father_blood_group=='B+') echo " selected"; ?> ><?php echo translate('B+');?></option>
                                <option value="AB-" <?php if($father_blood_group=='AB-') echo " selected"; ?> ><?php echo translate('AB-');?></option>
                                <option value="AB+" <?php if($father_blood_group=='AB+') echo " selected"; ?> ><?php echo translate('AB+');?></option>
							</select>
						<input type="text" class="" name="father_nidnumber" value="<?php echo $row['father_nidnumber']; ?>" placeholder="Enter National ID Card Number"/>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('mother_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="mother_name" value="<?php echo $row['mother_name']; ?>" placeholder="Enter Name"/>
                        <input type="number" class="w100" name="mother_age" value="<?php echo $row['mother_age']; ?>" placeholder="Enter Age"/>
                        <input type="text" class="" name="mother_education" value="<?php echo $row['mother_education']; ?>" placeholder="Enter Education"/>
                        <input type="text" class="" name="mother_occupation" value="<?php echo $row['mother_occupation']; ?>" placeholder="Enter Ocupation"/>
						<input type="text" class="" name="mother_mobile" value="<?php echo $row['mother_mobile']; ?>" placeholder="Enter Mobiile Number"/>
						<input type="text" class="datepicker fill-up" name="mother_birthday" value="<?php echo $row['mother_birthday']; ?>" placeholder="Enter Brthday"/>
						<?php
							$mother_blood_group=$row['mother_blood_group'];
						?>
						<select name="mother_blood_group" class="uniform" style="width:100%;">
								<option value="">Select Blood Group</option>
                                <option value="O-" <?php if($mother_blood_group=='O-') echo " selected"; ?> ><?php echo translate('O-');?></option>
                                <option value="O+" <?php if($mother_blood_group=='O+') echo " selected"; ?> ><?php echo translate('O+');?></option>
                                <option value="A-" <?php if($mother_blood_group=='A-') echo " selected"; ?> ><?php echo translate('A-');?></option>
                                <option value="A+" <?php if($mother_blood_group=='A+') echo " selected"; ?> ><?php echo translate('A+');?></option>
                                <option value="B-" <?php if($mother_blood_group=='B-') echo " selected"; ?> ><?php echo translate('B-');?></option>
                                <option value="B+" <?php if($mother_blood_group=='B+') echo " selected"; ?> ><?php echo translate('B+');?></option>
                                <option value="AB-" <?php if($mother_blood_group=='AB-') echo " selected"; ?> ><?php echo translate('AB-');?></option>
                                <option value="AB+" <?php if($mother_blood_group=='AB+') echo " selected"; ?> ><?php echo translate('AB+');?></option>
							</select>
						<input type="text" class="" name="mother_nidnumber" value="<?php echo $row['mother_nidnumber']; ?>" placeholder="Enter National ID Card Number"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('present_address'); ?></label>
                    <div class="controls">
                        <textarea rows="4" cols="55" class=""  name="present_address" placeholder="Enter Village, Post office, Upozilla, District Name"><?php echo $row['present_address']; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('permanent_address'); ?></label>
                    <div class="controls">
                        <textarea rows="4" cols="55" class=""  name="permanent_address" placeholder="Enter Village, Post office, Upozilla, District Name"><?php echo $row['permanent_address']; ?></textarea>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('guardian_info'); ?></label>
                    <div class="controls">
                        <p>
                            <input type="text" class="" name="guardian_name" value="<?php echo $row['guardian_name']; ?>" placeholder="Enter Name"/>
                            <input type="number" class="w100" name="guardian_age" value="<?php echo $row['guardian_age']; ?>" placeholder="Enter Age"/>                                        
                            <input type="text" class="" name="guardian_profession" value="<?php echo $row['guardian_profession']; ?>" placeholder="Enter Profeesion"/> 
							<input type="text" class="" name="gardian_mobile" value="<?php echo $row['gardian_mobile']; ?>" placeholder="Enter Mobile Number"/>
						<input type="text" class="datepicker fill-up" name="guardian_birthday" value="<?php echo $row['guardian_birthday']; ?>" placeholder="Enter Birthday"/>
						<?php
							$gardian_blood_group=$row['gardian_blood_group'];
						?>
						<select name="gardian_blood_group" class="uniform" style="width:100%;">
								<option value="">Select Blood Group</option>
                                <option value="O-" <?php if($gardian_blood_group=='O-') echo " selected"; ?> ><?php echo translate('O-');?></option>
                                <option value="O+" <?php if($gardian_blood_group=='O+') echo " selected"; ?> ><?php echo translate('O+');?></option>
                                <option value="A-" <?php if($gardian_blood_group=='A-') echo " selected"; ?> ><?php echo translate('A-');?></option>
                                <option value="A+" <?php if($gardian_blood_group=='A+') echo " selected"; ?> ><?php echo translate('A+');?></option>
                                <option value="B-" <?php if($gardian_blood_group=='B-') echo " selected"; ?> ><?php echo translate('B-');?></option>
                                <option value="B+" <?php if($gardian_blood_group=='B+') echo " selected"; ?> ><?php echo translate('B+');?></option>
                                <option value="AB-" <?php if($gardian_blood_group=='AB-') echo " selected"; ?> ><?php echo translate('AB-');?></option>
                                <option value="AB+" <?php if($gardian_blood_group=='AB+') echo " selected"; ?> ><?php echo translate('AB+');?></option>
							</select>
						<input type="text" class="" name="guardian_nid" value="<?php echo $row['guardian_nid']; ?>" placeholder="Enter National ID Card Number"/>
                        </p>                                        
                        <p>
                            <input type="text" class="w300" name="guardian_income" value="<?php echo $row['guardian_income']; ?>" placeholder="Enter Income Information"/>
                            <input type="number" class="w300" name="guardian_land" value="<?php echo $row['guardian_land']; ?>" placeholder="Enter Amount Of land"/>
                        </p>
                        <p style="margin: 0;">
                            <textarea rows="4" cols="55" class="" name="guardian_address" placeholder="Enter Village, Post office, Upozilla, District Name"><?php echo $row['guardian_address']; ?></textarea>
                        </p>
						<p style="margin: 0;">
                            <select name="relation_id" class="uniform" style="width:100%;">
								<option value="">Relation</option>
								<?php
									echo make_select('relation','relation_id','relation_name',$row['relation_id']);
								?>
							</select>
						</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('birthday'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="birthday" value="<?php echo $row['birthday']; ?>" placeholder="Enter Birthday"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('sex'); ?></label>
                    <div class="controls">
                        <select name="sex" class="uniform" style="width:100%;">
                            <option value="male" <?php if ($row['sex'] == 'male') echo 'selected'; ?>><?php echo translate('male'); ?></option>
                            <option value="female" <?php if ($row['sex'] == 'female') echo 'selected'; ?>><?php echo translate('female'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('religion'); ?></label>
                    <div class="controls">
						<select name="religion" class="uniform" style="width:100%;">
							<option value="">Select Religion</option>
							<?php
								echo make_select('religion','religion_id','religion_name',$row['religion']);
							?>
						</select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('nationality'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="nationality" value="<?php echo $row['nationality']; ?>" placeholder="Enter Nationality"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo translate('phone'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="phone" value="<?php echo $row['phone']; ?>" placeholder="Enter Mobile Number"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('email'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="email" value="<?php echo $row['email']; ?>" placeholder="Enter Mail Address"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('password'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="password" value="<?php echo $row['password']; ?>" placeholder="Enter Password"/>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('previous_exam_description'); ?></label>
                    <div class="controls">
                        <p>
                            <input type="text" class="w300" name="prev_institution_name" value="<?php echo $row['prev_institution_name']; ?>" placeholder="Enter Institute Name"/> 
                            <input type="text" class="w300" name="prev_class_id" value="<?php echo $row['prev_class_id']; ?>" placeholder="Enter Class"/> 
                            <input type="text" class="datepicker fill-up" name="prev_passing_yrs" value="<?php echo $row['prev_passing_yrs']; ?>" placeholder="Enter Passing Year"/>                                        
                            <input type="text" class="" name="prev_gpa" value="<?php echo $row['prev_gpa']; ?>" placeholder="Enter GPA"/> 
                        </p>                                        
                        <p>

                        </p>
                        <p style="margin: 0;">
                            <textarea rows="4" cols="55" class="" name="prev_institution_address" placeholder="Enter Village, Post office, Upozilla, District Name"><?php echo $row['prev_institution_address']; ?></textarea>
                        </p>
                    </div>
                </div>

                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('TC_students_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="tc_institution_name" value="<?php echo $row['tc_institution_name']; ?>" placeholder="Enter Institute Name"/> 
                        <input type="number" class="" name="tc_form_no" value="<?php echo $row['tc_form_no']; ?>"  placeholder="Enter Form Number"/>                                            
                        <input type="text" class="datepicker fill-up" name="tc_date" value="<?php echo $row['tc_date']; ?>"  placeholder="Enter Date"/>
                    </div>
                </div>                

                <h3><input type="radio" name="admission_type" id="admission_type_re" value="re-admission"/><label style="display: inline-block; margin-left: 5px; font-size: 20px; font-weight: 600;" for="admission_type_re">Re admission information in this institution-</label></h3>
                <div class="control-group custom-block">                                    
                    <label class="control-label"><?php echo translate('re_admission_students_info'); ?></label>
                    <div class="controls">
                        <select name="re_class_id" class="uniform" style="width:100%;">
                            <option value="">- Select class -</option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row_class):
                                if ($row['class_id'] == $row_class['class_id']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $row_class['class_id']; ?>">
                                    <?php echo $row_class['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <select name="group" class="uniform" style="width:100%;">
                            <option value="">- Select group -</option>
                            <?php
								echo make_select('group','group_id','group_name');
							?>
                        </select>
                        <input type="text" class="" name="section" value="<?php echo $row['section']; ?>"  placeholder="Enter Section"/>
                        <input type="text" class="input input-small" name="roll" value="<?php echo $row['roll']; ?>" placeholder="Enter Roll"/>                                   
                        <input type="text" class="datepicker fill-up" name="passing_year" placeholder="Enter Passing Year"/>
                    </div>
                </div> 

                <h3>
                    <input type="radio" name="admission_type" id="admission_type_first" value="first-admission" checked=""/>
                    <label style="display: inline-block; margin-left: 5px; font-size: 20px; font-weight: 600;" for="admission_type_first">First admission information in this institution-</label>
                </h3>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('first_admission_info'); ?></label>
                    <div class="controls">
                        <select name="class_id" class="uniform" style="width:100%;" id="class_id">
                            <option value="">- Select class -</option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row_class):
                                if ($row['class_id'] == $row_class['class_id']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $row_class['class_id']; ?>">
                                    <?php echo $row_class['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <select name="group" class="uniform" style="width:100%;" id="group_id">
                            <option value="">- Select group -</option>
                             <?php
								echo make_select('group','group_id','group_name',$row['group']);
							?>
                        </select>
                        <input type="text" class="" name="section" value="<?php echo $row['section']; ?>" placeholder="Enter Section"/>
                        <input type="text" class="" name="roll" value="<?php echo $row['roll']; ?>" placeholder="Enter Roll"/>
						<input type="text" class="validate[required] w150" name="academic_year" placeholder="Enter Academic Year " value="<?=$row['academic_year']?>"/>
                    </div>
					<div class="control-group">
									<?php
										echo $subject_str;
									?>
								</div>
								<style>
	ul.class-subject
	{
		display:none;
	}
	ul.class-<?php echo $row['class_id'];?>
	{
		display:block;
	}
	.group-subject
	{
		display: none;
	}
	.class-<?php echo $row['class_id'];?>-group-<?php echo $row['group'];?>
	{
		display: block;
	}
</style>
                </div>

                <h3>If same guardian have other students in this institution-</h3>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('other_students_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="other_student_name" value="<?php echo $row['other_student_name']; ?>" placeholder="Enter Student Name"/>
                        <select name="others_class_id" class="uniform" style="width:100%;">
                            <option value="">- Class -</option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row_class):
                                if ($row_class['class_id'] == $row['others_class_id']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $row_class['class_id']; ?>">
                                    <?php echo $row_class['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
						<select name="group_others" class="uniform" style="width:100%;">
                            <option value="0">- Select group -</option>
                            <?php
								echo make_select('group','group_id','group_name',$row['group_others']);
							?>
                        </select>
                        <input type="text" class="" name="others_section" value="<?php echo $row['others_section']; ?>" placeholder="Enter Section"/>
                        <input type="text" class="" name="others_roll" value="<?php echo $row['others_roll']; ?>" placeholder="Enter Roll"/>  
                    </div>
                </div>                
                <div class="control-group">                           
                    <label class="control-label"><?php echo translate('clearance_no'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="clearance_no" value="<?php echo $row['clearance_no']; ?>"/>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-gray"><?php echo translate('edit_student'); ?></button>
                </div>
                </form>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>

$(document).ready(function () 
{
	$("#group_id,#class_id").change();
	$("#class_id,#group_id").change(function()
	{
		var class_id=$("#class_id").val();
		var group_id=$("#group_id").val();
		$(".class-subject").hide();
		$(".class-"+class_id).show();
		if(group_id)
		{
			$(".group-subject").hide();
			$(".class-"+class_id+"-group-"+group_id).show();	
		}
		//$('input[type="checkbox"]').not("[disabled]").removeAttr('checked');
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


	   $("input[name='mainsubject[]']").change(function () {
	      var maxAllowed = 3;
	      var cnt = $("input[name='mainsubject[]']:checked").length;
	      if (cnt > maxAllowed)
	      {
	         $(this).prop("checked", "");
	         alert('Select maximum ' + maxAllowed + ' Subjects!');
	     }
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
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>