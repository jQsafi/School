<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/subject/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('name');?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('class');?></label>
                    <div class="controls">
                        <select name="class_id" class="uniform" style="width:100%;">
                            <?php 
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['class_id'];?>"
                                    <?php if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
				
				<div class="control-group">
                                <label class="control-label"><?php echo translate('group');?></label>
                                <div class="controls">
                                    <select name="group_id" class="uniform" style="width:100%;">
									    <option value="0"  <?php if($row['group_id'] ==0)echo 'selected';?>>All</option>
                                    	<option value="1" <?php if($row['group_id'] ==1)echo 'selected';?>>Science</option>
										<option value="2" <?php if($row['group_id'] ==2)echo 'selected';?>>Business Studies</option>
										<option value="3" <?php if($row['group_id'] ==3)echo 'selected';?>>Humanities</option>
                                    </select>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Is_this_fourth_subject');?></label>
                                <div class="controls">                            
									<INPUT TYPE="checkbox" name="fourthsub" value="1" <?php if($row['status'] ==1)echo 'checked';?>>
                                </div>
                            </div>
				
				
                <div class="control-group">
                    <label class="control-label"><?php echo translate('teacher');?></label>
                    <div class="controls">
                        <select name="teacher_id" class="uniform" style="width:100%;">
                            <option value=""></option>
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['teacher_id'];?>"
                                    <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_subject');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>