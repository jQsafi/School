<div class="box box-border">
    <div class="box-header">
        <?php
            $grand_total = 0;
            $total_amount = 0;
            $total_weaver = 0;
            $total_deposit = 0;
            $total_due = 0;
        ?>
        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('Status Wise'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->
    </div>
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane " id="list">
            <center>
                <?php echo form_open('admin/statusWise'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                    <tr>
                        <td><?php echo translate('select_status'); ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <select name="status" class="uniform" style="width:350px;" required="">
                                <option value="">Select status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="partial">Partial</option>
                            </select>
<!--                            <select name="status" class=""  onchange="show_subjects(this.value)"  style="float:left;">
                                <option value=""><?php //echo get_phrase('Select_Status'); ?></option>
                                <?php /*
                                $invoices = $this->db->select('distinct(status)')->get('invoice')->result_array();
                                
                                foreach ($invoices as $row1):
                                    ?>
                                    <option value="<?php echo $row1['status']; ?>"<?php if ($status == $row1['status']) echo 'selected'; ?>><?php echo $row1['status']; ?></option>
                                    <?php
                                endforeach;
                              */  ?>
                            </select>-->
                        </td>
                        <td>
                            <input type="hidden" name="operation" value="selection" />
                            <input type="submit" value="<?php echo translate('Show'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>
            <br /><br />
            <?php if ($status != ''): ?>
                <?php
                //CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
                $verify_data1 = array('status' => $status);
                $invoices = $this->db->get_where('invoice', $verify_data1)->result_array();
                
                //$invoices = $this->crud_model->get_all_student_invoice_by_status($status);
                
                ?>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>S.I#</div></th>
                            <th><div><?php echo translate('Invoice ID'); ?></div></th>
                            <th><div><?php echo translate('Class'); ?></div></th>
                            <th><div><?php echo translate('Student_name'); ?></div></th>
                            <th><div><?php echo translate('Roll_no'); ?></div></th>
<!--                        <th><div><?php echo translate('amount'); ?></div></th>
                            <th><div><?php echo translate('weaver'); ?></div></th>
                            <th><div><?php echo translate('Deposit'); ?></div></th>
                            <th><div><?php echo translate('Due'); ?></div></th>-->
                            <th><div><?php echo translate('status'); ?></div></th>
                            <th><div><?php echo translate('Total_amount'); ?></div></th>
                            <th><div><?php echo translate('date'); ?></div></th>                            
                            <th><div><?php echo translate('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            foreach ($invoices as $row): ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['invoice_name']; ?></td>
                                <td>
                                    <?php
                                        $class_id = $row['class_id'];
                                        $class_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->class_id;
                                        echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                                    ?>
                                </td>
                               <td><?=get_single_value('name','student',array('student_id'=>$row['student_id']))?></td>
                                <td><?=get_single_value('roll','student',array('student_id'=>$row['student_id']))?></td>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
<!--                                <td><?php //echo $row['total_bill']; ?></td>-->
                                <?php $grand_total+=$row['total_bill']; ?>
<!--                                <td><?php //echo $row['weaver']; ?></td>-->
                                <?php $total_weaver+=$row['weaver']; ?>
<!--                                <td><?php //echo $row['deposit']; ?></td>-->
                                <?php $total_deposit+=$row['deposit']; ?>
<!--                                <td></td>-->
                                <?php $due = $row['total_bill'] - ($row['deposit'] + $row['weaver']);
								$total_due+=$due; ?>

                                <td>
                                    <span class="label label-<?php if ($row['status'] == 'paid') echo 'green';else echo 'dark-red'; ?>"><?php echo $row['status']; ?></span>
                                </td>
                                <td><?php echo $row['total_bill']; ?></td>
                                <td><?php echo date('d M,Y', $row['creation_timestamp']); ?></td>
                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view_invoice'); ?>
                                    </a>
                                    <!--<a data-toggle="modal" href="#modal-form" onclick="modal('edit_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-gray btn-small">
                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                    </a>-->
                                    <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/invoice/delete/<?php echo $row['invoice_id']; ?>')" class="btn btn-red btn-small">
                                        <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php $count++; endforeach; ?>

                    </tbody>
                </table>

                <div>
                    <div style="float:right; width:50%;">
                        <table width="100%" style="text-align:right;">
                            <tr>
                                <td style="border-top:none; width:65%;">Grand Total</td>
                                <td style="border-top:none; width:35%;"><?php echo $grand_total; ?></td>
                            </tr>

                            <tr>
                                <td>Total Weaver</td>
                                <td><?php echo $total_weaver; ?></td>
                            </tr>
                            <tr>
                                <td>Total Deposit</td>
                                <td><?php echo $total_deposit; ?></td>
                            </tr>
                            <tr>
                                <td>Total Due</td>
                                <td><?php echo $total_due; ?></td>
                            </tr>

                        </table>
                    </div>
                </div>

            <?php endif; ?>
        </div>
        <!----TABLE LISTING ENDS--->

    </div>
</div>