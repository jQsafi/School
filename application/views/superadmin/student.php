
    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo translate('student_list'); ?>
                    </a>
                </li>  
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <div class="tab-pane  active" id="list">
                    <center>
                        <br />
                        <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?superadmin/student/'+this.value">
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
                            <div class="action-nav-normal">
                                <div class=" action-nav-button" style="width:300px;">
                                    <a href="#" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span>Total 
										<?php
										$condition=array();
										if($class_id)
										{
											$total=get_single_value('count(student_id)','student',array('class_id'=>$class_id));
										}
										else
										{
											$total=get_single_value('count(student_id)','student');
										}
										echo $total
										?>
										 students</span>	
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="#" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span>Total <?php 
										if($class_id)
										$condition['class_id']=$class_id;
										$condition['status']=1;
										$active=get_single_value('count(student_id)','student',$condition);
										echo $active; ?> Students are active</span>
                                    </a>
                                </div>
								<div class=" action-nav-button" style="width:300px;">
                                    <a href="#" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span>Total <?php 
										if($class_id)
										$condition['class_id']=$class_id;
										$condition['status']=0;
										$inactive=get_single_value('count(student_id)','student',$condition);
										echo $inactive; ?> students are inactive</span>
                                    </a>
                                </div>
                            </div>
                        </center>
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
                </div>
                <!----TABLE LISTING ENDS--->
 
            </div>
        </div>
    </div>