<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/noticeboard/do_update/'.$row['notice_id'] , array('class' => 'form-horizontal validatable'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('title');?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="notice_title" value="<?php echo $row['notice_title'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('notice');?></label>
                    <div class="controls">
                        <div class="box closable-chat-box">
                            <div class="box-content padded">
                                    <div class="chat-message-box">
                                    <textarea name="notice" id="ttt" rows="5" placeholder="<?php echo translate('add_notice');?>"><?php echo $row['notice'];?></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('date');?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="create_timestamp" value="<?php echo date('m/d/Y',$row['create_timestamp']);?>"/>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_noticeboard');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>