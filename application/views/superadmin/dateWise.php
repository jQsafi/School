<div class="box box-border clearfix">
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
                    <?php echo translate('Date Wise'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded textarea-problem">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane  <?php if(!isset($edit_data) &&!isset($personal_profile) &&!isset($academic_result) )echo 'active'; ?>" id="list">
            <center>
                <?php echo form_open('admin/datewise'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                    <tr>
                        <td><?php echo translate('select_Date'); ?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Start Date'); ?></label>
                                <div class="controls">
                                    <input style="width: 150px;" type="text" class="datepicker fill-up" name="start_date" value="<?php echo $start_date; ?>" required=""/>
                                </div>
                            </div>
                        </td>

                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('End Date'); ?></label>
                                <div class="controls">
                                    <input style="width: 150px;" type="text" class="datepicker fill-up" name="end_date" value="<?php echo  $end_date; ?>" required=""/>
                                </div>
                            </div>

                        </td>

                        <td>

                            <input type="submit" value="<?php echo translate('Show'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </center>


            <br /><br />

            <?php //echo "########### ".$start_date. " $$$$$$ ".$end_date;  ?>
            <?php if($start_date != ""): ?>
                <?php
                //CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
                //$verify_data1 = array('status' => $status);
                //$invoices = $this->db->get_where('invoice', $verify_data1)->result_array();
                $start_date= date("Y-m-d",strtotime(str_replace('/', '-',$start_date)));
				$end_date= date("Y-m-d",strtotime(str_replace('/', '-',$end_date)));
                $invoices = $this->crud_model->get_all_student_invoice_by_date($start_date, $end_date);
//                echo '<pre>';
//                print_r($invoices);
                
                ?>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>Invoice ID</div></th>
                            <th><div><?php echo translate('Class'); ?></div></th>
                            <th><div><?php echo translate('Student_name'); ?></div></th>
                            <th><div><?php echo translate('Roll_no'); ?></div></th>
<!--                            <th><div><?php echo translate('amount'); ?></div></th>
                            <th><div><?php echo translate('weaver'); ?></div></th>
                            <th><div><?php echo translate('Deposit'); ?></div></th>
                            <th><div><?php echo translate('Due'); ?></div></th>-->
                            <th><div><?php echo translate('status'); ?></div></th>
                            <th><div><?php echo translate('Total_amount'); ?></div></th>
                            <th><div><?php echo translate('Date'); ?></div></th>
                            <th><div><?php echo translate('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoices as $row): ?>
                            <tr>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td>
                                    <?php
                                        $class_id = $row['class_id'];
                                        $class_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->class_id;
                                        echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                                    ?>
                                </td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['roll']; ?></td>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
<!--                                <td><?php //echo $row['total_bill']; ?></td>-->
                                <?php $grand_total+=$row['total_bill']; ?>
<!--                                <td><?php //echo $row['weaver']; ?></td>-->
                                <?php $total_weaver+=$row['weaver']; ?>
<!--                                <td><?php //echo $row['deposit']; ?></td>-->
                                <?php $total_deposit+=$row['deposit']; ?>
<!--                                <td><?php //echo $due = $total_amount - ($row['deposit'] + $row['weaver']); ?></td>-->
                                <?php $total_due+=$row['due']; ?>

                                <td>
                                    <span class="label label-<?php if ($row['status'] == 'paid') echo 'green';else echo 'dark-red'; ?>"><?php echo $row['status']; ?></span>
                                </td>
                                <td><?php echo $row['total_bill']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['creation_date'])); ?></td>
                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id']; ?>, <?php echo $row['roll']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view_invoice'); ?>
                                    </a>
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('edit_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-gray btn-small">
                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                    </a>
                                    <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/invoice/delete/<?php echo $row['invoice_id']; ?>')" class="btn btn-red btn-small">
                                        <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

                <div>
                    <div style="float:right; width:30%;">
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