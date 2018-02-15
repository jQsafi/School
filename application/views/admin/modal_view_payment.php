<div class="tab-pane box active" id="edit" style="padding: 20px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): ?>


            <div class="pull-left" style="width: 60%;">
                <span style="font-size:20px;font-weight:100;">
                    <?php echo translate('payment_to'); ?>
                </span>
                <br />
                <?php echo $system_name; ?>
                <br />
                <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?>
            </div>
            <div class="pull-right" style="width: 40%;">
                <span style="font-size:20px;font-weight:100;">
                    <?php echo translate('bill_to'); ?>
                </span>
                <br />
                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                <br />
                <?php echo translate('roll'); ?> : 
                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->roll; ?>
                <br />
                <?php echo translate('class'); ?> : 
                <?php
                $class_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->class_id;
                echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                ?>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <table width="100%">
                <tr style="background-color:#7087A3; color:#fff; padding:5px;">
                    <td style="padding:5px;"><?php echo translate('invoice_title'); ?></td>
                    <td width="30%" style="padding:5px;">
                        <div class="pull-right">
                            Total Amount
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span style="font-size:20px;font-weight:100;">
                            <?php if ($row['monthly_fees'] != 0) echo '<br />' . get_phrase('monthly_fees'); ?>
                            <?php if ($row['overdue'] != 0) echo '<br />' . get_phrase('overdue'); ?>
                            <?php if ($row['admission_fees'] != 0) echo '<br />' . get_phrase('admission_fees'); ?>
                            <?php if ($row['absence_fine'] != 0) echo '<br />' . get_phrase('absence_fine'); ?>
                            <?php if ($row['late_fine'] != 0) echo '<br />' . get_phrase('late_fine'); ?>
                            <?php if ($row['bad_behavior'] != 0) echo '<br />' . get_phrase('bad_behavior'); ?>
                            <?php if ($row['dev_fees'] != 0) echo '<br />' . get_phrase('dev_fees'); ?>
                            <?php if ($row['session_fee_1st_installment'] != 0) echo '<br />' . get_phrase('session_fee_1st_installment'); ?>
                            <?php if ($row['session_fee_2nd_installment'] != 0) echo '<br />' . get_phrase('session_fee_2nd_installment'); ?>
                            <?php if ($row['sports_fees'] != 0) echo '<br />' . get_phrase('sports_fees'); ?>
                            <?php if ($row['lib_fees'] != 0) echo '<br />' . get_phrase('lib_fees'); ?>                            
                            <?php if ($row['cultural_program'] != 0) echo '<br />' . get_phrase('cultural_program'); ?>
                            <?php if ($row['invoice_book'] != 0) echo '<br />' . get_phrase('invoice_book'); ?>
                            <?php if ($row['receipt_books'] != 0) echo '<br />' . get_phrase('receipt_books'); ?>
                            <?php if ($row['exam_fee'] != 0) echo '<br />' . get_phrase('exam_fee'); ?>
                            <?php if ($row['registration_fee'] != 0) echo '<br />' . get_phrase('registration_fee'); ?>
                            
                            <?php //if ($row['admission_form'] != 0) echo '<br />' . get_phrase('admission_form'); ?>
                            <?php //if ($row['tc_fees'] != 0) echo '<br />' . get_phrase('tc_fees'); ?>
                            <?php //if ($row['scout_fees'] != 0) echo '<br />' . get_phrase('scout_fees'); ?>
                            
                            <?php if ($row['poor_fund'] != 0) echo '<br />' . get_phrase('poor_fund'); ?>
                            <?php if ($row['lab_charge'] != 0) echo '<br />#' . get_phrase('lab_charge'); ?>                            
                            <?php if ($row['electricity_charge'] != 0) echo '<br />' . get_phrase('electricity_charge'); ?>
                            <?php //if ($row['IT_charge'] != 0) echo '<br />' . get_phrase('IT_charge'); ?>
                            <?php if ($row['Fine'] != 0) echo '<br />' . get_phrase('Fine'); ?>
                            <?php //if ($row['mid_term_exam'] != 0) echo '<br />' . get_phrase('mid_term_exam'); ?>
                            <?php //if ($row['annual_exam'] != 0) echo '<br />' . get_phrase('annual_exam'); ?>
                            <?php //if ($row['milad'] != 0) echo '<br />' . get_phrase('milad'); ?>
                            <?php //if ($row['others'] != 0) echo '<br />' . get_phrase('others'); ?>
                            <?php echo '<br /> Grand Total:'; ?>


                        </span>
                        <br />
                        <?php // echo $row['description'];?>
                    </td>
                    <td width="30%" style="padding:5px;">
                        <div class="pull-right">
                            <span style="font-size:20px;font-weight:100;">
                                <?php if ($row['monthly_fees'] != 0) echo '<br />' . $row['monthly_fees']; ?>
                                <?php if ($row['overdue'] != 0) echo '<br />' . $row['overdue']; ?>
                                <?php if ($row['admission_fees'] != 0) echo '<br />' . $row['admission_fees']; ?>
                                <?php if ($row['absence_fine'] != 0) echo '<br />' . $row['absence_fine']; ?>
                                <?php if ($row['late_fine'] != 0) echo '<br />' . $row['late_fine']; ?>
                                <?php if ($row['bad_behavior'] != 0) echo '<br />' . $row['bad_behavior']; ?>
                                <?php if ($row['dev_fees'] != 0) echo '<br />' . $row['dev_fees']; ?>
                                <?php if ($row['session_fee_1st_installment'] != 0) echo '<br />' . $row['session_fee_1st_installment']; ?>
                                <?php if ($row['session_fee_2nd_installment'] != 0) echo '<br />' . $row['session_fee_2nd_installment']; ?>
                                <?php if ($row['sports_fees'] != 0) echo '<br />' . $row['sports_fees']; ?>
                                <?php if ($row['lib_fees'] != 0) echo '<br />' . $row['lib_fees']; ?>
                                <?php if ($row['cultural_program'] != 0) echo '<br />' . $row['cultural_program']; ?>
                                <?php if ($row['invoice_book'] != 0) echo '<br />' . $row['invoice_book']; ?>
                                <?php if ($row['receipt_books'] != 0) echo '<br />' . $row['receipt_books']; ?>
                                <?php if ($row['exam_fee'] != 0) echo '<br />' . $row['exam_fee']; ?>
                                <?php if ($row['registration_fee'] != 0) echo '<br />' . $row['registration_fee']; ?>
                                
                                
                                <?php //if ($row['admission_form'] != 0) echo '<br />' . $row['admission_form']; ?>
                                <?php //if ($row['tc_fees'] != 0) echo '<br />' . $row['tc_fees']; ?>
                                <?php //if ($row['scout_fees'] != 0) echo '<br />' . $row['scout_fees']; ?>
                                <?php if ($row['poor_fund'] != 0) echo '<br />' . $row['poor_fund']; ?>                                
                                <?php if ($row['lab_charge'] != 0) echo '<br />' . $row['lab_charge']; ?>
                                <?php if ($row['electricity_charge'] != 0) echo '<br />' . $row['electricity_charge']; ?>
                                <?php //if ($row['IT_charge'] != 0) echo '<br />' . $row['IT_charge']; ?>
                                <?php if ($row['Fine'] != 0) echo '<br />' . $row['Fine']; ?>
                                <?php //if ($row['mid_term_exam'] != 0) echo '<br />' . $row['mid_term_exam']; ?>
                                <?php //if ($row['annual_exam'] != 0) echo '<br />' . $row['annual_exam']; ?>
                                <?php //if ($row['milad'] != 0) echo '<br />' . $row['milad']; ?>
                                <?php //if ($row['others'] != 0) echo '<br />' . $row['others']; ?>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
                                <?php echo '<br />' . $row['total_bill']; ?>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td width="30%" style="padding:5px;">
                        <div class="pull-right">
                            <hr />
                            Due: <?php echo $row['due']; //echo $total_amount - $row['deposit']; ?>
                            <br />
                            <?php echo translate('status'); ?> : <?php echo $row['status']; ?>
                            <br />
                            <?php echo translate('invoice_id'); ?> : <?php echo $row['invoice_id']; ?>
                            <br />
                            <?php echo translate('date'); ?> : <?php echo date('m/d/Y', $row['creation_timestamp']); ?>
                        </div>
                    </td>
                </tr>
            </table>
            <br />
            <br />


        <?php endforeach; ?>
    </div>
</div>