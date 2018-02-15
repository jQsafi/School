<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/invoice/do_update/'.$row['invoice_id'], array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo translate('student');?></label>
                    <div class="controls">
                        <select name="student_id" class="chzn-select" style="width:400px;" >
                            <?php 
                            $this->db->order_by('class_id','asc');
                            $students = $this->db->get('student')->result_array();
                            foreach($students as $row2):
                            ?>
                                <option value="<?php echo $row2['student_id'];?>"
                                    <?php if($row['student_id']==$row2['student_id'])echo 'selected';?>>
                                    class <?php echo $this->crud_model->get_class_name($row2['class_id']);?> -
                                    roll <?php echo $row2['roll'];?> -
                                    <?php echo $row2['name'];?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('title');?></label>
                    <div class="controls">
                        <input type="text" class="" name="title" value="<?php echo $row['title'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('description');?></label>
                    <div class="controls">
                        <input type="text" class="" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
                                   
                              <div class="control-group">
                                <label class="control-label"><?php echo translate('monthly_fees');?></label>
                                <div class="controls">
                                 
                                    <input type="text" class="" name="monthly_fees" value="<?php echo $row['monthly_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('admission_fees');?></label>
                                <div class="controls">
                                  
                                    <input type="text" class="" name="admission_fees" value="<?php echo $row['admission_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('admission_form');?></label>
                                <div class="controls">
                                    
                                    <input type="text" class="" name="admission_form" value="<?php echo $row['admission_form'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('tc_fees');?></label>
                                <div class="controls">
                                   
                                    <input type="text" class="" name="tc_fees" value="<?php echo $row['tc_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('scout_fees');?></label>
                                
                                <div class="controls">
                                  
                                    <input type="text" class="" name="scout_fees" value="<?php echo $row['scout_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('lib_fees');?></label>
                                <div class="controls">
                                    
                                    <input type="text" class="" name="lib_fees" value="<?php echo $row['lib_fees'];?>"/>
                                </div>
                            </div>                            <div class="control-group">
                                <label class="control-label"><?php echo translate('poor_fund');?></label>
                                <div class="controls">
                                    
                                    <input type="text" class="" name="poor_fund" value="<?php echo $row['poor_fund'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('dev_fees');?></label>
                                <div class="controls">
                                   
                                    <input type="text" class="" name="dev_fees" value="<?php echo $row['dev_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('sports_fees');?></label>
                                <div class="controls">
                                  
                                    <input type="text" class="" name="sports_fees" value="<?php echo $row['sports_fees'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('lab_charge');?></label>
                                <div class="controls">
                                
                                    <input type="text" class="" name="lab_charge" value="<?php echo $row['lab_charge'];?>"/>
                                </div>
                            </div>
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('electricity_charge');?></label>
                                <div class="controls">
                               
                                    <input type="text" class="" name="electricity_charge" value="<?php echo $row['electricity_charge'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('IT_charge');?></label>
                                <div class="controls">
                                    
                                    <input type="text" class="" name="IT_charge" value="<?php echo $row['IT_charge'];?>"/>
                                </div>
                            </div>
                            
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('Fine');?></label>
                                <div class="controls">
                                   
                                    <input type="text" class="" name="Fine" value="<?php echo $row['Fine'];?>"/>
                                </div>
                            </div>
                            
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('mid_term_exam');?></label>
                                <div class="controls">
                                   
                                    <input type="text" class="" name="mid_term_exam" value="<?php echo $row['mid_term_exam'];?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('annual_exam');?></label>
                                <div class="controls">
                                   
                                    <input type="text" class="" name="annual_exam" value="<?php echo $row['annual_exam'];?>"/>
                                </div>
                            </div>
                            
                        
                                                        <div class="control-group">
                                <label class="control-label"><?php echo translate('milad');?></label>
                                
                                <div class="controls">
                                    <input type="text" class="" name="milad" value="<?php echo $row['milad'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('others');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="others" value="<?php echo $row['others'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('deposit');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="deposit" value="<?php echo $row['deposit'];?>"/>
                                </div>
                            </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('status');?></label>
                    <div class="controls">
                        <select name="status" class="uniform" style="width:100%;">
                            <option value="paid" <?php if($row['status']=='paid')echo 'selected';?>><?php echo translate('paid');?></option>
                            <option value="unpaid" <?php if($row['status']=='unpaid')echo 'selected';?>><?php echo translate('unpaid');?></option>
                            <option value="partial" <?php if($row['status']=='partial')echo 'selected';?>><?php echo translate('partial');?></option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo translate('date');?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="date" 
                            value="<?php echo date('m/d/Y', $row['creation_timestamp']);?>"/>
                    </div>

                </div>

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo translate('edit_invoice');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>