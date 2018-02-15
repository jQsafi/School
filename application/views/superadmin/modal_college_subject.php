<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/college/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('name');?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('group');?></label>
                    <div class="controls">
                        <select name="group_id" class="uniform" style="width:100%;">                               
								<option value="1" <?php if($row['group_id'] ==1) echo 'selected';?>>Science</option>
								<option value="2" <?php if($row['group_id'] ==2) echo 'selected';?>>Business Studies</option>
								<option value="3" <?php if($row['group_id'] ==3) echo 'selected';?>>Humanities</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('category');?></label>
                    <div class="controls">
                        <select name="category_id" class="uniform" style="width:100%;">
                            <option value="1" <?php if($row['catagory_id'] ==1) echo 'selected';?>>Compulsory</option>
							<option value="2" <?php if($row['catagory_id'] ==2) echo 'selected';?>>Other Subject</option>
							<option value="3" <?php if($row['catagory_id'] ==3) echo 'selected';?>>Optional</option>
                        </select>
                    </div>
                </div>
				
				<div class="control-group">
                                <label class="control-label"><?php echo translate('teacher');?></label>
                                <div class="controls">
                                    <select name="teacher_id" class="uniform" style="width:100%;">
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row1):
										?>
                                    		<option value="<?php echo $row1['teacher_id'];?>" <?php if($row['teacher_id'] ==$row1['teacher_id']) echo 'selected';?>><?php echo $row1['name'];?></option>
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