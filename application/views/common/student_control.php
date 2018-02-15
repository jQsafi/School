 <div class="action-nav-normal">
								<center><h3>
										<?php
										if(!$class_id)
										echo translate('student_list_of _whole_school');
										else
										echo translate('student_list_of _class '.translate(get_single_value('name','class',array('class_id'=>$class_id))));
										?>
									</h3></center>
                                <div class="action-nav-button" style="width:300px;">
                                    <a href="<?=site_url($this->session->userdata('login_type')."/student_control")?>" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span> 
										<?php
										$condition=array();
										if($class_id)
										$condition['class_id']=$class_id;
										$total_student=get_single_value('count(student_id)','student',$condition);
										echo translate('total_students').' '.translate($total_student);
										?></span>	
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="<?=site_url($this->session->userdata('login_type')."/student_control/1")?>" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span><?php 
										$condition['status']=1;
										$active=get_single_value('count(student_id)','student',$condition);
										echo translate('active_students').' '.translate($active);
										?></span>
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="<?=site_url($this->session->userdata('login_type')."/student_control/0")?>" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span><?php 
										if($class_id)
										$condition['class_id']=$class_id;
										$condition['status']=0;
										$inactive=get_single_value('count(student_id)','student',$condition);
										echo translate('inactive_students').' '.translate($inactive);
										?> 
										</span>
                                    </a>
                                </div>
                            </div>
                        </center>
                    <center>
                        <br />
						<?=form_open(site_url($this->session->userdata('login_type').'/student_control'),array('id'=>'student_class'))?>
                        <select name="class_id" onchange="$('#student_class').submit()">
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
						<?=form_close()?>
                        <div class="box">
                            <div class="box-content">
                               <?php 
								foreach($students->css_files as $file): ?>
									<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
								<?php endforeach; ?>
								<?php foreach($students->js_files as $file): ?>
									<script src="<?php echo $file; ?>"></script>
								<?php endforeach; ?>	
								<?php echo $students->output;?>
                            </div>
                        </div>
             