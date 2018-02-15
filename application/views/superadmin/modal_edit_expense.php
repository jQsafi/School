<div class="tab-pane box active edit-student-container" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>
            <?php echo form_open('admin/expense/do_update/' . $row['exp_id'], array('class' => 'form-horizontal validatable', 'target' => '_top', 'enctype' => 'multipart/form-data')); ?>

            <div class="padded">
                <div class="control-group">
                    <div class="avatar">
                        <img style="max-height: 150px;" id="blah" class="avatar-large" src="<?php echo $this->crud_model->get_image_url('expense', $row['exp_id']); ?>" height="100"  />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Uploaded document'); ?></label>
                    <div class="controls" style="width:350px;">
                        <input type="file" class="" name="document_name" id="imgInp" />
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label"><?php echo translate('date'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="expense_date" value="<?php echo date('m/d/Y',$row['expense_timestamp']); ?>" required=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Expense By'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="expense_by" value="<?php echo $row['expense_by']; ?>" required=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Expense ID'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="expense_id" value="<?php echo $row['expense_id']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Invoice ID'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="invoice_id" value="<?php echo $row['invoice_id']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Title/Expense Name'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="expense_name" value="<?php echo $row['expense_name']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Description'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="description" value="<?php echo $row['description']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Category'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="category" value="<?php echo $row['category']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Material Name'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="material_name" value="<?php echo $row['material_name']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Payment To'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="payment_to" value="<?php echo $row['payment_to']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Payment Method'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="payment_method" value="<?php echo $row['payment_method']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Amount'); ?></label>
                    <div class="controls">
                        <input type="number" id="" class="total_bill" name="amount" value="<?php echo $row['amount']; ?>"/>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-gray"><?php echo translate('edit_expense'); ?></button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>    

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>