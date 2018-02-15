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
    #list .controls, #list .controls select, #list .controls input select
	{
		padding:0px !important;
        display: inline-block;
		height: 30px !important;
		background-color: rgb(239, 239, 239) !important;
    }
	.select2-input,
	.select2-container,
	.select2-choice
	{
		background-color: rgb(239, 239, 239) !important;
		border: 1px solid #d5d5d5 !important;
		border-style: solid !important;
		border-width: 1px !important;
	}
</style>
<script>
	function select_student(student_class)
	{
		$.ajax({
		  url: "<?php echo site_url('admin/studentlist/'); ?>/"+student_class,
		  success:function(msg)
		  {
		  	$("#students").html(msg).val('').trigger('liszt:updated');
		  }
		});
	}
	$(function()
	{
		$("#class_id").trigger('change');
	});
</script>
<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('Fees Report'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
                <?php echo form_open(site_url('admin/fees_report/show_report'),array('class'=>'form-control'),array('posted'=>TRUE)); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('class'); ?></label>
                                    <select name="class_id" onchange="select_student(this.value);" class="chzn-select" id="class_id">
									<option value="">Select Class</option>
										<?php
											echo make_select('class','class_id','name',$class_id);
										?>
                                    </select>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('group'); ?></label>
                                <div class="controls">
                                    <select name="group">
                                        <option value="">All</option>
                                        <?php 
											echo make_select('group','group_id','group_name',$group);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('section'); ?></label>
                                <div class="controls">
									<select name="section" class="uniform" style="width:100%;">
											<option value=""><?=translate('section')?></option>
											<?=make_select('class_section','section_name','section_name',$section)?>
									</select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('student'); ?></label>
                                
                                   <select name="student_id"  class="chzn-select" id="students"><!--chzn-select-->
                                    <option class="" value="">All</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option value="<?php echo $row['student_id']; ?>"  <?php if ($student_id == $row['student_id']) echo 'selected'; ?>>
                                            <?php if($row['student_unique_ID']) echo $row['student_unique_ID'].'-';echo $row['name'];if($row['class_id']){?>-Class-<?php echo $this->crud_model->get_class_name($row['class_id']);}if($row['roll']){?>-Roll-<?php echo $row['roll'];}?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('status'); ?></label>
                                <div class="controls">
                                    <select name="payment_status" id="payment_status">
									<option class="" value="">All</option>
									<option value="paid">Paid</option>
									<option value="partial">Partial</option>
									<option value="unpaid">Un-paid</option>
								</select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Fees Name'); ?></label>
                                    <select name="fees_id" id="fees_id" class="chzn-select">
									<option class="" value="">All</option>
									<?php
										echo make_select('fees_name','fees_name_id','fee_full_name',$fees_id);
									?>
                                </select> 
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Weaver'); ?></label>
                                <div class="controls">
									<select name="weaver_con" style="width: 60px;">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
									
                                    <input style="width: 220px;" type="text" class="" name="weaver" value="<?php echo $weaver; ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('fine'); ?></label>
								<div class="controls">
								<select name="fine_con" style="width: 60px;">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                    <input style="width: 220px;" type="text" class="" name="fine" value="<?php echo $fine; ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
					<tr>
						<td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('due'); ?></label>
								<div class="controls">
								<select name="due_con" style="width: 60px;">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="" name="due" value="<?php echo $due; ?>"/>
                                </div>
                            </div>
                        </td>
						<td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Payment Type'); ?></label>
                                <div class="controls">
                                    <select name="payment_type" id="payment_type">
									<option value="">All</option>
									<option value="Cash">Cash</option>
									<option value="Check">Check</option>
									<option value="Bank Payment">Bank Payment</option>
									<option value="Bkash">Bkash</option>
									<option value="Mcash">Mcash</option>
									<option value="Bank">Bank</option>
								</select>
                                </div>
                            </div>
                        </td>
					</tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date from'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="date" class="datepicker fill-up" name="date_from" value="<?php if($date_from) echo date("d/m/Y",strtotime($date_from)); ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date to'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="date_to" value="<?php if($date_to) echo date("d/m/Y",strtotime($date_to)); ?>">
									<input  type="hidden" class="" name="posted"  value="true"/>
                                </div>
                            </div>
                        </td>
                    </tr>
					<tr>
						<td colspan="2">
							<div class="control-group">
                                <label class="control-label"><?php echo translate('invoice_number'); ?></label>
                                    <select name="invoice_id" class="chzn-select">
                                        <option value="">All</option>
                                        <?php 
											echo make_select('invoice','invoice_id','invoice_number',$invoice_id);
                                        ?>
                                    </select>
                            </div>
						</td>
					</tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
				<?=form_close()?>
            </div>
    

            <br /><br />


            <?php
				if($posted)
				{
				$this->db->select('invoice.invoice_id,invoice.invoice_number,invoice.payment_date,invoice.invoice_number,total_collection,total_fine,fees_id,collection_amount,weaver,fine,invoice.student_id,student_unique_ID,name,class_id,roll');
				if($date_from)
				{
					$this->db->where("invoice.payment_date >=",$date_from);
				}
				if($date_to)
				{
					$this->db->where("invoice.payment_date <=",$date_to);
				}
				if($invoice_id)
				$this->db->where('invoice.invoice_id', $invoice_id);
				if($student_id)
		        $this->db->where('invoice.student_id', $student_id);
				if($class_id)
		        $this->db->where('student.class_id',$class_id);
				if($fees_id)
		        $this->db->where('invoice_details.fees_id', $fees_id);
				if($payment_type)
		        $this->db->where('invoice.payment_type', $payment_type);
				if($weaver)
				{
					$where='`weaver` '.$weaver_con.$weaver;
					$this->db->where($where);
				}
				if($fine)
				{
					$where='`fine` '.$fine_con.$fine;
					$this->db->where($where);
				}
				$this->db->where('(collection_amount+fine+weaver) >',0);
//				$this->db->where('invoice.payment_date >','1999-12-31');
				$this->db->from('invoice');
				$this->db->join('invoice_details','invoice.invoice_id=invoice_details.invoice_id',"left");
				$this->db->join('student','invoice.student_id=student.student_id','inner');
				$this->db->order_by('invoice.invoice_id','desc');
		        $result = $this->db->get();
				$total_weaver=0;
				$total_fine=0;
				$total_due=0;
                $number_of_row = $result->num_rows();
                if ($number_of_row) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table responsive tablesorter" id="xincomereport">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
							<th><div><?php echo translate('date'); ?></div></th>
							<th><div><?php echo translate('invoice_number'); ?></div></th>
                            <th><div><?php echo translate('class'); ?></div></th>
                            <th><div><?php echo translate('id','upper_case'); ?></div></th>
                            <th><div><?php echo translate('roll'); ?></div></th>
                            <th><div><?php echo translate('name'); ?></div></th>
                            <th><div><?php echo translate('fees_name'); ?></div></th>
							<th><div><?php echo translate('paid'); ?></div></th>
							<th><div><?php echo translate('weaver'); ?></div></th>
							<th><div><?php echo translate('fine'); ?></div></th>
							<th><div><?php echo translate('due'); ?></div></th>
							<!--<th><div><?php echo translate('Payment status'); ?></div></th>
                            <th><div><?php echo translate('Payment Type'); ?></div></th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 0;
							$result=$result->result_array();
                           foreach($result as $row)
							{
							$payment_date=$row['payment_date'];
							$payment_date=date('d-M-Y',strtotime($payment_date));	
							$class_name=get_single_value('name','class',array('class_id'=>$row['class_id']));
							$fees_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$row['fees_id']));
							$paid=get_single_value('sum(collection_amount)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id'],'invoice_id <='=>$row['invoice_id']));
							$current_weaver=get_single_value('sum(weaver)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id'],'invoice_id <='=>$row['invoice_id']));
							$fees_amount=get_single_value('amount','fees',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							$current_due=$fees_amount-($paid+$current_weaver);
							if($due_con=='=' and $due)
							{
								if($current_due!=$due)
								continue;
							}
							if($due_con=='>' and $due)
							{
								if(!($current_due>$due))
								continue;
							}
							if($due_con=='<' and $due)
							{
								if(!($current_due<$due))
								continue;
							}
							$count++;
							$link=site_url('modal/popup/view_invoice/'.$row['invoice_id']);
							 ?>
                            <tr href="<?php echo $link;?>"  window="new" win_height="480" win_width="800" title="<?=$link?>">
                                <td><?php echo $count; ?></td>
								<td><?=$payment_date?></td>
								<td><?php echo $row['invoice_number']; ?></td>
                                <td><?php echo $class_name; ?></td>
                                <td><?php echo $row['student_unique_ID']; ?></td>
                                <td><?php echo $row['roll']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $fees_name; ?></td>
								<td><?php echo $row['collection_amount']; ?></td>
								<td><?php echo $row['weaver']; ?></td>
								<td><?php echo $row['fine']; ?></td>
								<td><?php echo $current_due; ?></td>
								<!--<td><?php echo strtoupper($row['payment_status']); ?></td>
                                <td><?php echo $row['payment_type']; ?></td>-->
                                    <?php 
                                        $grand_total+=$row['collection_amount'];
										$total_weaver+=$row['weaver'];
										$total_fine+=$row['fine'];
                                    ?>
                            </tr>
                        <?php
						} 
						?>
						</tbody>
						<tfoot>
						<tr>
							<th colspan="8" align="right" class="text-right"><?=translate('total')?></th>
							<td><?=$grand_total?></td>
							<td><?=$total_weaver?></td>
							<td><?=$total_fine?></td>
							<td colspan="4">&nbsp;</td>
                        </tr>
						</tfoot>
                </table>
                <br />            
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomereport').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomereport').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>
<?php 
}}
?>
</div>
</div>