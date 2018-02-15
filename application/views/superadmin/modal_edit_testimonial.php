<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/testimonial_print/do_update/'.$row['testimonial_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                
                <div class="control-group">
                                <label class="control-label"><?php echo translate('testimonial info');?></label>
                                <div class="controls">
                                <textarea style="width:373px" name="testimonialinfo" class="testimonialinfo" rows="4" cols="50">
                                 <?php echo htmlspecialchars($row['testimonial_info']); ?>                                                       
                                                                                    </textarea>
                                </div>
                            </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_testimonial');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>