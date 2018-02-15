<style>
	table>tbody>tr>td.text-right
	{
		text-align: right !important;
	}
	table>tfoot>tr>td,th.text-right
	{
		text-align: right !important;
	}
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
<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('check_statement'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open('admin/check_statement/show'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('select_account'); ?></label>
                                <div class="controls">
                                    <select name="bank_account_id"  id="bank_account_id" required="">
                                        <option value="">All</option>
										<?php
											echo make_select('bank_account','bank_account_id','account_number',$bank_account_id);
										?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date from'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="date_from" value="<?php echo $date_from; ?>" required=""/>
                                </div>
                            </div>
                        </td>
                        <td>    
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('date to'); ?></label>
                                <div class="controls">
                                    <input style="width: 220px;" type="text" class="datepicker fill-up" name="date_to"  value="<?php echo $date_to; ?>" required=""/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center">
                            <button type="submit" class="btn btn-normal btn-gray btn-large">
								<?php echo translate('check_statement'); ?>
							</button>
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />


            <?php
				if($bank_account_id):
				$condition=array('bank_account_id'=>$bank_account_id);
				$account_number=get_single_value('account_number','bank_account',$condition);
				$account_holder=get_single_value('account_holder','bank_account',$condition);
				$bank_address=get_single_value('bank_address','bank_account',$condition);
				$initial_balance=get_single_value('initial_balance','bank_account',$condition);
				$total_deposit=0;
				$total_widthdraw=0;
			?>
				<table class="table table-bordered" id="statement">
					<thead>
						<tr>
							<th colspan="2"><?=$account_holder?></th>
							<th colspan="2"><?=translate('statement_period')?></th>
							<th colspan="2"><?=translate('account_no.')?></th>
						</tr>
						<tr>
							<th colspan="2"><?=$bank_address?></th>
							<th colspan="2"><?=$date_from."-".$date_to?></th>
							<th colspan="2"><?=$account_number?></th>
						</tr>
						<tr>
							<th><?=translate('date')?></th>
							<th><?=translate('description')?></th>
							<th><?=translate('reference')?></th>
							<th><?=translate('withdrawals')?></th>
							<th><?=translate('deposit')?></th>
							<th><?=translate('balance')?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$date_from=str_replace('/','-',$date_from);
					$date_from=date('Y-m-d',strtotime($date_from));
					$date_to=str_replace('/','-',$date_to);
					$date_to=date('Y-m-d',strtotime($date_to));
					$prev_date=date("Y-m-d",strtotime("-1 day",strtotime($date_from)));
						$prev_balance_condition=array(
						'bank_account_id'=>$bank_account_id,
						'date <='=>$prev_date
						);
					$prev_deposit=get_single_value('sum(amount)','bank_deposit',$prev_balance_condition);
					$prev_withdraw=get_single_value('sum(amount)','bank_expense',$prev_balance_condition);
					$prev_balance=$initial_balance+$prev_deposit-$prev_withdraw;
					$balance=$prev_balance;
					?>
					<tr>
						<td><?=date("d-m-Y",strtotime($prev_date))?></td>
						<td><?=translate('previous_balance')?></td>
						<td colspan="4" class="text-right"><?=$balance?></td>
					</tr>
					<?php
					$check_date=$date_from;				
					while($check_date<=$date_to)
					{
						$condition_statement=array(
						'bank_account_id'=>$bank_account_id,
						'date'=>$check_date
						);
						$deposits=$this->db->where($condition_statement)->from('bank_deposit')->get();
						if($deposits->num_rows()>0)
						{
							foreach($deposits->result() as $deposit)
							{
								$deposit_amount=$deposit->amount;
								$balance+=$deposit_amount;
								$total_deposit+=$deposit_amount;
								?>
								<tr>
									<td><?=date("d-m-Y",strtotime($deposit->date))?></td>
									<td><?=$deposit->method?></td>
									<td><?=$deposit->reference?></td>
									<td>&nbsp;</td>
									<td class="text-right"><?=$deposit_amount?></td>
									<td class="text-right"><?=$balance?></td>
								</tr>
								<?php
							}
						}
						$expenses=$this->db->where($condition_statement)->from('bank_expense')->get();
						if($expenses->num_rows()>0)
						{
							foreach($expenses->result() as $expense)
							{
								$expense_amount=$expense->amount;
								$balance-=$expense_amount;
								$total_widthdraw+=$expense_amount;
								?>
								<tr>
									<td><?=date("d-m-Y",strtotime($expense->date))?></td>
									<td><?=$expense->method?></td>
									<td><?=$expense->reference?></td>
									<td class="text-right"><?=$expense_amount?></td>
									<td>&nbsp;</td>
									<td class="text-right"><?=$balance?></td>
								</tr>
								<?php
							}
						}
						$check_date=strtotime("+1 day",strtotime($check_date));
						$check_date = date('Y-m-d',$check_date);
					}
					?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3" class="text-right"><?=translate('total')?></th>
							<td class="text-right"><?=$total_widthdraw?></td>
							<td class="text-right"><?=$total_deposit?></td>
							<td class="text-right"><?=$balance?></td>
						</tr>
					</tfoot>
                </table>
                <br />            
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#statement').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#statement').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>

            <?php endif;  ?>
        </div>
    </div>
</div>
<?php  die; ?>