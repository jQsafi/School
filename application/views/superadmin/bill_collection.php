<?php
if(isset($type) and $type=='print')
{
	?>
		<a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $invoice_id; ?>)" class="btn btn-default btn-small" id="link" style="display: none;">Print Invoice</a>
		<script>
			$(function()
			{
				$("#link").click();
			});
		</script>
	<?php
}
$invoice = $this->db->get('invoice')->result_array();
$row_number = count($invoice);

if($row_number > 0){
    foreach ($invoice as $value) 
	{
     	$last_id = $value['invoice_id'];   
    }
    $inv_id = 'INV-'.($last_id+1);
}else {
   $inv_id = "INV-1"; 
}                                    
?>
<script>
	function select_student()
	{
		var class_id=$("#class_id").val();
		$.ajax({
		  url: "<?php echo site_url('admin/studentlist/'); ?>/"+class_id,
		  success:function(msg)
		  {
		  	$("#students").html(msg);
		  }
		});
		/*if(!class_id)
		{
			$(".student").show();	
		}
		else
		{
			$("#students").val('');
			$(".student").hide();
			$("."+class_id).show();	
		}*/
	}
</script>
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Fees Payment');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/bill_collection/create');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
						<td><?php echo translate('class'); ?></td>
						<td>
                            <select name="class_id" onchange="select_student();" id="class_id">
                                <option value="">All</option>
								<?php
									echo make_select('class','class_id','name',$class_id);
								?>
                            </select>
                        </td>
                        <td>Select Student</td>
                        <td>
                        	<select name="student_id"  class="select" id="students"><!--chzn-select-->
                                    <option class="" value="">All</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student <?php echo $row['class_id']; ?>" value="<?php echo $row['student_id']; ?>"  <?php if ($student_id == $row['student_id']) echo 'selected'; ?>>
                                            <?php if($row['student_unique_ID']) echo $row['student_unique_ID'].'-';echo $row['name'];if($row['class_id']){?>-Class-<?php echo $this->crud_model->get_class_name($row['class_id']);}if($row['roll']){?>-Roll-<?php echo $row['roll'];}?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                        </td>
                        <td>
                    		<input type="submit" value="Submit" class="btn btn-normal btn-gray" />
                        </td>
                	</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($student_id >0  ):?>
                <?php 
                    $class_id=get_single_value('class_id','student',array('student_id'=>$student_id));
                    $this->db->where('student_id',$student_id);
                    $query_result = $this->db->from('fees')->get();
					echo form_open('admin/bill_collection/collect');
					$student_info = $this->crud_model->get_student_info($student_id);
					
		?>
                <input  type="hidden" name="student_id" value="<?php echo $student_id;?>"/>
                <table class="table" >
					<tbody>
						<tr>
							<td>
							<?php foreach ($student_info as $row):?>
					            <table class="table" style="width:100%">
					            	<tr>
					                    <td>
											<div class="avatar">
					                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-big"/>
					               		</div>
					                     <h3><?php echo $row['name']; ?></h3>
					                     <h5>Student Id Number: <?php echo $row['student_unique_ID']; ?></h5>
					                     <h5>Class: <?php echo $this->crud_model->get_class_name($row['class_id']); ?></h5>
					                     <h5>Roll: <?php echo $row['roll']; ?></h5>
										 <?php
										 if($row['section'])
										 {
										 ?>
					                     <h5>Section: <?php echo $row['section']; ?></h5>
										 <?php
										 }
										 $group_name=get_single_value('group_name','group',array('group_id'=>$row['group']));
										 if($row['group'])
										 { ?>
					                     <h5>Group: <?php echo  $group_name; ?></h5>
										 <?php }?>
					                    </td>
											<?php
												$this->db->from('invoice')->where('student_id',$row['student_id']);
												$result=$this->db->get();
												if($result->num_rows()>0):
												?>
												<td valign="top">
												<table class="table table-normal dTable">
												<thead>
													<th>
														Invoice Number
													</th>
													<th>
														Payment For
													</th>
													<th>
														Total Pay
													</th>
													<th>
														Weaver
													</th>
													<th>
														Fine
													</th>
													<th>
														Status
													</th>
													<th>
														Payment Date
													</th>
													<th>
														&nbsp;
													</th>
												</thead>
												<tbody>
												<?php
												foreach($result->result() as $inv)
												{
													?>
														<tr><td><?=$inv->invoice_number?></td>
														<td><?=$inv->payment_month?></td>
														<td><?=$inv->total_collection?></td>
														<td><?=$inv->total_weaver?></td>
														<td><?=$inv->total_fine?></td>
														<td><?=$inv->payment_status?></td>
														<td><?=$inv->payment_date?></td>
														<td>
															<a data-toggle="modal" href="#modal-form" onclick="modal('view_invoice',<?php echo $inv->invoice_id; ?>)" class="btn btn-default btn-small">View Invoice</a>
														</td>
														</tr>
													<?php
												}
												$total_collection=get_single_value('sum(total_collection)','invoice',array('student_id'=>$row['student_id']));
												$total_weaver=get_single_value('sum(total_weaver)','invoice',array('student_id'=>$row['student_id']));
												$total_fine=get_single_value('sum(total_fine)','invoice',array('student_id'=>$row['student_id']));
											?>
											</tbody>
											<tfoot>
											<tr>
												<th>Total</th>
												<th>&nbsp;</th>
												<th><?=$total_collection?></th>
												<th><?=$total_weaver?></th>
												<th><?=$total_fine?></th>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
												<th>&nbsp;</th>
											</tr>
											</tfoot>
											</table>
										</td>
					                 </tr>
					             </table>
								 </td>
								<?php 
								endif;
								endforeach; ?>
						</tr>
					</tbody>
					</table>
					<table class="table table-normal box">
					<tbody>
						<tr>
							<td>
								Payment Month
							</td>
							<td>								
									<?php for ($m=1; $m<=12; $m++)
									{
										$month = date('F', mktime(0,0,0,$m))
										?>
									<span class="payment_month_section"><input type="checkbox" name="payment_month[]" value="<?=$month?>" class="input" required=""/></span>
									<?php
									echo $month."</span>";
									if($m==6)
									echo "<br>";
     								}
									?>
							</td>
							<td>
								Payment Year
							</td>
							<td>
								<input  type="text" name="payment_year" value="<?php echo date('Y');?>" number id="year"  required="">
							</td>
						</tr>
                        <tr>
							<td>
								Payment Date
							</td>
							<td>
								<input type="text" class="datepicker fill-up" name="payment_date" id="payment_date" required=""/>
							</td>
							<td>
								Description
							</td>
							<td colspan="3">
								<input type="text" name="description" id="description">
							</td>
                        </tr>
						<tr>
							<td>Invoice Number</td>
							<td><input type="text" name="invoice_number" id="invoice_name" value="<?php echo $inv_id;?>" readonly=""/></td>
                            <td>Invoice Name</td>
							<td>
								<input type="text"  name="invoice_name" id="invoice_name" class="input"/>
							</td>
                        </tr>
                     </tbody>
				</table>
				<br>
				<table class="table table-normal box tablesorter" >
					 <thead>
                        <tr>
							<th>#</th>
                            <th>Fees Name</th>
							<th>Fees Amount</th>
                            <th>Due</th>
                            <th>Paid Amount</th>
							<th>Weaver</th>
							<th>Fine</th>
                            </tr>
                    </thead>
					<tbody>
                        <?php 
						$total_fee=0;
						$total_due=0;
						$fsl=0;
						foreach ($query_result->result() as $item ):
							$student_id=$item->student_id;
							$fees_name_id=$item->fees_id;
							$fees_amount=$item->amount;
							
							$fee_full_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fees_name_id));
							$fee_name=get_single_value('fee_name','fees_name',array('fees_name_id'=>$fees_name_id));
							$paid=get_single_value('sum(collection_amount)','invoice_details',array('student_id'=>$student_id,'fees_id'=>$fees_name_id));
							$weaver=get_single_value('sum(weaver)','invoice_details',array('student_id'=>$student_id,'fees_id'=>$fees_name_id));
							$due=$fees_amount-($paid+$weaver);
							$total_fee+=$fees_amount;
							$total_due+=$due;
							if($fee_name):
							if($fees_amount):
							$fsl++;
						?>
						
                        <tr>
							<td><?=$fsl?></td>
                            <td>
								<?php echo $fee_full_name;?>
							</td>
							<td>
								<?php echo $fees_amount;?>
							</td>
							<td>
								<?php echo $due;?>
							</td>
							<td>
							<?php
								if($due>0)
								{
									?>
									<input type='text' name='collection_amount_<?=$fees_name_id?>' class='collection' max_value='".$due."' number value='0' id="collection_<?=$fees_name_id?>" onkeyup="check_due(this,'<?=$fees_name_id?>','<?=$due?>');">
									<?php
								}
								if($due<0)
								{
									echo "Over Due-".abs($due);
								}
								if(!$due)
								{
									echo 'Paid';
								}
							?>
							</td>
							<td>
							<?php
							if($due>0)
							{
								?>
								<input type='text' name='weaver_<?=$fees_name_id?>' class='weaver'  number id="weaver_<?=$fees_name_id?>" onkeyup="check_due(this,'<?=$fees_name_id?>','<?=$due?>');">
								<?php
							}
							?>
							</td>
							<td>
								<input type='text' name='fine_<?=$fees_name_id?>' class='fine'  number>
							</td>
                        </tr>
                        <?php
						endif; 
						endif;
						endforeach;?>
					</tbody>
					<tfoot>
						<tr>
							<td>&nbsp;</td>
							<td>
								Total
							</td>
							<td>
								<?php echo $total_fee;?>
							</td>
							<td>
								<span id="total_due"><?php echo $total_due;?></span>
							</td>
							<td>
								<span id="total_paid">0</span>
							</td>
							<td>
								<span id="t_weaver">0</span>
								<input type="hidden" name="total_weaver" id="total_weaver" value="0"/>
							</td>
							<td>
								<span id="t_fine">0</span>
								<input type="hidden" name="total_fine" id="total_fine" value="0"/>
							</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
							<td colspan="2" align="right">
								Total Colection(Paid+Fine)
							</td>
							<td colspan="3">
								<span id="pay_fine">0</span>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								Payment Status
							</td>
							<td>
								<select name="payment_status" id="payment_status">
									<option value="paid">Paid</option>
									<option value="partial">Partial</option>
									<option value="unpaid">Un-paid</option>
								</select>
							</td>
							<td>
								Payment Type
							</td>
							<td>
								<select name="payment_type" id="payment_type">
									<option value="Cash">Cash</option>
									<option value="Check">Check</option>
									<option value="Bank Payment">Bank Payment</option>
									<option value="Bkash">Bkash</option>
									<option value="Mcash">Mcash</option>
									<option value="Bank">Bank</option>
								</select>
							</td>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="7" align="center">
							<div class="middle-point-page">
							<b>Total Collection:</b><input type="text" readonly  id="total_collection" name="total_collection" value="0">
							</div>
								<center><button type="submit" class="btn btn-normal btn-gray">Submit</button></center>
							</td>
						</tr>
					</tfoot>
                  </table>
                     </form>                       
</div>
            <?php  endif;?>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>
<style>
	.middle-point-page
	{
		border: 0;
		height:50px;
		width:100px;
		position:fixed;
		top: 50%;
		left: 100%;
		margin-left: -105px;
		margin-top: -25px;
	}
	.middle-point-page>input
	{
		width: 100px;
		background-color: red;
		color: #FFFFFF;
		border: none;
		font-weight: bold;
	}
</style>
 <script>
 	function check_due(elem,seq,due)
	{
		var collection=$("#collection_"+seq).val();
		var weaver=$("#weaver_"+seq).val();
		var collected=Number(collection)+Number(weaver);
		due=Number(due);
		if(collected>due)
		{
			Growl.info({title:"Alert",text:"Collection+Weaver can not cross amount "+due});
			var curr_val=$(elem).val();
			curr_val=curr_val.substr(0,curr_val.length-1);
			$(elem).val(curr_val);
		}
	}
	$(function()
	{
		total_collection=0;
	 	$(".collection").keyup(function()
		{
			total_collection=0;
			$.each($('.collection'), function() 
			{
		        collection = $(this).val();
				collection=Number(collection);
				if(collection)
				{
					total_collection+=collection;
				}
	    	});
			$("#total_collection").val(total_collection);
			$("#total_paid").html(total_collection);
			var tf=Number($("#total_fine").val());
			var tc=Number($("#total_collection").val());
			$("#pay_fine").html(tc+tf);
		});
		$(".weaver").keyup(function()
		{
			total_weaver=0;
			$.each($('.weaver'), function() 
			{
		        weaver = $(this).val();
				weaver=Number(weaver);
				if(weaver)
				{
					total_weaver+=weaver;
				}
	    	});
			$("#total_weaver").val(total_weaver);
			$("#t_weaver").html(total_weaver);
		});
		$(".fine").keyup(function()
		{
			total=0;
			$.each($('.fine'), function() 
			{
		        fine = $(this).val();
				fine=Number(fine);
				if(fine)
				{
					total+=fine;
				}
	    	});
			$("#total_fine").val(total);
			$("#t_fine").html(total);
			var tf=Number($("#total_fine").val());
			var tc=Number($("#total_collection").val());
			$("#pay_fine").html(tc+tf);
		});
	});
	$(function(){
    var chbxs = $(':checkbox[required]');
    var namedChbxs = {};
    chbxs.each(function(){
        var name = $(this).attr('name');
        namedChbxs[name] = (namedChbxs[name] || $()).add(this);
    });
    chbxs.change(function(){
        var name = $(this).attr('name');
        var cbx = namedChbxs[name];
        if(cbx.filter(':checked').length>0){
            cbx.removeAttr('required');
        }else{
            cbx.attr('required','required');
        }
    });
});
 </script>