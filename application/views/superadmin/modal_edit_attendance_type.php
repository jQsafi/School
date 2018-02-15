<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/stattendancetype/do_update/'.$row['type_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                
                <div class="control-group">
                                <label class="control-label"><?php echo translate('attendance_type');?></label>
                                <div class="controls">
                                    <input type="text" name="attendance_type" value="<?php echo $row['attendance_type']?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('short_form');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="short_form" value="<?php echo $row['short_form']?>" />
                                </div>
                            </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit attendance type');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>