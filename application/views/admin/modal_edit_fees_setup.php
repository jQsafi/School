<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php
        foreach ($edit_data as $row_class) {
            
        }
        $class_id = $row_class['class_id'];
        ?>
        <?php echo form_open('admin/fees_setup/do_update/' . $class_id, array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>
        <div class="padded">                
            <div class="control-group">
                <label class="control-label">Class</label>
                <div class="controls">
                    <label class="control-label"><?php echo $this->crud_model->get_class_name($class_id); ?></label>                   
                </div>
            </div>
            <?php
            $count = 0;
            foreach ($edit_data as $row):
                ?>
                <div class="control-group">
                    <label class="control-label">
                        <?php
                        $fees_name_id = $row['fees_name_id'];
                        $fee_name = $this->crud_model->get_fees_name_by_id($fees_name_id);
                        echo get_phrase($fee_name[0]['fee_name']);
                        ?>
                    </label>
                    <div class="controls">
                        <input type="hidden" class="" name="data[<?php echo $row['fees_id']; ?>][class_id]" value="<?php echo $class_id; ?>">
                        <input type="hidden" class="" name="data[<?php echo $row['fees_id']; ?>][fees_id]" value="<?php echo $row['fees_id']; ?>">
                        <input type="hidden" class="" name="data[<?php echo $row['fees_id']; ?>][fees_name_id]" value="<?php echo $row['fees_name_id']; ?>">
                        <input type="text" class="" name="data[<?php echo $row['fees_id']; ?>][fees_amount]" value="<?php echo $row['fees_amount']; ?>" maxlength="4">

                    </div>
                </div>
                <?php
                $count++;
            endforeach;
            ?>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-gray"><?php echo translate('edit_fees_setup'); ?></button>
        </div>
    </div>    
</div>