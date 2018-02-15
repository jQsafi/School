<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo translate('add_invoice/payment'); ?>
                </a>

            </li>
            <li>
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('invoice/payment_list'); ?>
                </a>
            </li>           

        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>Invoice ID</div></th>
                    <th><div>Class</div></th>
                    <th><div><?php echo translate('student'); ?></div></th>
                    <th><div>Roll No</div></th>                            
                    <th><div><?php echo translate('title'); ?></div></th>
                    <th><div><?php echo translate('total_amount'); ?></div></th>
                    <th><div><?php echo translate('deposit'); ?></div></th>
                    <th><div><?php echo translate('Due'); ?></div></th>
                    <th><div><?php echo translate('status'); ?></div></th>
                    <th><div><?php echo translate('date'); ?></div></th>
                    <th><div><?php echo translate('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($invoices as $row): //echo '<pre>'; print_r($row);
                            ?>
                            <tr>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td><?php //echo $count++;    ?><?php echo $this->crud_model->get_class_name($row['class_id']); ?></td>
                                <td><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']); ?></td>
                                <td><?php echo $row['roll']; ?></td>                                
                                <td><?php echo $row['title']; ?></td>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
                                <td><?php echo $row['total_bill']; ?></td>
                                <td><?php echo $row['deposit']; ?></td>
                                <td><?php echo $row['due']; ?></td>
                                <td>
                                    <span class="label label-<?php if ($row['status'] == 'paid') echo 'green';else echo 'dark-red'; ?>"><?php echo $row['status']; ?></span>
                                </td>
                                <td><?php echo date('d M,Y', $row['creation_timestamp']); ?></td>
                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view_invoice'); ?>
                                    </a>
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_payment',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo "Payment"; ?>
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
            </div>
            <!----TABLE LISTING ENDS--->

            <!----TABLE LISTING STARTS--->

            <div class="tab-pane box" id="classwise">
                <center>
                    <br />
                    <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?admin/invoice/'+this.value">
                        <option value=""><?php echo translate('select_a_class'); ?></option>
                        <?php
                        $invoices = $this->db->get('invoice')->result_array();
                        foreach ($invoices as $row):
                            ?>
                            <option value="<?php echo $row['class_id']; ?>"
                                    <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                Class <?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <br /><br />
                    <?php if ($class_id == ''): ?>
                        <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                            <i class="icon-info-sign"></i> Please select a class to manage student.
                        </div>
                        <script>
                            $(document).ready(function() {
                            						  	
                                function shake()
                                {
                                    $( "#ask_class" ).effect( "shake" );
                                }
                                setTimeout(shake, 500);
                            });
                        </script>
                        <br /><br />
                    <?php endif; ?>
                    <?php if ($class_id != ''): ?>

                        <div class="action-nav-normal">
                            <div class=" action-nav-button" style="width:300px;">
                                <a href="#" title="Users">
                                    <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                    <span>Total <?php echo count($students); ?> students</span>
                                </a>
                            </div>
                        </div>
                    </center>
                    <div class="box">
                        <div class="box-content">
                            <div id="dataTables">
                                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive ">
                                    <thead>
                                        <tr>
                                            <th><div><?php echo translate('roll'); ?></div></th>
                                    <th width="80"><div><?php echo translate('photo'); ?></div></th>
                                    <th><div><?php echo translate('student_name'); ?></div></th>
                                    <th class="span3"><div><?php echo translate('address'); ?></div></th>
                                    <th><div><?php echo translate('email'); ?></div></th>
                                    <th><div><?php echo translate('options'); ?></div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($students as $row):
                                            ?>
                                            <tr>
                                                <td class="span1"><?php echo $row['roll']; ?></td>
                                                <td><div class="avatar"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-medium" /></div></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['address']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td align="center" class="span5">


                                                    <a  data-toggle="modal" href="#modal-form" onclick="modal('student_profile',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-user"></i> <?php echo translate('profile'); ?>
                                                    </a>
                                                    <a  data-toggle="modal" href="#modal-form" onclick="modal('student_academic_result',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-file-alt"></i> <?php echo translate('marksheet'); ?>
                                                    </a>
                                                    <a  data-toggle="modal" href="#modal-form" onclick="modal('student_id_card',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-credit-card"></i> <?php echo translate('id_card'); ?>
                                                    </a>
                                                    <a  data-toggle="modal" href="#modal-form" onclick="modal('edit_student',<?php echo $row['student_id']; ?>,<?php echo $class_id; ?>)" class="btn btn-gray btn-small">
                                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                                    </a>
                                                    <a  data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>')" class="btn btn-red btn-small">
                                                        <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                    </a>

                                                                            <!--<a href="<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/personal_profile/<?php echo $row['student_id']; ?>"
                                                                                class="btn btn-gray">
                                                                                    <i class="icon-wrench"></i> <?php echo translate('personal_profile'); ?>
                                                                            </a>
                                                                            <a href="<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/academic_result/<?php echo $row['student_id']; ?>"
                                                                                class="btn btn-gray">
                                                                                    <i class="icon-wrench"></i> <?php echo translate('academic_result'); ?>
                                                                            </a>
                                                                            <a href="<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/edit/<?php echo $row['student_id']; ?>"
                                                                                class="btn btn-gray">
                                                                                    <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                                                            </a>
                                                                            <a href="<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>" onclick="return confirm('delete?')"
                                                                                class="btn btn-red">
                                                                                    <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                                            </a>-->

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>


            <!----TABLE LISTING ENDS--->

            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box" id="monthwise">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>Class</div></th>
                    <th><div><?php echo translate('student'); ?></div></th>
                    <th><div>Roll No</div></th>
                    <th><div>Invoice ID</div></th>
                    <th><div><?php echo translate('title'); ?></div></th>
                    <th><div><?php echo translate('total_bill'); ?></div></th>
                    <th><div><?php echo translate('Due'); ?></div></th>
                    <th><div><?php echo translate('status'); ?></div></th>
                    <th><div><?php echo translate('date'); ?></div></th>
                    <th><div><?php echo translate('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($invoices as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']); ?></td>
                                <td><?php echo $row['student_id']; ?></td>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
                                <td><?php echo $row['total_bill']; ?></td>
                                <td><?php echo $row['due']; ?></td>
                                <td>
                                    <span class="label label-<?php if ($row['status'] == 'paid') echo 'green';else echo 'dark-red'; ?>"><?php echo $row['status']; ?></span>
                                </td>
                                <td><?php echo date('d M,Y', $row['creation_timestamp']); ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box" id="total">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>Class</div></th>
                    <th><div><?php echo translate('student'); ?></div></th>
                    <th><div>Roll No</div></th>
                    <th><div>Invoice ID</div></th>
                    <th><div><?php echo translate('title'); ?></div></th>
                    <th><div><?php echo translate('total_bill'); ?></div></th>
                    <th><div><?php echo translate('Due'); ?></div></th>
                    <th><div><?php echo translate('status'); ?></div></th>
                    <th><div><?php echo translate('date'); ?></div></th>
                    <th><div><?php echo translate('options'); ?></div></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($invoices as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']); ?></td>
                                <td><?php echo $row['student_id']; ?></td>
                                <td><?php echo $row['invoice_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <?php //$total_amount = $row['monthly_fees'] + $row['admission_fees'] + $row['admission_form'] + $row['tc_fees'] + $row['scout_fees'] + $row['poor_fund'] + $row['dev_fees'] + $row['sports_fees'] + $row['lab_fees'] + $row['electricity_charge'] + $row['IT_charge'] + $row['Fine'] + $row['mid_term_exam'] + $row['annual_exam'] + $row['milad'] + $row['others']; ?>
                                <td><?php echo $row['total_bill']; ?></td>
                                <td><?php echo $row['due']; ?></td>
                                <td>
                                    <span class="label label-<?php if ($row['status'] == 'paid') echo 'green';else echo 'dark-red'; ?>"><?php echo $row['status']; ?></span>
                                </td>
                                <td><?php echo date('d M,Y', $row['creation_timestamp']); ?></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->

            <!----CREATION FORM STARTS---->
            <div class="tab-pane box active" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php
//                        $this->db->order_by('fees_id', 'asc');
//                        $fees_all = $this->db->get('fees_setup')->result_array();
//                        foreach($fees_all as $row_fee):
                    ?>
                    <?php echo form_open('admin/invoice/create', array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>
                    <div class="padded">
                        <?php /* if ($class_id == ''): ?>
                            <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                                <i class="icon-info-sign"></i> Please select a student to manage Fees.
                            </div>
                            <script>
                                $(document).ready(function() {
                                                                                                                                                    						  	
                                    function shake()
                                    {
                                        $( "#ask_class" ).effect( "shake" );
                                    }
                                    setTimeout(shake, 500);
                                });
                            </script>
                            <br /><br />
                        <?php endif; */ ?>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('student'); ?></label>

                            <div class="controls">                                
                                <select name="class_id" class="chzn-select classId" style="width:350px;" required="">
<!--                                     onchange="window.location='<?php echo base_url(); ?>index.php?admin/invoice/loadfee_by_class/'+this.value"-->
                                    <option value="">Please select student</option>
                                    <?php
                                    $count = 1;
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student_<?php echo $count; ?>" value="<?php echo $row['class_id']; ?>"  <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                            Class-<?php echo $row['class_id'] . "(" . $this->crud_model->get_class_name($row['class_id']) . ")"; ?>-Roll <?php echo $row['roll']; ?>-<?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                        $count++;
                                    endforeach;
                                    ?>
                                </select>

                                <input class="studentId" type="hidden" name="student_id" />
                            </div>
                        </div>                        

                        <?php
                        //echo "###".$class_id;
                        //if ($class_id != ''):
                        ?>

                        <div class="control-group">
                            <label class="control-label"><?php echo translate('title'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="title" required=""/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('description'); ?></label>
                            <div class="controls">
                                <input type="text" class="" name="description"/>
                            </div>
                        </div>

                        <div class="all_fee_container">

                        </div>

                        <?php /*
                          $count = 1;

                          foreach ($fees_setups as $row):
                          ?>
                          <div class="control-group">
                          <label class="control-label">
                          <?php
                          //echo get_phrase($row['fee_name']);
                          echo $row['fees_name_id'];
                          ?>
                          </label>
                          <div class="controls">
                          <input type="text" class="auto_calculate" name="<?php echo $row['fee_name']; ?>" value="<?php echo $row['fees_amount']; ?>" disabled="disabled">
                          <input type="hidden" class="auto_calculate" name="<?php echo $row['fee_name']; ?>" value="<?php echo $row['fees_amount']; ?>">
                          </div>
                          </div>
                          <?php
                          $count++;
                          endforeach; */
                        ?>

                        <?php /*
                          $count = 1;
                          $fee_name = $this->crud_model->get_fees_name();
                          foreach ($fee_name as $row):
                          ?>
                          <div class="control-group">
                          <label class="control-label">
                          <?php echo translate($row['fee_name']);
                          ?>
                          </label>
                          <div class="controls">
                          <input type="text" class="fee_<?php echo $count; ?>" class="auto_calculate" name="<?php echo $row['fee_name']; ?>" disabled="disabled">
                          <input type="hidden" class="auto_calculate fee_<?php echo $count; ?>" name="<?php echo $row['fee_name']; ?>">
                          </div>
                          </div>
                          <?php
                          $count++;
                          endforeach; */
                        ?>

                        <!--                        <div class="control-group">
                                                    <label class="control-label"><?php echo translate('monthly_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="monthly_fees" value="<?php echo $row_fee['fees_amount'] ?>" disabled="disabled"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Overdue'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="overdue"/>
                                                    </div>
                                                </div> 
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('admission_fees/re_admission_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="admission_fees"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Fine'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="Fine"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Absence_fine'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="absence_fine"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Late_fine'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="late_fine"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Bad_behavior'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="bad_behavior"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('development_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="dev_fees"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Session_fee_1st_installment'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="session_fee_1st_installment"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Session_fee_2nd_installment'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="session_fee_2nd_installment"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('sports_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="sports_fees"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Library_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="lib_fees"/>
                                                    </div>
                                                </div>  -->
                        <!--                        <div class="control-group">
                                                    <label class="control-label"><?php echo translate('tc_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="tc_fees"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('scout_fees'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="scout_fees"/>
                                                    </div>
                                                </div>-->
                        <!--                        <div class="control-group">
                                                    <label class="control-label"><?php echo translate('cultural_program'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="cultural_program"/>
                                                    </div>
                                                </div>                                                  
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('invoice_book'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="invoice_book"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Receipt_books'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="receipt_books"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Exam_fee'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="exam_fee"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('registration_fee'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="registration_fee"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('poor_fund'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="poor_fund"/>
                                                    </div>
                                                </div>                        
                                                
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('Laboratory_charge'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="lab_charge"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('electricity_bill'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="electricity_charge"/>
                                                    </div>
                                                </div>-->
                        <!--                        <div class="control-group">
                                                    <label class="control-label"><?php echo translate('IT_charge'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="IT_charge"/>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('mid_term_exam'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="mid_term_exam"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('milad'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="milad"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('others'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="others"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo translate('annual_exam'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" class="auto_calculate" name="annual_exam"/>
                                                    </div>
                                                </div>-->

                        <?php /*
                          $this->db->order_by('fees_id', 'asc');
                          $fees_all = $this->db->get('fees_setup')->result_array();
                          //                        echo '<pre>';
                          //                        print_r($fees_all);
                          $total_amount = 0;
                          foreach ($fees_all as $row):
                          $total_amount = $total_amount + $row['fees_amount'];
                          ?>
                          <?php //echo form_open('admin/fees_setup/' . $row['fees_name'] . '/do_update/', array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>
                          <!--                        <form method="post" action="<?php echo base_url(); ?>index.php?admin/fees_setup/<?php echo $row['fees_name']; ?>/do_update/" class="form-horizontal validatable">-->

                          <div class="control-group">
                          <label class="control-label"><?php echo translate($row['fees_name']); ?></label>
                          <div class="controls">
                          <input type="text" class="auto_calculate" name="fees_amount" disabled="disabled" value="<?php echo $row['fees_amount']; ?>"/>
                          </div>
                          </div>
                          <!--                        </form>-->
                          <?php
                          endforeach;
                         */ ?>

                        <div class="control-group">
                            <label class="control-label"><?php echo translate('total_bill'); ?></label>
                            <div class="controls">
                                <span id="sum"></span>
                                <input type="text" id="" class="total_bill" name="total_bill" value="<?php echo $total_amount; ?>" disabled="disabled"/>
                                <input type="hidden" id="" class="total_bill" name="total_bill" value="<?php echo $total_amount; ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('deposit'); ?></label>
                            <div class="controls">
                                <input type="text" class="deposit" name="deposit"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('weaver'); ?></label>
                            <div class="controls">
                                <input type="text" class="weaver" name="weaver"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('due'); ?></label>
                            <div class="controls">
                                <input type="text" id="" class="due_amount" name="due" value="<?php echo $total_amount; ?>" disabled="disabled"/>
                                <input type="hidden" id="" class="due_amount" name="due" value="<?php echo $total_amount; ?>"/>
                            </div>
                        </div>                        
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('status'); ?></label>
                            <div class="controls">
                                <select name="status" class="uniform" style="width:350px;" required="">
                                    <option value="paid"><?php echo translate('paid'); ?></option>
                                    <option value="unpaid"><?php echo translate('unpaid'); ?></option>
                                    <option value="partial"><?php echo translate('partial'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('date'); ?></label>
                            <div class="controls">
                                <input type="text" class="datepicker fill-up" name="date" required=""/>
                            </div>
                        </div>
                        <?php //endif;  ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo translate('add_invoice'); ?></button>
                    </div>
                    </form>
                    <?php //endforeach;   ?>
                </div>                
            </div>
            <!----CREATION FORM ENDS--->

        </div>
    </div>
</div>

<script type="text/javascript">
    //    $(".auto_calculate").on("blur", function(){
    //        var sum=0;
    //        $(".auto_calculate").each(function(){
    //            if($(this).val() != "")
    //            sum += parseInt($(this).val()); 
    //        });
    //        $(".total_bill").val(sum);
    //        $(".due_amount").val(sum);
    //    });
    
    
     
    $("select.classId").on("change", function(event) {
        event.preventDefault();
        
        str = $('select.classId option').filter(":selected").text();
        var res = str.split("-");
        var res2 = res[2].split(" ");        
        $( ".studentId" ).val( res2[1] );        
        console.log("Student ID ="+res2[1]);
        
        var class_id = $('select.classId option:selected').val();            
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>/index.php?admin/invoice/loadfee_by_class/"+class_id,
            dataType: "html",                
            success: function(data){
                try{        
                    var obj_data = jQuery.parseJSON(data);                            
                    $.each(obj_data, function(key, fee_data) {
                        var fee_name = '<?php echo translate('<script>'+fee_data.fee_name+'</script>'); ?>';
                        //console.log();
                        var html = '<div class="control-group"><label class="control-label">'+fee_name+'</label><div class="controls"><input type="text" class="fee_info" class="auto_calculate" name="'+fee_data.fee_name+'" value="'+fee_data.fees_amount+'" disabled="disabled">';
                        '<input type="hidden" class="auto_calculate fee_info" name="'+fee_data.fee_name+'" value="'+fee_data.fees_amount+'"></div></div>';
                        $('.all_fee_container').append(html);
                    });

                }catch(e) {     
                    alert('Exception while request..');
                }       
            },
            error: function(){                      
                alert('Error while request..');
            }
        });// you have missed this bracket
        //return false;
    });
        
    $(".deposit").on("blur", function(){
        var sum = $(".total_bill").val();
        var deposit = $('.deposit').val();
        var weaver = $('.weaver').val();
        var due = sum - deposit - weaver;
        $(".due_amount").val(due);
        //console.log("sum ="+sum+" due="+due+" deposit= "+deposit);
    });
           
    
</script>