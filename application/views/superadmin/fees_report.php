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
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<script>
	function select_student()
	{
		var class_id=$("#class_id").val();
		if(!class_id)
		{
			$(".student").show();	
		}
		else
		{
			$("#students").val('');
			$(".student").hide();
			$("."+class_id).show();	
		}
	}
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
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open('admin/fees_report/show'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('class'); ?></label>
                                <div class="controls">
                                    <select name="class_id" onchange="select_student();" id="class_id">
                                        <option value="">All</option>
										<?php
											echo make_select('class','class_id','name',$input['class_id']);
										?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('group'); ?></label>
                                <div class="controls">
                                    <select name="group">
                                        <option value="">All</option>
                                        <?php 
											echo make_select('group','group_id','group_name',$input['group']);
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
                                    <input type="text" name="section" class="input" value="<?=$input['section']?>"/>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('student'); ?></label>
                                <div class="controls">
                                   <select name="student_id"  class="select" id="students"><!--chzn-select-->
                                    <option class="" value="">All</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student <?php echo $row['class_id']; ?>" value="<?php echo $row['student_id']; ?>"  <?php if ($input['student_id'] == $row['student_id']) echo 'selected'; ?>>
                                            <?php if($row['student_unique_ID']) echo $row['student_unique_ID'].'-';echo $row['name'];if($row['class_id']){?>-Class-<?php echo $this->crud_model->get_class_name($row['class_id']);}if($row['roll']){?>-Roll-<?php echo $row['roll'];}?>
                                        </option>
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
                                <div class="controls">
                                    <select name="fees_id" id="fees_id">
									<option class="" value="">All</option>
									<?php
										echo make_select('fees_name','fees_name_id','fee_full_name',$input['fees_id']);
									?>
                                </select> 
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Weaver'); ?></label>
                                <div class="controls">
									<select name="weaver_con" style="width: 60px;" class="input">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                    <input style="width: 220px;" type="text" class="" name="weaver" value="<?php echo $input['weaver']; ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('fine'); ?></label>
								<select name="fine_con" style="width: 60px;">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="" name="fine" value="<?php echo $input['fine']; ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
					<tr>
						<td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('due'); ?></label>
								<select name="due_con" style="width: 60px;" class="input">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="" name="due" value="<?php echo $input['due']; ?>"/>
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
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="date_from" value="<?php echo $input['date_from']; ?>"/>
                                </div>
                            </div>
                        </td>
                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date to'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="date_to"  value="<?php echo $input['date_to']; ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
					<tr>
						<td colspan="2">
							<div class="control-group">
                                <label class="control-label"><?php echo translate('invoice_number'); ?></label>
                                <div class="controls">
                                    <select name="invoice_id">
                                        <option value="">All</option>
                                        <?php 
											echo make_select('invoice','invoice_id','invoice_number',$input['invoice_id']);
                                        ?>
                                    </select>
                                </div>
                            </div>
						</td>
					</tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />


            <?php
				if(count($input)):
			?>
			<?php	
				$payment_from='';
				$payment_to='';
				if($input['date_from'])
				{
					$payment_from=str_replace("/","-",$input['date_from']);
					$payment_from=strtotime($payment_from);
				}
				if($input['date_to'])
				{
					$payment_to=str_replace("/","-",$input['date_to']);
					$payment_to=strtotime($payment_to);
					//$this->db->where(array('invoice.create_date >='=>$payment_from,'invoice.create_date <='=>$payment_to));
				}
				$this->db->select('*')->from('invoice');
				if($input['invoice_id'])
				$this->db->where('invoice.invoice_id', $input['invoice_id']);
				if($input['student_id'])
		        $this->db->where('invoice.student_id', $input['student_id']);
				if($input['class_id'])
		        $this->db->where('student.class_id', $input['class_id']);
				if($input['fees_id'])
		        $this->db->where('invoice_details.fees_id', $input['fees_id']);
				if($input['payment_type'])
		        $this->db->where('invoice.payment_type', $input['payment_type']);
				$this->db->join('student','student.student_id=invoice.student_id');
				$this->db->join('invoice_details','invoice_details.invoice_id=invoice.invoice_id');
		        $query = $this->db->get()->result_array();
				$total_weaver=0;
				$total_fine=0;
				$total_due=0;
                $number_of_row = count($query);
                if ($number_of_row >= 1) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table responsive tablesorter" id="xincomereport">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
							<th><div><?php echo translate('date'); ?></div></th>
							<th><div><?php echo translate('invoice_number'); ?></div></th>
                            <th><div><?php echo translate('Class'); ?></div></th>
                            <th><div><?php echo translate('ID'); ?></div></th>
                            <th><div><?php echo translate('roll'); ?></div></th>
                            <th><div><?php echo translate('name'); ?></div></th>
                            <th><div><?php echo translate('fees_name'); ?></div></th>
							<th><div><?php echo translate('Payment Amount'); ?></div></th>
							<th><div><?php echo translate('weaver'); ?></div></th>
							<th><div><?php echo translate('fine'); ?></div></th>
							<th><div><?php echo translate('due'); ?></div></th>
							<!--<th><div><?php echo translate('Payment status'); ?></div></th>
                            <th><div><?php echo translate('Payment Type'); ?></div></th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            foreach ($query as $row):
							$payment_date=$row['payment_date'];
							$pd=str_replace('/','-',$payment_date);
							$pd=strtotime($pd);	
							if($payment_from and !$payment_to) 
								if($pd<$payment_from) continue;
							if($payment_to and !$payment_from) 
								if($pd>$payment_to) continue;
							if($payment_to and $payment_from) 
							if($pd>$payment_to or $pd<$payment_from) continue;
							$class_name=get_single_value('name','class',array('class_id'=>$row['class_id']));
							$fees_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$row['fees_id']));
							$paid=get_single_value('sum(collection_amount)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id'],'invoice_id <='=>$row['invoice_id']));
							$weaver=get_single_value('sum(weaver)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id'],'invoice_id <='=>$row['invoice_id']));
							$fees_amount=get_single_value('amount','fees',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							$due=$fees_amount-($paid+$weaver);
							if($input['due_con']=='=' and $input['due'])
							{
								if($due!=$input['due'])
								continue;
							}
							if($input['due_con']=='>' and $input['due'])
							{
								if(!($due>$input['due']))
								continue;
							}
							if($input['due_con']=='<' and $input['due'])
							{
								if(!($due<$input['due']))
								continue;
							}
							if($input['weaver_con']=='=' and $input['weaver'])
							{
								if($row['weaver']!=$input['weaver'])
								continue;
							}
							if($input['weaver_con']=='>' and $input['weaver'])
							{
								if(!($row['weaver']>$input['weaver']))
								continue;
							}
							if($input['weaver_con']=='<' and $input['weaver'])
							{
								if(!($row['weaver']<$input['weaver']))
								continue;
							}
							if($input['fine_con']=='=' and $input['fine'])
							{
								if($row['fine']!=$input['fine'])
								continue;
							}
							if($input['fine']=='>' and $input['fine'])
							{
								if(!($row['fine']>$input['fine']))
								continue;
							}
							if($input['fine_con']=='<' and $input['fine'])
							{
								if(!($row['fine']<$input['fine']))
								continue;
							}
							if($row['fine']<=0 and $row['weaver']<=0 and $row['collection_amount']<=0)
							continue;
							$link=site_url('modal/popup/view_invoice/'.$row['invoice_id']);
							 ?>
                            <tr href="<?php echo $link;?>"  window="new" win_height="480" win_width="800" title="<?=$link?>">
                                <td><?php echo $count; ?></td>
								<td><?php echo $payment_date; ?></td>
								<td><?php echo $row['invoice_number']; ?></td>
                                <td><?php echo $class_name; ?></td>
                                <td><?php echo $row['student_unique_ID']; ?></td>
                                <td><?php echo $row['roll']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $fees_name; ?></td>
								<td><?php echo $row['collection_amount']; ?></td>
								<td><?php echo $row['weaver']; ?></td>
								<td><?php echo $row['fine']; ?></td>
								<td><?php echo $due; ?></td>
								<!--<td><?php echo strtoupper($row['payment_status']); ?></td>
                                <td><?php echo $row['payment_type']; ?></td>-->
                                    <?php 
                                        $grand_total+=$row['collection_amount'];
										$total_weaver+=$row['weaver'];
										$total_fine+=$row['fine'];
                                    ?>
                            </tr>
                        <?php $count++; endforeach; ?>
						</tbody>
						<tfoot>
						<tr>
							<td colspan="8" align="right">Total</td>
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

            <?php }endif;  ?>
        </div>
    </div>
</div>
<?php  die; ?>