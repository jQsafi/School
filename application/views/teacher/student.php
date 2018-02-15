<?php if ($class_id != ""): ?>
    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo translate('student_list'); ?>
                    </a></li>
                <li>
                    <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                        <?php echo translate('add_student'); ?>
                    </a></li>
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <div class="tab-pane  active" id="list">
                    <center>
                        <br />
                        <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?teacher/student/'+this.value">
                            <option value=""><?php echo translate('select_a_class'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>"
                                        <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                    Class <?php echo $row['name']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <br /><br />
                        <?php if ($class_id == ''): ?>
                            <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                                <i class="icon-info-sign"></i> Please select a class to manage student.
                            </div>
                            <script>
                                $(document).ready(function() {
                                                                                                                                                                        						  	
                                    function shake()
                                    {
                                        $( "#ask_class" ).effect( "shake" );
                                    }
                                    setTimeout(shake, 500);
                                });
                            </script>
                            <br /><br />
                        <?php endif; ?>
                        <?php if ($class_id != ''): ?>

                            <div class="action-nav-normal">
                                <div class=" action-nav-button" style="width:300px;">
                                    <a href="#" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span>Total <?php echo count($students); ?> students</span>
                                    </a>
                                </div>
                            </div>
                        </center>
                        <div class="box">
                            <div class="box-content">
                                <div id="dataTables">
                                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive ">
                                        <thead>
                                            <tr>
                                                <th width="60"><div><?php echo translate('roll'); ?></div></th>
                                        <th width="80"><div><?php echo translate('photo'); ?></div></th>
                                        <th width="140"><div><?php echo translate('student_name'); ?></div></th>
                                        <th class="span3"><div><?php echo translate('present_address'); ?></div></th>
                                        <th><div><?php echo translate('email'); ?></div></th>
                                        <th><div><?php echo translate('options'); ?></div></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($students as $row):
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['roll']; ?></td>
                                                    <td><div class="avatar"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-medium" /></div></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['present_address']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td align="center" class="span5">
                                                        <a  data-toggle="modal" href="#modal-form" onclick="modal('student_profile',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                            <i class="icon-user"></i> <?php echo translate('profile'); ?>
                                                        </a>
                                                        <a  data-toggle="modal" href="#modal-form" onclick="modal('student_academic_result',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                            <i class="icon-file-alt"></i> <?php echo translate('marksheet'); ?>
                                                        </a>
                                                        <a  data-toggle="modal" href="#modal-form" onclick="modal('student_id_card',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                            <i class="icon-credit-card"></i> <?php echo translate('id_card'); ?>
                                                        </a>
                                                        <?php if ($this->session->userdata('user_role') != 'accountant') { ?>
                                                            <a  data-toggle="modal" href="#modal-form" onclick="modal('edit_student',<?php echo $row['student_id']; ?>,<?php echo $class_id; ?>)" class="btn btn-gray btn-small">
                                                                <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                                            </a>
                                                            <a  data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>')" class="btn btn-red btn-small">
                                                                <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php /* <div class="tab-pane  active" id="list">
                  <center>
                  <br />
                  <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?teacher/student/'+this.value">
                  <option value=""><?php echo translate('select_a_class'); ?></option>
                  <?php
                  $classes = $this->db->get('class')->result_array();
                  foreach ($classes as $row):
                  ?>
                  <option value="<?php echo $row['class_id']; ?>"
                  <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                  Class <?php echo $row['name']; ?></option>
                  <?php
                  endforeach;
                  ?>
                  </select>
                  <br /><br />
                  <?php if ($class_id == ''): ?>
                  <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                  <i class="icon-info-sign"></i> Please select a class to manage student.
                  </div>
                  <script>
                  $(document).ready(function() {

                  function shake()
                  {
                  $( "#ask_class" ).effect( "shake" );
                  }
                  setTimeout(shake, 500);
                  });
                  </script>
                  <br /><br />
                  <?php endif; ?>
                  <?php if ($class_id != ''): ?>

                  <div class="action-nav-normal">
                  <div class=" action-nav-button" style="width:300px;">
                  <a href="#" title="Users">
                  <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                  <span>Total <?php echo count($students); ?> students</span>
                  </a>
                  </div>
                  </div>
                  </center>
                  <div class="box">
                  <div class="box-content">
                  <div id="dataTables">
                  <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive ">
                  <thead>
                  <tr>
                  <th><div><?php echo translate('roll'); ?></div></th>
                  <th width="80"><div><?php echo translate('photo'); ?></div></th>
                  <th><div><?php echo translate('student_name'); ?></div></th>
                  <th class="span3"><div><?php echo translate('address'); ?></div></th>
                  <th><div><?php echo translate('email'); ?></div></th>
                  <th><div><?php echo translate('options'); ?></div></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $count = 1;
                  foreach ($students as $row):
                  ?>
                  <tr>
                  <td class="span1"><?php echo $row['roll']; ?></td>
                  <td><div class="avatar"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-medium" /></div></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td align="center" class="span5">


                  <a  data-toggle="modal" href="#modal-form" onclick="modal('student_profile',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                  <i class="icon-user"></i> <?php echo translate('profile'); ?>
                  </a>
                  <a  data-toggle="modal" href="#modal-form" onclick="modal('student_academic_result',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                  <i class="icon-file-alt"></i> <?php echo translate('marksheet'); ?>
                  </a>
                  <a  data-toggle="modal" href="#modal-form" onclick="modal('student_id_card',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                  <i class="icon-credit-card"></i> <?php echo translate('id_card'); ?>
                  </a>
                  <a  data-toggle="modal" href="#modal-form" onclick="modal('edit_student',<?php echo $row['student_id']; ?>,<?php echo $class_id; ?>)" class="btn btn-gray btn-small">
                  <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                  </a>
                  <a  data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>')" class="btn btn-red btn-small">
                  <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                  </a>



                  <!--<a href="<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/personal_profile/<?php echo $row['student_id']; ?>"
                  class="btn btn-gray">
                  <i class="icon-wrench"></i> <?php echo translate('personal_profile'); ?>
                  </a>
                  <a href="<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/academic_result/<?php echo $row['student_id']; ?>"
                  class="btn btn-gray">
                  <i class="icon-wrench"></i> <?php echo translate('academic_result'); ?>
                  </a>
                  <a href="<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/edit/<?php echo $row['student_id']; ?>"
                  class="btn btn-gray">
                  <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                  </a>
                  <a href="<?php echo base_url(); ?>index.php?teacher/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>" onclick="return confirm('delete?')"
                  class="btn btn-red">
                  <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                  </a>-->



                  </td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                  </table>
                  </div>
                  </div>
                  </div>
                  <?php endif; ?>
                  </div> */ ?>
                <!----TABLE LISTING ENDS--->


                <!----CREATION FORM STARTS---->
                <div class="tab-pane box add-student-container" id="add" style="padding: 5px">
                    <?php if (count($students_number) <= 500) { ?>
                        <div class="box-content">
                            <?php echo form_open('teacher/student/create/', array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data')); ?>
                            <div class="padded">                                
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
                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('name'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="validate[required]" name="name" placeholder="Enter Name"/>
                                    </div>
                                </div>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('father_info'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="w300" name="father_name" placeholder="Enter Name"/>
                                        <input type="number" class="w100" name="father_age" placeholder="Age"/>
                                        <input type="text" class="" name="father_education" placeholder="Enter Education"/>
                                        <input type="text" class="" name="father_occupation" placeholder="Enter Occupation"/>
                                    </div>
                                </div>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('mother_info'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="w300" name="mother_name" placeholder="Enter name"/>
                                        <input type="number" class="w100" name="mother_age" placeholder="Age"/>
                                        <input type="text" class="" name="mother_education" placeholder="Enter education"/>
                                        <input type="text" class="" name="mother_occupation" placeholder="Enter occupation"/>
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
                                            <input type="number" class="w300" name="guardian_land" placeholder="Enter the amount of land (Percent)"/>
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
                                    <label class="control-label"><?php echo translate('religion'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="" name="religion" placeholder="Enter religion"/>
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

                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('previous_exam_description'); ?></label>
                                    <div class="controls">
                                        <p>
                                            <input type="text" class="w300" name="prev_institution_name" placeholder="Enter institution name"/> 
                                            <select name="prev_class_id" class="uniform" style="width:100%;">
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

                                <h3><input type="radio" name="admission_type" id="admission_type_re" value="re-admission"/><label style="display: inline-block; margin-left: 5px; font-size: 20px; font-weight: 600;" for="admission_type_re">Re admission information in this institution-</label></h3>
                                <div class="control-group custom-block">                                    
                                    <label class="control-label"><?php echo translate('re_admission_students_info'); ?></label>
                                    <div class="controls">
                                        <select name="re_class_id" class="uniform" style="width:100%;">
                                            <option value="">- Select Class -</option>
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
                                        <select name="group" class="uniform" style="width:100%;">
                                            <option value="">- Select group -</option>
                                            <option value="science">Science</option>
                                            <option value="humanities">Humanities</option>
                                            <option value="commerce">Commerce</option>
                                        </select>
                                        <input type="text" class="" name="section" placeholder="Enter section"/>
                                        <input type="text" class="" name="roll" placeholder="Enter roll no"/>                                      
                                        <input type="text" class="datepicker fill-up" name="passing_year" placeholder="Enter passing year"/>
                                    </div>
                                </div> 

                                <h3><input type="radio" name="admission_type" id="admission_type_first" value="first-admission"/><label style="display: inline-block; margin-left: 5px; font-size: 20px; font-weight: 600;" for="admission_type_first">First admission information in this institution-</label></h3>
                                <div class="control-group custom-block">
                                    <label class="control-label"><?php echo translate('first_admission_info'); ?></label>
                                    <div class="controls">
                                        <select name="class_id" class="uniform" style="width:100%;">
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
                                        <select name="group" class="uniform" style="width:100%;">
                                            <option value="">- Select group -</option>
                                            <option value="science">Science</option>
                                            <option value="humanities">Humanities</option>
                                            <option value="commerce">Commerce</option>
                                        </select>
                                        <input type="text" class="" name="section" placeholder="Enter section"/>
                                        <input type="text" class="" name="roll" placeholder="Enter roll no"/>  
                                    </div>
                                </div>

                                <h3>If same guardian have other students in this institution-</h3>
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
                                            <option value="">- Select group -</option>
                                            <option value="science">Science</option>
                                            <option value="humanities">Humanities</option>
                                            <option value="commerce">Commerce</option>
                                        </select>
                                        <input type="text" class="" name="others_section" placeholder="Enter section"/>
                                        <input type="text" class="" name="others_roll" placeholder="Enter roll no"/>  
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"><?php echo translate('photo'); ?></label>
                                    <div class="controls" style="width:210px;">
                                        <input type="file" class="" name="userfile" id="imgInp" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls" style="width:210px;">
                                        <a href="<?php echo base_url(); ?>photo" target="_blank">Take your Picture</a>
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
<?php endif; ?>
<?php if ($class_id == ""): ?>
    <center>
        <div class="span5" style="float:none !important;">
            <div class="box">
                <div class="box-header">
                    <span class="title"> <i class="icon-info-sign"></i> Please select a class to manage student.</span>
                </div>
                <div class="box-content padded">
                    <br />
                    <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?teacher/student/'+this.value">
                        <option value=""><?php echo translate('select_a_class'); ?></option>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <option value="<?php echo $row['class_id']; ?>"
                                    <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                Class <?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <hr />
                    <script>
                        $(document).ready(function() {
                            function ask()
                            {
                                Growl.info({title:"Select a class to manage student",text:" "});
                            }
                            setTimeout(ask, 500);
                        });
                    </script>
                </div>
            </div>
        </div>
    </center>
<?php endif; ?>
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