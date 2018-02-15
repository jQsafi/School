<style>
    table.dataTable {
        border: 1px solid #d5d5d5;
    }
    table.dataTable thead th, table.dataTable thead th div {
        height: 45px !important;
    }
    #list label {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 0;
        min-width: 105px;
    }
    #list .control-group {
        margin-bottom: 0;
    }
    #list .controls, #list .controls select, #list .controls input {
        display: inline-block;
        margin-bottom: 0;
    }
</style>
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<div class="box box-border">
    <div class="box-header">
        <?php $grand_total = 0; ?>
        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('Expense Report'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open('admin/expense_report'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('expense By'); ?></label>
                                <div class="controls">
                                    <select name="expense_by" class="expenseBy">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['expense_by']; ?>"  <?php if($expense_by == $value['expense_by']) echo "selected"; ?>>
                                                    <?php echo $value['expense_by']; ?>
                                                </option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('expense_id'); ?></label>
                                <div class="controls">
                                    <select name="expense_id" class="expenseID">
                                        <option value="">Please select</option>
                                        <?php 
                                        foreach($expenses as $key => $value) { ?>
                                        <option value="<?php echo $value['expense_id']; ?>" <?php if($expense_id == $value['expense_id']) echo "selected"; ?>><?php echo $value['expense_id']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('invoice_id'); ?></label>
                                <div class="controls">
                                    <select name="invoice_id" class="invoiceID">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['invoice_id']; ?>" <?php if($invoice_id == $value['invoice_id']) echo "selected"; ?>><?php echo $value['invoice_id']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('expense_name'); ?></label>
                                <div class="controls">
                                    <select name="expense_name" class="expenseName">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['expense_name']; ?>" <?php if($expense_name == $value['expense_name']) echo "selected"; ?>><?php echo $value['expense_name']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('category'); ?></label>
                                <div class="controls">
                                    <select name="category" class="category">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['category']; ?>" <?php if($category == $value['category']) echo "selected"; ?>><?php echo $value['category']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('material_name'); ?></label>
                                <div class="controls">
                                    <select name="material_name" class="material_name">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['material_name']; ?>" <?php if($material_name == $value['material_name']) echo "selected"; ?>><?php echo $value['material_name']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('payment_to'); ?></label>
                                <div class="controls">
                                    <select name="payment_to" class="paymentTo">
                                        <option value="">Please select</option>
                                        <?php 
                                            foreach($expenses as $key => $value) { ?>
                                                <option value="<?php echo $value['payment_to']; ?>" <?php if($payment_to == $value['payment_to']) echo "selected"; ?>><?php echo $value['payment_to']; ?></option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('payment_method'); ?></label>
                                <div class="controls">
                                     <select name="payment_method" class="paymentMethod">
                                        <option value="">Please select</option>
                                        <option value="cash" <?php if($payment_method == 'cash') echo "selected"; ?>>cash</option>
                                        <option value="Bank" <?php if($payment_method == 'Bank') echo "selected"; ?>>Bank</option>
                                        <option value="Bank Check" <?php if($payment_method == 'Bank Check') echo "selected"; ?>>Bank Check</option>
                                    </select>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date from'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="expense_date_from" value="<?php echo $expense_date_from; ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date to'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="expense_date_to" value="<?php echo $expense_date_to; ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="operation" value="selection" />
                            <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />


            <?php                
                $number_of_row = count($expense_report_data);
                if ($number_of_row >= 1) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table tablesorter responsive" id="xexpensereport">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo translate('expense By'); ?></div></th>
                            <th><div><?php echo translate('expense ID'); ?></div></th>
                            <th><div><?php echo translate('Invoice ID'); ?></div></th>
                            <th><div><?php echo translate('Title/expense Name'); ?></div></th>
                            <th><div><?php echo translate('Description'); ?></div></th>
                            <th><div><?php echo translate('Category'); ?></div></th>
                            <th><div><?php echo translate('Material Name'); ?></div></th>
                            <th><div><?php echo translate('Uploaded Document'); ?></div></th>
                            <th><div><?php echo translate('Payment To'); ?></div></th>
                            <th><div><?php echo translate('Payment Menthod'); ?></div></th>                            
                            <th><div><?php echo translate('Date'); ?></div></th>
                            <th><div><?php echo translate('Amount'); ?></div></th>
<!--                            <th><div><?php echo translate('Option'); ?></div></th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            foreach ($expense_report_data as $row): ?>
                            <tr>
                                <td><?php echo $count; ?></td>                           
                                <td><?php echo $row['expense_by']; ?></td>
                                <td><?php echo $row['expense_id']; ?></td>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td><?php echo $row['expense_name']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['category']; ?></td>
                                <td><?php echo $row['material_name']; ?></td>
                                <td><?php echo $row['document_name']; ?></td>
                                <td><?php echo $row['payment_to']; ?></td>
                                <td><?php echo $row['payment_method']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['expense_date'])); ?></td>                                						<td>
                                    <?php 
									echo $row['amount'];
                                        $grand_total+=$row['amount'];
                                    ?>
								</td>
<!--                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view_detail'); ?>
                                    </a>
                                </td>-->
                            </tr>
                        <?php $count++; endforeach; ?>

                    </tbody>
					<tfoot>
						 <tr>
                             <td colspan="13" align="right"><h5>Grand Total : <?php echo $grand_total; ?></h5></td>
                            </tr>
					</tfoot>
                </table>
                <br />
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xexpensereport').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xexpensereport').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>

            <?php }  ?>
        </div>
        <!----TABLE LISTING ENDS--->

    </div>
</div>
<?php  die; ?>