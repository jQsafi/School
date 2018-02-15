<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach ($edit_data as $row): 
//            echo '<pre>';
//            print_r($row);
            ?>
            <?php echo form_open('admin/invoice/do_update/' . $row['invoice_id'], array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('student'); ?></label>
                    <div class="controls">
                        <select name="student_id" class="chzn-select" style="width:400px;" >
                            <?php
                            $this->db->order_by('class_id', 'asc');
                            $students = $this->db->get('student')->result_array();
                            foreach ($students as $row2):
                                if($row['class_id'] == $row2['class_id'] && $row['student_id'] == $row2['roll']){
                                    $selected ="selected";
                                }else {
                                    $selected ="";
                                }
                                ?>
                                <option disabled="disabled" value="<?php echo $row2['roll']; ?>" <?php  echo $selected; ?>>
                                    class <?php echo $this->crud_model->get_class_name($row2['class_id']); ?> -
                                    roll <?php echo $row2['roll']; ?> - <?php echo $row2['name']; ?>
                                </option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('title'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="title" value="<?php echo $row['title']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('description'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="description" value="<?php echo $row['description']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('monthly_fees'); ?></label>
                    <div class="controls">

                        <input type="text" class="" name="monthly_fees" value="<?php echo $row['monthly_fees']; ?>" disabled="disabled" />
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label"><?php echo translate('admission_fees'); ?></label>
                    <div class="controls">

                        <input type="text" class="" name="admission_fees" value="<?php echo $row['admission_fees']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('development_fees'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="dev_fees" value="<?php echo $row['dev_fees']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Session_fee_1st_installment'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="session_fee_1st_installment" value="<?php echo $row['session_fee_1st_installment']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Session_fee_2nd_installment'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="session_fee_2nd_installment" value="<?php echo $row['session_fee_2nd_installment']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('sports_fees'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="sports_fees" value="<?php echo $row['sports_fees']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('lib_fees'); ?></label>
                    <div class="controls">

                        <input type="text" class="" name="lib_fees" value="<?php echo $row['lib_fees']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('cultural_program'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="cultural_program" value="<?php echo $row['cultural_program']; ?>" disabled="disabled" />
                    </div>
                </div>                                                  
                <div class="control-group">
                    <label class="control-label"><?php echo translate('invoice_book'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="invoice_book" value="<?php echo $row['invoice_book']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Receipt_books'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="receipt_books" value="<?php echo $row['receipt_books']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Exam_fee'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="exam_fee" value="<?php echo $row['exam_fee']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('registration_fee'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="registration_fee" value="<?php echo $row['registration_fee']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('poor_fund'); ?></label>
                    <div class="controls">

                        <input type="text" class="" name="poor_fund" value="<?php echo $row['poor_fund']; ?>" disabled="disabled" />
                    </div>
                </div>                
                <div class="control-group">
                    <label class="control-label"><?php echo translate('lab_charge'); ?></label>
                    <div class="controls">
                        <input type="text" class="" name="lab_charge" value="<?php echo $row['lab_charge']; ?>" disabled="disabled" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('electricity_charge'); ?></label>
                    <div class="controls">

                        <input type="text" class="" name="electricity_charge" value="<?php echo $row['electricity_charge']; ?>" disabled="disabled" />
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?php echo translate('total_bill'); ?></label>
                    <div class="controls">
                        <span id="sum"> <?php //echo "Total bill = ". $row['total_bill']; ?></span>
                        <input type="text" id="" class="total_bill" name="total_bill" disabled="disabled" value="<?php echo $row['total_bill']; ?>"/>
                        <input type="hidden" id="" class="total_bill" name="total_bill" value="<?php echo $row['total_bill']; ?>"/>
                    </div>
                </div>
                
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Overdue'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="overdue" value="<?php echo $row['overdue']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Fine'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="Fine" value="<?php echo $row['Fine']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Absence_fine'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="absence_fine" value="<?php echo $row['absence_fine']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Late_fine'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="late_fine" value="<?php echo $row['late_fine']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('Bad_behavior'); ?></label>
                    <div class="controls">
                        <input type="text" class="auto_calculate" name="bad_behavior" value="<?php echo $row['bad_behavior']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('deposit'); ?></label>
                    <div class="controls">
                        <input type="text" class="deposit" name="deposit" value="<?php echo $row['deposit']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('weaver'); ?></label>
                    <div class="controls">
                        <input type="text" class="due_calculation weaver" name="weaver" value="<?php echo $row['weaver']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('due'); ?></label>
                    <div class="controls">
                        <input type="text" id="" class="due_amount" name="due" disabled="disabled" value="<?php echo $row['due']; ?>"/>
                        <input type="hidden" id="" class="due_amount" name="due" value="<?php echo $row['due']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('status'); ?></label>
                    <div class="controls">
                        <select name="status" class="uniform" style="width:100%;">
                            <option class="paid" value="paid" <?php if ($row['status'] == 'paid') echo 'selected'; ?>><?php echo translate('paid'); ?></option>
                            <option class="unpaid" value="unpaid" <?php if ($row['status'] == 'unpaid') echo 'selected'; ?>><?php echo translate('unpaid'); ?></option>
                            <option class="partial" value="partial" <?php if ($row['status'] == 'partial') echo 'selected'; ?>><?php echo translate('partial'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('date'); ?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="date" 
                               value="<?php echo date('m/d/Y', $row['creation_timestamp']); ?>"/>
                    </div>

                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_invoice'); ?></button>
            </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
    $(".auto_calculate").on("blur", function(){
        var sum=0;
        $(".auto_calculate").each(function(){
            if($(this).val() != "")
                sum += parseInt($(this).val()); 
        });
        $(".total_bill").val(sum);
        $(".due_amount").val(sum);
    });
    $(".deposit").on("blur", function(){
        var sum = $(".total_bill").val();
        var deposit = $('.deposit').val();
        var weaver = $('.weaver').val();
        
        var due = (sum - deposit - weaver);
        $(".due_amount").val(due);
        //console.log("sum ="+sum+" due="+due+" deposit= "+deposit);
    });

//    $(".due_calculation").on("blur", function() {
//        var sum = parseInt($(".total_bill").val());
//        
//        var overdue = parseInt($('.overdue').val());
//        var Fine = parseInt($('.Fine').val());
//        var absenceFine = parseInt($('.absence_fine').val());
//        var lateFine = parseInt($('.late_fine').val());
//        var badBehavior = parseInt($('.bad_behavior').val());
//        
//        var totalBill = (sum + overdue + Fine + absenceFine + lateFine + badBehavior);
//        //console.log("totalBill= "+totalBill);
//        var deposit = $('.deposit').val();
//        var weaver = $('.weaver').val();
//        
//        var due = totalBill - (deposit + weaver);
//        //console.log("----due= "+due);
//        $(".due_amount").val(due);
//        
//        if(due > 0){
//            $("select option").removeAttr("selected", "selected");
//            $("select option.partial").attr("selected", "selected");
//        } else if(due <= 0){
//            $("select option").removeAttr("selected", "selected");
//            $("select option.paid").attr("selected", "selected");
//        } else {
//            $("select option").removeAttr("selected", "selected");
//            $("select option.unpaid").attr("selected", "selected");
//        }
//    });
</script>