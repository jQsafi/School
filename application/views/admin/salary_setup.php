<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('salary_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo translate('Payroll_Structure');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
            		<div class="action-nav-normal">
                        <div class=" action-nav-button" style="width:300px;">
                          <a href="#" title="Users">
                            <img src="<?php echo base_url();?>template/images/icons/teacher.png" />
                            <span>Total <?php echo count($teachers);?> Staff</span>
                          </a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-content">
                            <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div>No.</div></th>
										<th><div><?php echo translate('Name');?></div></th>
                                        <th><div><?php echo translate('Basic');?></div></th>
                                        <th><div><?php echo translate('Medical_Allowance');?></div></th>
                                        <th><div><?php echo translate('House_Rent');?></div></th>
                                        <th><div><?php echo translate('options');?></div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1;foreach($teachers as $row):?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php $query = $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']));
										$res = $query->result_array();
										foreach ($res as $row1) 
												$teachername=$row1['name'];
								                echo $teachername;?></td>
										<td><?php echo $row['Basic'];?>Tk.</td>
										<td><?php echo $row['MedicalAllowance'];?>Tk.</td>
                                        <td><?php echo $row['HouseRent'];?> Tk.</td>
                                        <td align="center">
                                            <a data-toggle="modal" href="#modal-form" onclick="modal('edit_salary',<?php echo $row['id'];?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo translate('edit');?>
                                            </a>
                                            <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/salary_setup/delete/<?php echo $row['id'].'/'.$row['teacher_id'] ;?>')"
                                                 class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo translate('delete');?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/salary_setup/create' , array('class' => 'form-horizontal validatable','enctype' => 'multipart/form-data'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?admin/salary_setup/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
						
						
						    <div class="control-group">
                                <label class="control-label"><?php echo translate('employee Name');?></label>
                                <div class="controls">
									<select name="employeename" class="uniform" style="width:100%;" onchange="designationfn(this.value)">
									    <option value=""></option>		
							<?php	$employeename = $this->db->get_where('teacher', array('salary_setup' =>0))->result_array(); 
							foreach($employeename as $row1):
							?>
                                    	<option value="<?php echo $row1['teacher_id'];?>"><?php echo $row1['name'];?></option>
                            <?php
                            endforeach;
                            ?>
										
                                    </select>
									<input type="hidden" name="teacherid" id="teacherid" />
									<a class="btn btn-default btn-small" onclick="modal('teacher_profile',document.getElementById('teacherid').value)" href="#modal-form" data-toggle="modal">
                                        <i class="icon-user"></i> Profile</a>
									
                                </div>
                            </div>

						    <div class="control-group">
                                <label class="control-label"><?php echo translate('Basic');?></label>
                                <div class="controls">
                                    <input type="text" name="Basic" id="Basic" onkeyup="makeitright(this.value)" />TK.
                                </div>
                            </div>
							
							
						
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Medical_Allowance');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue1(this.value)" id="MedicalAllowancePer"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="MedicalAllowance" id="MedicalAllowance" placeholder="amount in Taka" />TK.
                                </div>
                            </div>
                            
                            
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('House_Rent');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue2(this.value)"  id="HouseRentPer" placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="HouseRent" id="HouseRent" placeholder="amount in Taka" />TK.
                                </div>
                            </div>
                            
                              
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('Convince');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue3(this.value)" id="ConvincePer" placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Convince" id="Convince" placeholder="amount in Taka" />TK.
                                </div>
                            </div>
                            
							<!--<div class="control-group">
                                    <label class="control-label"><?php // echo get_phrase('Working_day'); ?></label>
                                    <div class="controls">
                                        <input type="text" name="WorkingHour"/>
                                    </div>
                            </div>-->
							<div class="control-group">
                                <label class="control-label"><?php echo translate('pf');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue6(this.value)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="pf" id="pf" placeholder="<?=translate('amount_of_taka')?>" />TK.
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Tax');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue4(this.value)" id="TaxPer" placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Tax" id="Tax" placeholder="amount in Taka" />TK.
                                </div>
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Others');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue5(this.value)" id="OthersPer"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Others" id="Others" placeholder="amount in Taka" />TK.
                                </div>
                            </div>
							
							<!--<div class="control-group">
                                <label class="control-label"><?php //echo get_phrase('Deduction');?></label>
                                <div class="controls">
                                    <input type="text" onkeyup="changevalue7(this.value)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Deduction" id="Deduction" placeholder="amount in Taka" />TK.
                                </div>
                            </div>-->
							
							
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('notes');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="notes"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_salary_setup');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>
<script>

function designationfn(teacherid)
{
$("#teacherid").val(teacherid);
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
    
function makeitright(basic)
	{
	//alert(basic);
	var MedicalAllowancePer=$("#MedicalAllowancePer").val();
	var HouseRentPer=$("#HouseRentPer").val();
	var ConvincePer=$("#ConvincePer").val();
	var TaxPer=$("#MedicalAllowancePer").val();
	var OthersPer=$("#MedicalAllowancePer").val();
	$("#MedicalAllowance").val((basic*MedicalAllowancePer)/100);
	$("#HouseRent").val((basic*HouseRentPer)/100);
	$("#Convince").val((basic*ConvincePer)/100);
	$("#Tax").val((basic*TaxPer)/100);
	$("#Others").val((basic*OthersPer)/100);
	}
	
	
	function changevalue1(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#MedicalAllowance").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue2(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#HouseRent").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	
	function changevalue3(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Convince").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue4(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Tax").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue5(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Others").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue6(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#pf").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue7(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Deduction").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	
	
	
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>