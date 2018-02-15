<link href="<?php echo base_url();?>template/css/bootstrap-datetimepicker.min.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>template/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/class_routine/do_update/'.$row['class_routine_id'] , array('class' => 'form-horizontal validatable','target'=>'_parent'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('class');?></label>
                    <div class="controls">
                        <select name="class_id" class="uniform" style="width:100%;">
                            <?php 
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['class_id'];?>" <?php if($row['class_id']==$row2['class_id'])echo 'selected';?>>
                                    <?php echo $row2['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('subject');?></label>
                    <div class="controls">
                        <select name="subject_id" class="uniform" style="width:100%;">
                            <?php 
                            $subjects = $this->db->get('subject')->result_array();
                            foreach($subjects as $row2):
                            ?>
                                <option value="<?php echo $row2['subject_id'];?>" <?php if($row['subject_id']==$row2['subject_id'])echo 'selected';?>>
                                    <?php echo $row2['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('day');?></label>
                    <div class="controls">
                        <select name="day" class="uniform" style="width:100%;">
                            <option value="saturday" 	<?php if($row['day']=='saturday')echo 'selected="selected"';?>>saturday</option>
                            <option value="sunday" 		<?php if($row['day']=='sunday')echo 'selected="selected"';?>>sunday</option>
                            <option value="monday" 		<?php if($row['day']=='monday')echo 'selected="selected"';?>>monday</option>
                            <option value="tuesday" 	<?php if($row['day']=='tuesday')echo 'selected="selected"';?>>tuesday</option>
                            <option value="wednesday" 	<?php if($row['day']=='wednesday')echo 'selected="selected"';?>>wednesday</option>
                            <option value="thursday" 	<?php if($row['day']=='thursday')echo 'selected="selected"';?>>thursday</option>
                            <option value="friday" 		<?php if($row['day']=='friday')echo 'selected="selected"';?>>friday</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('starting_time');?></label>
                    <div class="controls">
                        <div id="startdateedit" class="input-append date">
										<input name="starting_time" value= "<?php echo $row['time_start'];?>" type="text"></input>
											<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
						</div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('ending_time');?></label>
                    <div class="controls">
                         <div id="enddateedit" class="input-append date">
										<input name="ending_time" value= "<?php echo $row['time_end'];?>" type="text"></input>
											<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
											</span>
									</div>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_class_routine');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
<script type="text/javascript">
      $('#startdateedit').datetimepicker({
		format: 'HH:mm PP',
		pickDate: false,
        pickSeconds: false,
        pick12HourFormat: true
      });
	  $('#enddateedit').datetimepicker({
        format: 'HH:mm PP',
		pickDate: false,
        pickSeconds: false,
        pick12HourFormat: true
      });
    </script>