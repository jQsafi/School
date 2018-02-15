<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
         <?php $date_string= strtotime(str_replace('-', '/', $row['last_day_attends']));
              $last_day_attends=date("d/m/Y",$date_string);
              $date_string1= strtotime(str_replace('-', '/', $row['leavingdate']));
              $leavingdate=date("d/m/Y",$date_string1);
         ?>
        <?php echo form_open('admin/transfar_certificate_print/do_update/'.$row['tc_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                
                <div class="control-group">
                                <label class="control-label"><?php echo translate('class to which he/she was admitted');?></label>
                                <div class="controls">
    
                        <input type="text" name="admitted_class" value="<?php echo $row['admitted_class']; ?>" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Last day of attendance in this school');?></label>
                                <div class="controls">
    
                     <input type="text" class="datepicker fill-up" name="last_day_attends" value="<?php echo $last_day_attends; ?>" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Result At the end of Academic year');?></label>
                                <div class="controls">
    
                        <input type="text" name="result" value="<?php echo $row['result']; ?>" >
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Obserbation if Any');?></label>
                                <div class="controls">
    
                        <input type="text" name="obserbation" value="<?php echo $row['obserbation']; ?>" >
                                </div>
                            </div>
                                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Date of leaving');?></label>
                                <div class="controls">
    
                        <input type="text" class="datepicker fill-up" name="leavingdate" value="<?php echo $leavingdate; ?>" >
                                </div>
                            </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_transfar_certificate');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>