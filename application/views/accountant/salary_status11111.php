<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php
			$this->load->view('includes');
		?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
<body>
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
            	<a href="#monthly" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Salary Sheet');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
           <!----monthly report genarate start--->
		
		<div class="tab-pane active" id="monthly">
            <center>
                <?php echo form_open('accountant/salary_status'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Month'); ?></label>
                                <div class="controls">
                                    <select name="month" class="expenseBy" id="monthstatus">
											<option value="">Please select</option>
											<?php
											$currentmonth=date("n");
                                            $months = $this->db->get('month')->result_array();
											foreach ($months as $row3):
											?>
											 <?php if ($row3['id']<=$currentmonth): ?>
											<option value="<?php echo $row3['id']; ?>"><?php echo $row3['name']; ?></option>
											<?php endif; ?>
											<?php
											endforeach;
											?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('year'); ?></label>
                                <div class="controls">
                                    <select name="year" class="expenseID" id="yearstatus">
                                        <option value="">Please select</option>
                                     <?php
									 $starting_year  = 2014;
									 $ending_year    = date('Y');

									 for($thisYear; $starting_year <= $ending_year; $starting_year++) {
									 
									  print '<option value="'.$starting_year.'">'.$starting_year.'</option>';
									}

							        ?>	
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="operation" value="selection" />
                      <!--     <a data-toggle="modal" href="#modal-form" onclick="modal('month_salary',document.getElementById('monthstatus').value,document.getElementById('yearstatus').value)"
                                                 class="btn btn-default btn-small">
                                                    <i class="icon-user"></i> <?php echo translate('Salary Sheet');?>
                                            </a>    -->
                      
                                                  <input type="hidden" name="operation" value="selection" />
                            <input type="submit" value="<?php echo translate('Salary Sheet');?>" class="btn btn-default btn-small" />
                   
                    
                   
                   
                        </td>
                    </tr>
                </table>
            </form>
            </center>


            <br /><br />          
        </div>
        <!----monthly report genarate ENDS--->
            
            
		</div>
	</div>
</div>


<?php                
                $number_of_row = count($salaryreport);
                if ($number_of_row >= 1) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive" id="xsaralyreport" style="overflow-x: auto;">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('Sl._No'); ?></div></th>
                            <th><div><?php echo translate('Date'); ?></div></th>
                            <th><div><?php echo translate('Employee ID'); ?></div></th>
                            <th><div><?php echo translate('Joining Date'); ?></div></th>
                            <th><div><?php echo translate('Designation'); ?></div></th>
                            <th><div><?php echo translate('Index Number'); ?></div></th>
                            <th><div><?php echo translate('Name'); ?></div></th>
                            <th><div><?php echo translate('Basic'); ?></div></th>
                            <th><div><?php echo translate('Medical Allowance'); ?></div></th>
                            <th><div><?php echo translate('HouseRent'); ?></div></th>
                            <th><div><?php echo translate('Convince'); ?></div></th>
                            <th><div><?php echo translate('Gross Salary'); ?></div></th>
                            <th><div><?php echo translate('Tax'); ?></div></th>
							<th><div><?php echo translate('Others'); ?></div></th>
                            <th><div><?php echo translate('Advance'); ?></div></th>
                            <th><div><?php echo translate('Deduction'); ?></div></th>
							<th><div><?php echo translate('loan'); ?></div></th>
							<th><div><?php echo translate('Bonus'); ?></div></th>
							<th><div><?php echo translate('Total pay'); ?></div></th>
                            <th><div><?php echo translate('Note'); ?></div></th>
							<th><div><?php echo translate('option'); ?></div></th>
                                                        <th><div><?php echo translate('Pay slip'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $serial_no = 1;
                        foreach ($salaryreport as $row): ?>
                            <tr>
                                <td><?php echo $serial_no; ?></td>
								<td><?php $monthName = date('m', mktime(0, 0, 0, $row['month'], 10)); $lastday=date('t', mktime(0, 0, 0,$row['month'], 10)); echo $lastday."-".$monthName."-".$row['year']; ?></td>
                                <td>
                                <?php
                                    $teacher_id = $row['teacher_id'];
                                   // $class_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->class_id;
                                    echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->employeeID;
                                ?>
                                </td>
								<td>
                                <?php
                                    echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->joiningDate;
                                ?>
                                </td>
								<td>
                                <?php
								    $deg_id = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->designation;
                                    echo $this->db->get_where('designation', array('id' => $deg_id))->row()->name;
                                ?>
                                </td>
								<td><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->indexNumber;?></td>
								<td><?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?>
                                </td>
                                <td><?php echo $row['Basic']; ?></td>
                                <td><?php echo $row['MedicalAllowance']; ?></td>
                                <td><?php echo $row['HouseRent']; ?></td>
                                <td><?php echo $row['Convince']; ?></td>
                                <td><?php echo $row['gsalary']; ?></td>
                                <td><?php echo $row['Tax']; ?></td>
                                <td><?php echo $row['Others']; ?></td>
                                <td><?php echo $row['Advance']; ?></td>
                                <td><?php echo $row['Deduction']; ?></td>
								<td><?php echo $row['loan']; ?></td>
								<td><?php echo $row['bonus']; ?></td>
								<td><?php echo $row['tsalary']; ?></td>
                                <td><?php echo $row['Note']; ?></td>
							<!--	<td><a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?accountant/salary_status/delete/<?php echo $row['id'];?>')" class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo translate('delete');?>
                                            </a>
								</td>   -->
                                                        <td><a href="<?php echo base_url(); ?>index.php?accountant/salary_status/delete/<?php echo $row['id'];?>"  class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo translate('delete');?>
                                            </a>
								</td>
                                                                <td><a href="<?php echo base_url();?>index.php?accountant/payslip/<?php echo $row['id'];?>" window="new" win_height="816px" win_width="1200px" class="btn btn-red btn-small">
                                                     <?php echo translate('pay silp');?>
                                            </a>
								</td>
                            </tr>
                    <?php 
                        $serial_no++;    
                        endforeach; 
                    ?>
                 <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xsaralyreport').tableExport({type:'excel',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xsaralyreport').tableExport({type:'doc',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                 </div>
				

            <?php }  ?>

                    </tbody>
                </table>


</body>
</html>
<script>
  
	function link_generate(m,v)
	{
		
	}
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