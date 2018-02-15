<div class="tab-pane box active edit-student-container" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('teacher/student/' . $class_id . '/do_update/' . $row['student_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>
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
                        <input type="text" class="validate[required]" name="admission_form_no" value="<?php echo $row['admission_form_no']; ?>" placeholder="Enter admission form no"/>
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
                        <input type="text" class="validate[required]" name="name" value="<?php echo $row['name']; ?>"/>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('father_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="father_name" value="<?php echo $row['father_name']; ?>"/>
                        <input type="number" class="w100" name="father_age" value="<?php echo $row['father_age']; ?>"/>
                        <input type="text" class="" name="father_education" value="<?php echo $row['father_education']; ?>"/>
                        <input type="text" class="" name="father_occupation" value="<?php echo $row['father_occupation']; ?>"/>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('mother_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="mother_name" value="<?php echo $row['mother_name']; ?>"/>
                        <input type="number" class="w100" name="mother_age" value="<?php echo $row['mother_age']; ?>"/>
                        <input type="text" class="" name="mother_education" value="<?php echo $row['mother_education']; ?>"/>
                        <input type="text" class="" name="mother_occupation" value="<?php echo $row['mother_occupation']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('present_address'); ?></label>
                    <div class="controls">
                        <textarea rows="4" cols="55" class=""  name="present_address"><?php echo $row['present_address']; ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('permanent_address'); ?></label>
                    <div class="controls">
                        <textarea rows="4" cols="55" class=""  name="permanent_address"><?php echo $row['permanent_address']; ?></textarea>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('guardian_info'); ?></label>
                    <div class="controls">
                        <p>
                            <input type="text" class="" name="guardian_name" value="<?php echo $row['guardian_name']; ?>"/>
                            <input type="number" class="w100" name="guardian_age" value="<?php echo $row['guardian_age']; ?>"/>                                        
                            <input type="text" class="" name="guardian_profession" value="<?php echo $row['guardian_profession']; ?>"/> 
                        </p>                                        
                        <p>
                            <input type="text" class="w300" name="guardian_income" value="<?php echo $row['guardian_income']; ?>"/>
                            <input type="number" class="w300" name="guardian_land" value="<?php echo $row['guardian_land']; ?>"/>
                        </p>
                        <p style="margin: 0;">
                            <textarea rows="4" cols="55" class="" name="guardian_address" ><?php echo $row['guardian_address']; ?></textarea>
                        </p>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('birthday'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="birthday" value="<?php echo $row['birthday']; ?>"/>
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
                        <input type="text" class="" name="religion" value="<?php echo $row['religion']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('nationality'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="nationality" value="<?php echo $row['nationality']; ?>"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label"><?php echo translate('phone'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="phone" value="<?php echo $row['phone']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('email'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="email" value="<?php echo $row['email']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('password'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="password" value="<?php echo $row['password']; ?>"/>
                    </div>
                </div>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('previous_exam_description'); ?></label>
                    <div class="controls">
                        <p>
                            <input type="text" class="w300" name="prev_institution_name" value="<?php echo $row['prev_institution_name']; ?>"/> 
                            <select name="prev_class_id" class="uniform" style="width:100%;">
                                <option value="">- Class -</option>
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
                            <input type="text" class="datepicker fill-up" name="prev_passing_yrs" value="<?php echo $row['prev_passing_yrs']; ?>"/>                                        
                            <input type="text" class="" name="prev_gpa" value="<?php echo $row['prev_gpa']; ?>"/> 
                        </p>                                        
                        <p>

                        </p>
                        <p style="margin: 0;">
                            <textarea rows="4" cols="55" class="" name="prev_institution_address"><?php echo $row['prev_institution_address']; ?></textarea>
                        </p>
                    </div>
                </div>

                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('TC_students_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="tc_institution_name" value="<?php echo $row['tc_institution_name']; ?>"/> 
                        <input type="number" class="" name="tc_form_no" value="<?php echo $row['tc_form_no']; ?>"/>                                            
                        <input type="text" class="datepicker fill-up" name="tc_date" value="<?php echo $row['tc_date']; ?>"/>
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
                            <option value="science">Science</option>
                            <option value="humanities">Humanities</option>
                            <option value="commerce">Commerce</option>
                        </select>
                        <input type="text" class="" name="section" value="<?php echo $row['section']; ?>"/>
                        <input type="text" class="" name="roll" value="<?php echo $row['roll']; ?>"/>                                      
                        <input type="text" class="datepicker fill-up" name="passing_year" value="<?php echo $row['passing_year']; ?>"/>
                    </div>
                </div> 

                <h3>
                    <input type="radio" name="admission_type" id="admission_type_first" value="first-admission"/>
                    <label style="display: inline-block; margin-left: 5px; font-size: 20px; font-weight: 600;" for="admission_type_first">First admission information in this institution-</label>
                </h3>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('first_admission_info'); ?></label>
                    <div class="controls">
                        <select name="class_id" class="uniform" style="width:100%;">
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
                            <option value="science">Science</option>
                            <option value="humanities">Humanities</option>
                            <option value="commerce">Commerce</option>
                        </select>
                        <input type="text" class="" name="section" value="<?php echo $row['section']; ?>"/>
                        <input type="text" class="" name="roll" value="<?php echo $row['roll']; ?>"/>  
                    </div>
                </div>

                <h3>If same guardian have other students in this institution-</h3>
                <div class="control-group custom-block">
                    <label class="control-label"><?php echo translate('other_students_info'); ?></label>
                    <div class="controls">
                        <input type="text" class="w300" name="other_student_name" value="<?php echo $row['other_student_name']; ?>"/>
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
                        <input type="text" class="" name="others_section" value="<?php echo $row['others_section']; ?>"/>
                        <input type="text" class="" name="others_roll" value="<?php echo $row['others_roll']; ?>"/>  
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