<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php $date_string= strtotime(str_replace('-', '/', $row['holidaydate']));
              $holidaydate=date("d/m/Y",$date_string);
         ?>
        <?php echo form_open('admin/holiday/do_update/'.$row['holidayid'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                
                <div class="control-group">
                                <label class="control-label"><?php echo translate('date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up validate[required]" name="holiday_date" value="<?php echo $holidaydate; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('holiday_name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="holiday_name"  value="<?php echo $row['holidayname'];?>"/>
                                </div>
                            </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_holiday');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>