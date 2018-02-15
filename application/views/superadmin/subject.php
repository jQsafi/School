<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('subject_list');?>
                    	</a></li>		
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo translate('add_subject');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
				
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div><?php echo translate('class');?></div></th>
							<th><div><?php echo translate('group');?></div></th>
                    		<th><div><?php echo translate('subject_name');?></div></th>
                    		<th><div><?php echo translate('teacher');?></div></th>
                    		<th><div><?php echo translate('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($subjects as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td>
							<?php 
							$group_name=get_single_value('group_name','group',array('group_id'=>$row['group_id']));	
							if($group_name)
							echo $group_name;
							?>
							</td>
							<?php
								$td_class='';
								$fourth_subject=get_single_value('subject_id','subject',array('subject_id'=>$row['subject_id'],'status'=>1));
									if($fourth_subject!="-")
									$td_class='fourth_subject';

							?>
							<td class="<?php echo $td_class;?>">
								<?php 
									echo $row['name'];
									$subject_id=$row['subject_id'];
									$fourth_subject=get_single_value('subject_id','subject',array('subject_id'=>$row['subject_id'],'status'=>1));
									if($fourth_subject!="-")
									echo " (Fourth Subject)";
								?>
							</td>
							<td>
								<?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?>
									
								</td>
							<td align="center">
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_subject',<?php echo $row['subject_id'];?>)" class="btn btn-gray btn-small">
                                		<i class="icon-wrench"></i> <?php echo translate('edit');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/subject/delete/<?php echo $row['subject_id'];?>')" class="btn btn-red btn-small">
                                		<i class="icon-trash"></i> <?php echo translate('delete');?>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->

			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/subject/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('class');?></label>
                                <div class="controls">
                                    <select name="class_id" class="uniform" style="width:100%;">
                                    	<?php 
											echo make_select("class","class_id","name");
										?>
                                    </select>
                                </div>
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('group');?></label>
                                <div class="controls">
                                    <select name="group_id" class="uniform" style="width:100%;">
									    <option value="0">All</option>
                                    	<?php
											echo make_select("group","group_id","group_name");
										?>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Is_this_fourth_subject');?></label>
                                <div class="controls">                            
									<INPUT TYPE="checkbox" name="fourthsub" value="1">
                                </div>
                            </div>
							
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('teacher');?></label>
                                <div class="controls">
                                    <select name="teacher_id" class="uniform" style="width:100%;">
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_subject');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
			
			<!----CREATION College FORM STARTS---->
			<div class="tab-pane box" id="addcollege" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/college/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('group');?></label>
                                <div class="controls">
                                    <select name="group_id" class="uniform" style="width:100%;">
									    <option value="0">All</option>
                                    	<?php
											echo make_select("group","group_id","group_name");
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('category');?></label>
                                <div class="controls">
                                    <select name="category_id" class="uniform" style="width:100%;">
                                    	<option value="1">Compulsory</option>
										<option value="2">Other Subject</option>
										<option value="3">Optional</option>
                                    </select>
                                </div>
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('teacher');?></label>
                                <div class="controls">
                                    <select name="teacher_id" class="uniform" style="width:100%;">
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_subject');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION College FORM ENDS--->
            
		</div>
	</div>
</div>