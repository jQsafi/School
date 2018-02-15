
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
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
<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                   <?php echo translate('Salary Report'); ?>
                </a></li>

        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane  active" id="list">
            <center>
                <?php echo form_open('admin/salaryreport'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td> <?php echo $info;?>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Month'); ?></label>
                                <div class="controls">
                                    <select name="month" class="expenseBy">
											<option value="">Please select</option>
											<option value="01" <?php if($month=='01') echo 'selected';?>>January</option>
											<option value="02" <?php if($month=='02') echo 'selected';?>>February</option>      
											<option value="03" <?php if($month=='03') echo 'selected';?>>March</option>      
											<option value="04" <?php if($month=='04') echo 'selected';?>>April</option>      
											<option value="05" <?php if($month=='05') echo 'selected';?>>May</option>      
											<option value="06" <?php if($month=='06') echo 'selected';?>>June</option>      
											<option value="07" <?php if($month=='07') echo 'selected';?>>July</option>      
											<option value="08" <?php if($month=='08') echo 'selected';?>>August</option>      
											<option value="09" <?php if($month=='09') echo 'selected';?>>September</option>      
											<option value="10" <?php if($month=='10') echo 'selected';?>>October</option>      
											<option value="11" <?php if($month=='11') echo 'selected';?>>November</option>      
											<option value="12" <?php if($month=='12') echo 'selected';?>>December</option>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('year'); ?></label>
                                <div class="controls">
                                    <select name="year" class="expenseID">
                                        <option value="">Please select</option>
                                     <?php
									 $starting_year  = 2014;
									 $ending_year    = 2050;
									 for($thisYear; $starting_year <= $ending_year; $starting_year++) {
									  echo '<option value="'.$starting_year.'"';
									  if($year==$starting_year)
									  echo " selected ";
									  echo '>'.$starting_year.'</option>';
									}
									?>	
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Employee ID'); ?></label>
                                <div class="controls">
                                    <input type="text" name="employeeID" value="<?=$employeeID?>"/>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('designation'); ?></label>
                                <div class="controls">
                                    <select name="designation" class="expenseName">
                                        <option value="">Please select</option>
                                        <?php	$d_designation = $this->db->get_where('designation')->result_array(); 
										foreach($d_designation as $row2):
										?>
                                    	<option value="<?php echo $row2['name'];?>" <?php if($designation==$row2['name']) echo 'selected';?>><?php echo $row2['name'];?></option>
										<?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Gross_Salary'); ?></label>
                                <div class="controls">
                                    <input type="text" name="gsalary" value="<?=$gsalary?>"/>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('advance'); ?></label>
                                <div class="controls">
                                    <input type="text" name="advance" value="<?=$advance?>">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('deduction'); ?></label>
                                <div class="controls">
                                    <input type="text" name="deduction"  value="<?=$deduction?>"/>
                                </div>
                            </div>
                        </td>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Total Pay'); ?></label>
                                <div class="controls">
                                    <input type="text" name="tsalary" value="<?=$tsalary?>" />
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
                $number_of_row = count($salaryreport);
                if ($number_of_row >= 1) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-normal responsive" id="xsaralyreport" style="overflow-x: auto;">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('#'); ?></div></th>
                            <th><div><?php echo translate('ID'); ?></div></th>
                            <th><div><?php echo translate('name'); ?></div></th>
							<th><div><?php echo translate('designation'); ?></div></th>
							<th><div><?php echo translate('month'); ?></div></th>
                            <th><div><?php echo translate('Basic'); ?></div></th>
                            <th><div><?php echo translate('Medical'); ?></div></th>
                            <th><div><?php echo translate('House'); ?></div></th>
                            <th><div><?php echo translate('Convince'); ?></div></th>
							<th><div><?php echo translate('Others'); ?></div></th>
                            <th><div><?php echo translate('Gross'); ?></div></th>
							<th><div><?php echo translate('Bonus'); ?></div></th>
							<th><div><?php echo translate('pf'); ?></div></th>
                            <th><div><?php echo translate('Tax'); ?></div></th>
                            <th><div><?php echo translate('Advance'); ?></div></th>
                            <th><div><?php echo translate('Deduction'); ?></div></th>
							<th><div><?php echo translate('loan'); ?></div></th>
							<th><div><?php echo translate('Total pay'); ?></div></th>
							<!--<th><div><?php echo translate('option'); ?></div></th>-->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $serial_no = 1;
                        foreach ($salaryreport as $row): ?>
                            <tr>
                                <td><?php echo $serial_no; ?></td>
                                <td>
                                <?php
                                    $teacher_id = $row['teacher_id'];
                                   // $class_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->class_id;
                                    echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->employeeID;
                                ?>
                                </td>
								<!--<td>
                                <?php
                                    echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->joiningDate;
                                ?>
                                </td>-->
								<!--<td><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->indexNumber;?></td>-->
								<td><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?>
                                </td>
								<td>
                                <?php
								    $deg_id = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->designation;
                                    echo $this->db->get_where('designation', array('id' => $deg_id))->row()->name;
                                ?>
                                </td>
								<td>
								<?php 
								$monthName = date('F', mktime(0,0,0,$row['month']));
								echo $monthName." ,".$row['year']; ?>
								</td>
                                <td><?php echo $row['Basic']; ?></td>
                                <td><?php echo $row['MedicalAllowance']; ?></td>
                                <td><?php echo $row['HouseRent']; ?></td>
                                <td><?php echo $row['Convince']; ?></td>
								<td><?php echo $row['Others']; ?></td>
                                <td><?php echo $row['gsalary']; ?></td>
								<td><?php echo $row['bonus']; ?></td>
								<td><?php echo $row['pf']; ?></td>
                                <td><?php echo $row['Tax']; ?></td>
                                <td><?php echo $row['Advance']; ?></td>
                                <td><?php echo $row['Deduction']; ?></td>
								<td><?php echo $row['loan']; ?></td>
								<td><?php echo $row['tsalary']; ?></td>
                                <!--<td><?php echo $row['Note']; ?></td>-->
								<!--<td><a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/salaryreport/delete/<?php echo $row['id'];?>')" class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i><?php echo translate('delete');?>
                                            </a>
								</td>-->
                            </tr>
                    <?php 
                        $serial_no++;    
                        endforeach; 
                    ?>

                    </tbody>
                </table>
				
				 <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xsaralyreport').tableExport({type:'excel',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i><?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xsaralyreport').tableExport({type:'doc',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i><?php echo translate('download word'); ?>
                    </a>
                 </div>
				

            <?php }  ?>
        </div>
        <!----TABLE LISTING ENDS--->
		
		

    </div>
</div>

<script type="text/javascript">
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