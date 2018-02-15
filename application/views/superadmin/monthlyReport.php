<?php if($class_id != ""):?>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('payment List');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo translate('add_student');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
				<center>
                	<br />
                	<select name="class_id" onchange="window.location='<?php echo base_url();?>index.php?admin/monthlyReport/'+this.value">
                    	<option value=""><?php echo translate('select_a_class');?></option>
						<?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                            	<?php if($class_id == $row['class_id'])echo 'selected';?>>
                                	Class <?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <br /><br />
					<?php if($class_id	==	''):?>
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
                    <?php endif;?>
                <?php if($class_id	!=	''):?>
                
                    <div class="action-nav-normal">
                        <div class=" action-nav-button" style="width:300px;">
                          <a href="#" title="Users">
                            <img src="<?php echo base_url();?>template/images/icons/user.png" />
                            <span>Total <?php // echo  count($students); ?> students</span>
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
                                    <th><div>Class</div></th>
                                    <th><div><?php echo translate('student');?></div></th>
                                    <th><div>Roll No</div></th>
                                    <th><div>Invoice ID</div></th>
                                    <th><div><?php echo translate('title');?></div></th>
                                    <th><div><?php echo translate('amount');?></div></th>
                                    <th><div><?php echo translate('Due');?></div></th>
                                    <th><div><?php echo translate('status');?></div></th>
                                    <th><div><?php echo translate('date');?></div></th>
                                    <th><div><?php echo translate('options');?></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1;foreach($invoices as $row):?>
                                <tr>
                                    <td><?php echo $count++;?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['student_id'];?></td>
                            <td><?php echo $row['invoice_id'];?></td>
							<td><?php echo $row['title'];?></td>
                             <?php $total_amount=$row['monthly_fees']+$row['admission_fees']+$row['admission_form']+$row['tc_fees']+$row['scout_fees']+$row['poor_fund']+$row['dev_fees']+$row['sports_fees']+$row['lab_fees']+$row['electricity_charge']+$row['IT_charge']+$row['Fine']+$row['mid_term_exam']+$row['annual_exam']+$row['milad']+$row['others'];?>
							<td><?php echo $total_amount;?></td>
                            <td><?php echo $total_amount-$row['deposit'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'green';else echo 'dark-red';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td align="center">
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $row['invoice_id'];?>)" class="btn btn-default btn-small">
                                		<i class="icon-credit-card"></i> <?php echo translate('view_invoice');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_invoice',<?php echo $row['invoice_id'];?>)" class="btn btn-gray btn-small">
                                		<i class="icon-wrench"></i> <?php echo translate('edit');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>')" class="btn btn-red btn-small">
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
                <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                              
                </div>                
			</div>
			<!----CREATION FORM ENDS--->            
		</div>
	</div>
</div>
<?php endif;?>
<?php if($class_id == ""):?>
<center>
<div class="span5" style="float:none !important;">
    <div class="box box-border">
		<div class="box-header">
			<span class="title"> <i class="icon-info-sign"></i> Please select a class For Monthly Report.</span>
		</div>
		<div class="box-content padded">
            <br />
            <select name="class_id" onchange="window.location='<?php echo base_url();?>index.php?admin/monthlyReport/'+this.value">
                <option value=""><?php echo translate('select_a_class');?></option>
                <?php 
                $classes = $this->db->get('class')->result_array();
                foreach($classes as $row):
                ?>
                    <option value="<?php echo $row['class_id'];?>"
                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                            Class <?php echo $row['name'];?></option>
                <?php
                endforeach;
                ?>
            </select>
            <hr />
            <script>
                $(document).ready(function() {
                    function ask()
                    {
                        Growl.info({title:"Select a class for Monthly report",text:" "});
                    }
                    setTimeout(ask, 500);
                });
            </script>
		</div>
    </div>
</div>
</center>
<?php endif;?>
<script>
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