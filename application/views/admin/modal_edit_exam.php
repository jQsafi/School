<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/exam/do_update/'.$row['exam_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('name');?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('exam_starting_date');?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="date" value="<?php echo $row['date'];?>"/>
                    </div>
                </div>
				<div class="control-group">
                    <label class="control-label"><?php echo translate('publishing_date');?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="publishing_date" value="<?php echo $row['publishing_date'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('comment');?></label>
                    <div class="controls">
                        <input type="text" class="" name="comment" value="<?php echo $row['comment'];?>"/>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_exam');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>