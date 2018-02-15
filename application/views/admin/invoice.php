<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">            
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('invoice/payment_list'); ?>
                </a>
            </li>
            <!--<li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo translate('add_invoice/payment'); ?>
                </a>

            </li>-->

        </ul>
        <!------CONTROL TABS END------->

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" id="xinvoice_list">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo translate('Class'); ?></div></th>
							<th><div><?php echo translate('ID'); ?></div></th>
							<th><div><?php echo translate('Roll No'); ?></div></th>
                            <th><div><?php echo translate('name'); ?></div></th>
                            <th><div><?php echo translate('Invoice Number'); ?></div></th>
							<th><div><?php echo translate('Payment For'); ?></div></th>
                            <th><div><?php echo translate('Total Payment'); ?></div></th>
                            <th><div><?php echo translate('status'); ?></div></th>
                            <th><div><?php echo translate('date'); ?></div></th>
                            <th><div><?php echo translate('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($invoices as $row):
							$class_id=get_single_value('class_id','student',array('student_id'=>$row['student_id']));
							$class_name=get_single_value('name','class',array('class_id'=>$class_id));
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $class_name; ?></td>
                                <td><?php echo get_single_value('student_unique_ID','student',array('student_id'=>$row['student_id'])); ?></td>
                                <td><?php echo get_single_value('roll','student',array('student_id'=>$row['student_id'])); ?></td>
                                <td><?php echo get_single_value('name','student',array('student_id'=>$row['student_id'])); ?></td>
                                <td><?php echo $row['invoice_number']; ?></td>
								<td><?php echo $row['payment_month']; ?></td>
								<td><?php echo $row['total_collection']; ?></td>
								<td><?php echo strtoupper($row['payment_status']); ?></td>
								<td><?=date("d-M-Y",strtotime($row['payment_date']))?></td>
                                <td align="center">
                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo translate('view'); ?>
                                    </a>
    <!--                                    <a data-toggle="modal" href="#modal-form" onclick="modal('view_payment',<?php echo $row['invoice_id']; ?>)" class="btn btn-default btn-small">
                                        <i class="icon-credit-card"></i> <?php echo "Payment"; ?>
                                    </a>-->
                                    <!--<a data-toggle="modal" href="#modal-form" onclick="modal('edit_invoice',<?php echo $row['invoice_id']; ?>)" class="btn btn-gray btn-small">
                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                    </a>-->
                                    <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/invoice/delete/<?php echo $row['invoice_id']; ?>')" class="btn btn-red btn-small">
                                        <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                    </a>
                                </td>
                            </tr>
                        <?php 
						$count++;endforeach; ?>
                    </tbody>
                </table>
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xinvoice_list').tableExport({type:'excel',escape:'false',ignoreColumn: [10]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xinvoice_list').tableExport({type:'doc',escape:'false',ignoreColumn: [10]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>
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
                                                    <a data-toggle="modal" href="#modal-form" onclick="modal('student_profile',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-user"></i> <?php echo translate('profile'); ?>
                                                    </a>
                                                    <a data-toggle="modal" href="#modal-form" onclick="modal('student_academic_result',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-file-alt"></i> <?php echo translate('marksheet'); ?>
                                                    </a>
                                                    <a data-toggle="modal" href="#modal-form" onclick="modal('student_id_card',<?php echo $row['student_id']; ?>)" class="btn btn-default btn-small">
                                                        <i class="icon-credit-card"></i> <?php echo translate('id_card'); ?>
                                                    </a>
                                                    <a data-toggle="modal" href="#modal-form" onclick="modal('edit_student',<?php echo $row['student_id']; ?>,<?php echo $class_id; ?>)" class="btn btn-gray btn-small">
                                                        <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                                    </a>
                                                    <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>')" class="btn btn-red btn-small">
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
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/invoice/create', array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>
                    <div class="padded">
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('student'); ?></label>

                            <div class="controls">                                
                                <select name="class_id_select" class="chzn-select classId" style="width:350px;" required="">
                                    <option class="" value="0">Please select student</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student_<?php echo $row['class_id']; ?>" value="<?php echo $row['roll']; ?>"  <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                            Class-<?php echo $row['class_id'] . "(" . $this->crud_model->get_class_name($row['class_id']) . ")"; ?>-Roll <?php echo $row['roll']; ?>-<?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                <input class="class_id" type="hidden" name="class_id" />
                                <input class="studentId" type="hidden" name="student_id" />
                            </div>
                        </div>
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

                        <div class="control-group">
                            <label class="control-label"><?php echo translate('total_bill'); ?></label>
                            <div class="controls">
                                <span id="sum"></span>
                                <input type="text" id="" class="total_bill" name="total_bill" value="<?php echo $total_amount; ?>" disabled="disabled"/>
                                <input type="hidden" id="" class="total_bill" name="total_bill" value="<?php echo $total_amount; ?>"/>
                            </div>
                        </div>
<!--                        <div class="control-group">
                            <label class="control-label"><?php //echo get_phrase('extra_fine'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation extra_fine" name="extra_fine" value="0"/>
                            </div>
                        </div>-->
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('overdue'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation overdue" name="overdue" value="0"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('Fine'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation Fine" name="Fine" value="0"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('absence_fine'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation absence_fine" name="absence_fine" value="0"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('late_fine'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation late_fine" name="late_fine" value="0"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('bad_behavior'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation bad_behavior" name="bad_behavior" value="0"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('deposit'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation deposit" name="deposit"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('weaver'); ?></label>
                            <div class="controls">
                                <input type="text" class="due_calculation weaver" name="weaver"/>
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
                                    <option class="paid" value="paid"><?php echo translate('paid'); ?></option>
                                    <option class="unpaid" value="unpaid"><?php echo translate('unpaid'); ?></option>
                                    <option class="partial" value="partial"><?php echo translate('partial'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo translate('date'); ?></label>
                            <div class="controls">
                                <input type="text" class="datepicker fill-up" name="creation_date" required=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo translate('add_invoice'); ?></button>
                    </div>
                    <?php form_close(); ?>
                </div>                
            </div>
            <!----CREATION FORM ENDS--->
        </div>
    </div>
</div>

<script type="text/javascript">    
    $("select.classId").on("change", function(event) {
        event.preventDefault();
        
        var sum = 0;
        $(".total_bill").val(0);
        $(".due_amount").val(0);
                
        var student_id = $('select.classId option:selected').val();
        $( ".studentId" ).val(student_id);
        
        var str_class = $('select.classId option:selected').attr('class');
        //console.log(str_class);
        var res = str_class.split("_");        
        var class_id = res[1];
        $( ".class_id" ).val(class_id);
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>/index.php?admin/invoice/loadfee_by_class/"+class_id+"/"+student_id,
            dataType: "html",
            success: function(data){
                try{
                    $('.all_fee_container').html(" ");
                    var total_amount;
                    var obj_data = $.parseJSON(data);
                    
                    if(obj_data.total_bill_next){
                        $(".total_bill").val(obj_data.total_bill_next);
                        $(".due_amount").val(obj_data.total_bill_next);
                    }else {
                        $.each(obj_data, function(key, fee_data) {
                            var html = '<div class="control-group"><label class="control-label">'+fee_data.fee_full_name+'</label><div class="controls"><input type="text" class="fee_info auto_calculate" name="'+fee_data.fee_name+'" value="'+fee_data.fees_amount+'" disabled="disabled"><input type="hidden" class="auto_calculate fee_info" name="'+fee_data.fee_name+'" value="'+fee_data.fees_amount+'"></div></div>';
                            $('.all_fee_container').append(html);
                            total_amount = fee_data.total_bill;
                        });
                        $(".total_bill").val(total_amount);
                        $(".due_amount").val(total_amount);
                    }                    
                }catch(e) {
                    alert('Exception while request..');
                }
            },
            error: function(){
                alert('Error while request..');
            }
        });
        return false;
    });
        
    $(".due_calculation").on("blur", function() {
        var sum = parseInt($(".total_bill").val());
        
        var overdue = parseInt($('.overdue').val());
        var Fine = parseInt($('.Fine').val());
        var absenceFine = parseInt($('.absence_fine').val());
        var lateFine = parseInt($('.late_fine').val());
        var badBehavior = parseInt($('.bad_behavior').val());
        
        var totalBill = (sum + overdue + Fine + absenceFine + lateFine + badBehavior);
        
        var deposit = $('.deposit').val();
        var weaver = $('.weaver').val();
        
        var due = totalBill - deposit - weaver;
        //console.log("----due= "+due);
        $(".due_amount").val(due);
        
        if(due > 0){
            $("select option").removeAttr("selected", "selected");
            $("select option.partial").attr("selected", "selected");
        } else if(due <= 0){
            $("select option").removeAttr("selected", "selected");
            $("select option.paid").attr("selected", "selected");
        } else {
            $("select option").removeAttr("selected", "selected");
            $("select option.unpaid").attr("selected", "selected");
        }
    });
</script>