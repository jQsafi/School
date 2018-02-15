<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php $date_string= strtotime(str_replace('-', '/', $row['grantedform']));
              $grantedform=date("d/m/Y",$date_string);
              $date_string1= strtotime(str_replace('-', '/', $row['grantedto']));
              $grantedto=date("d/m/Y",$date_string1);
         ?>
        <?php echo form_open('admin/admit_card_print/do_update/'.$row['admit_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                
                <div class="control-group">
                                <label class="control-label"><?php echo translate('granted form');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up validate[required]" name="granted_form" value="<?php echo $grantedform; ?>"/>
                                </div>
                            </div>
                  
                <div class="control-group">
                                <label class="control-label"><?php echo translate('granted to');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up validate[required]" name="granted_to" value="<?php echo $grantedto; ?>"/>
                                </div>
                            </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_admit');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>