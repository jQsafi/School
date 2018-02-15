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
                    <?php echo translate('balance_sheet'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open('admin/balance_sheet/show'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
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
                            <button type="submit" class="btn btn-normal btn-gray btn-small">
								<?php echo translate('check_statement'); ?>
							</button>
                        </td>
                    </tr>
                </table>
                <?=form_close()?>
            </center>


            <br /><br />


            <?php
			if($date_from && $date_to):
				$date_from=str_replace('/','-',$date_from);
				$date_from=date('Y-m-d',strtotime($date_from));
				$date_to=str_replace('/','-',$date_to);
				$date_to=date('Y-m-d',strtotime($date_to));
				$prev_date=date("Y-m-d",strtotime("-1 day",strtotime($date_from)));
				$prev_income=get_single_value('sum(amount)','income',array('income_date <='=>$prev_date));
				$prev_expense=get_single_value('sum(amount)','expense',array('expense_date <='=>$prev_date));
				$opening_balance=$prev_income-$prev_expense;
			?>
				<table class="table table-bordered" id="statement">
					<thead>
						<tr>
							<th colspan="3"><?=translate('opening_balance')?></th>
							<th><?=translate('date_from')?></th>
							<th><?=translate('date_to')?></th>
						</tr>
						<tr>
							<th colspan="3"><?=$opening_balance?></th>
							<th><?=date("d/m/Y",strtotime($date_from))?></th>
							<th><?=date("d/m/Y",strtotime($date_to))?></th>
						</tr>
						<tr>
							<th><?=translate('date')?></th>
							<th><?=translate('description')?></th>
							<th><?=translate('income')?></th>
							<th><?=translate('expense')?></th>
							<th><?=translate('balance')?></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$date=$date_from;
					$balance=$opening_balance;
					$total_income=0;
					$total_expense=0;
					while($date<=$date_to)
					{
						$condition_income=array('income_date'=>$date);
						$condition_expense=array('expense_date'=>$date);
						$result=$this->db->where($condition_income)->select('income_name,amount')->get('income');
						foreach($result->result() as $row)
						{
							$income_name=$row->income_name;
							$amount=$row->amount;
							$balance+=$amount;
							$total_income+=$amount;
							?>
							<tr>
								<td><?=date("d/m/Y",strtotime($date))?></td>
								<td><?=$income_name?></td>
								<td><?=$amount?></td>
								<td>&nbsp;</td>
								<td><?=$balance?></td>
							</tr>
							<?php
						}
						$result=$this->db->where($condition_expense)->select('expense_name,amount')->get('expense');
						foreach($result->result() as $row)
						{
							$expense_name=$row->expense_name;
							$amount=$row->amount;
							$balance-=$amount;
							$total_expense+=$amount;
							?>
							<tr>
								<td><?=date("d/m/Y",strtotime($date))?></td>
								<td><?=$expense_name?></td>
								<td>&nbsp;</td>
								<td><?=$amount?></td>
								<td><?=$balance?></td>
							</tr>
							<?php
						}
						$date=strtotime("+1 day",strtotime($date));
						$date = date('Y-m-d',$date);
					}
					
					?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2"><?=translate('total')?></th>
							<td><?=$total_income?></td>
							<td><?=$total_expense?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<th colspan="4"><?=translate('closing_balance')?></th>
							<td><?=$balance?></td>
						</tr>
					</tfoot>
                </table>
                <br />            
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#statement').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download_excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#statement').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download_word'); ?>
                    </a>
                </div>

            <?php endif;  ?>
        </div>
    </div>
</div>