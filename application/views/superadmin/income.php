<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('income_list'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo translate('add_income'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" id="xincomelist">
                    <thead>
                        <tr>
                            <th><div>Sl No.</div></th>
                            <th><div><?php echo translate('Income By'); ?></div></th>
                            <th><div><?php echo translate('Income ID'); ?></div></th>                            
                            <th><div><?php echo translate('Invoice ID'); ?></div></th>
                            <th><div><?php echo translate('amount'); ?></div></th>
                            <th><div><?php echo translate('date'); ?></div></th>
                            <th style="width: 300px;"><div><?php echo translate('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($incomes as $row):
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['income_by']; ?></td>
                                <td><?php echo $row['income_id']; ?></td>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['income_date'])); ?></td>
                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('income_detail',<?php echo $row['inc_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view_income'); ?>
                                    </a>
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('edit_income',<?php echo $row['inc_id']; ?>)" class="btn btn-gray btn-small">
                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                    </a>
                                    <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/income/delete/<?php echo $row['inc_id']; ?>')" class="btn btn-red btn-small">
                                        <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                    </a>
                                </td>
                            </tr>
                            <?php $count++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomelist').tableExport({type:'excel',escape:'false', ignoreColumn: [6]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomelist').tableExport({type:'doc',escape:'false', ignoreColumn: [6]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/income/create', array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data')); ?>
                    <div class="padded">
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Date'); ?></label>
                            <div class="controls">
                                <input type="text" class="datepicker fill-up" name="income_date" required=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Income By'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="income_by" required=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Income ID'); ?></label>
                            <div class="controls">
                                <?php
                                    $incomes = $this->db->get('income')->result_array();
                                    $row_number = count($incomes);
                                    
                                    if($row_number > 0){
                                        foreach ($incomes as $value) {
                                            
                                        }
                                        $last_id = $value['income_id'];                                        
                                        $first_part = substr($last_id,0,4);                                        
                                        $in_val =  intval(substr($last_id, -1, 1));
                                        $last_part = $in_val + 1;
                                        $income_id = $first_part.$last_part;
                                    }else {
                                       $income_id = "INC-1"; 
                                    }                                    
                                ?>
                                <input type="text" class="" name="income_id" value="<?php echo $income_id; ?>" readonly=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Invoice ID'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="invoice_id"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Title/Income Name'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="income_name"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Description'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="description"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Category'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="category"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Material Name'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="material_name"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Upload Document'); ?></label>
                            <div class="controls" style="width:350px;">
                                <input type="file" class="" name="document_name" id="imgInp" />
                                <input type="hidden" class="document_name" name="document_name" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Payment From'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="payment_to"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Payment Method'); ?></label>
                            <div class="controls">
                                <select name="payment_method" class="" style="width: 350px;">
                                    <option value="">Please select</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Bank Check">Bank Check</option>
                                    <option value="Cash">Cash</option>
                                </select>
<!--                            <input type="text" class="" name="payment_method"/>-->
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Amount'); ?></label>
                            <div class="controls">
                                <input type="number" id="" class="total_bill" name="amount"/>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo translate('Save'); ?></button>
                    </div>
                   <?php echo form_close(); ?> 
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

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
            //console.log(input.files.FileList);
            //console.log(input.files[0].name);
            $('.document_name').val(input.files[0].name);
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){        
        readURL(this);        
    });
</script>