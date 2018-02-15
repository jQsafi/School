<?php 
foreach($output->css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($output->js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<div class="control-group" style="width:600px;position: absolute;top: 400px;right:0;">
                                <center><h3><?php echo translate('educational_qualification');?></h3></center>
                                <div class="controls" style="width:100%">
                                    <?php
										echo $output->output;
									?>
                                </div>
                     </div>
<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_data as $row):?>
                    <?php echo form_open('admin/teacher/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal validatable','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        <div class="padded">
						
						 <div class="control-group">
                                <label class="control-label"><?php echo translate('employee ID');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="employee" value="<?php echo $row['employeeID'];?>"/>
                                </div>
                            </div>
							
						
						    <div class="control-group">
                                <label class="control-label"><?php echo translate('index Number');?></label>
                                <div class="controls">
                                    <input type="number" class="" name="index" value="<?php echo $row['indexNumber'];?>"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Order Number');?></label>
                                <div class="controls">
                                    <input type="number" class="" name="order" value="<?=$row['order']?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('birthday');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="birthday" value="<?php echo $row['birthday'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('sex');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                    	<option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo translate('male');?></option>
                                    	<option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo translate('female');?></option>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('religion');?></label>
                                <div class="controls">
                                    <select name="religion" class="uniform" style="width:100%;">
										<option value=""><?php echo translate('religion');?></option>
                                    	<?=make_select('religion','religion_id','religion_name',$row['religion'])?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('qualification');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="qualification" value="<?php echo $row['qualification'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('experience');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="experience" value="<?php echo $row['experience'];?>"/>
                                </div>
                            </div>
							
							
							<div class="control-group">
                                    <label class="control-label"><?php echo translate('joining Date'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="datepicker fill-up" name="joining" value="<?php echo $row['joiningDate'];?>"/>
                                    </div>
                            </div>
							<div class="control-group">
                                    <label class="control-label">Department</label>
                                    <div class="controls">
                                        <input type="text" class="" name="department" value="<?php echo $row['department'];?>"/>
                                    </div>
                            </div>
							<div class="control-group">
                                    <label class="control-label">Subject</label>
                                    <div class="controls">
                                        <input type="text" class="" name="subject" value="<?php echo $row['subject'];?>"/>
                                    </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('designation');?></label>
                                <div class="controls">
                                    <select name="designation">
									    <option value=""></option>	
										<?php	$designation_data = $this->db->get_where('designation')->result_array(); 
										foreach($designation_data as $row1):
										?>
                                    	<option value="<?php echo $row1['id'];?>" <?php if($row['designation'] == $row1['id'])echo 'selected';?>><?php echo $row1['name'];?></option>
										<?php
										endforeach;
										?>
									</select>
								</div>
							</div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('blood Group');?></label>
                                <div class="controls">
                                    <select name="blood">
										<option value=""></option>
                                    	<option value="O-" <?php if($row['blood_group'] == 'O-') echo 'selected';?>><?php echo translate('O-');?></option>
                                    	<option value="O+" <?php if($row['blood_group'] == 'O+') echo 'selected';?>><?php echo translate('O+');?></option>
										<option value="A-" <?php if($row['blood_group'] == 'A-') echo 'selected';?>><?php echo translate('A-');?></option>
                                    	<option value="A+" <?php if($row['blood_group'] == 'A+') echo 'selected';?>><?php echo translate('A+');?></option>
										<option value="B-" <?php if($row['blood_group'] == 'B-') echo 'selected';?>><?php echo translate('B-');?></option>
                                    	<option value="B+" <?php if($row['blood_group'] == 'B+') echo 'selected';?>><?php echo translate('B+');?></option>
										<option value="AB-" <?php if($row['blood_group'] == 'AB-') echo 'selected';?>><?php echo translate('AB-');?></option>
                                    	<option value="AB+" <?php if($row['blood_group'] == 'AB+') echo 'selected';?>><?php echo translate('AB+');?></option>
                                    </select>
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('present_address');?></label>
                                <div class="controls">
                                    <textarea name="address"><?php echo $row['address'];?></textarea>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('permanent_address');?></label>
                                <div class="controls">
                                    <textarea name="per_address"><?php echo $row['per_address'];?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('email');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('password');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="password" value="<?php echo $row['password'];?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('photo');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="" name="userfile" id="imgInp" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls" style="width:210px;">
                                    <img id="blah" src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" alt="your image" height="100" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('edit_teacher');?></button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </div>
			</div>