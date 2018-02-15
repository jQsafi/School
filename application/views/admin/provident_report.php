<style>
    table.dTable {
        border: 1px solid #d5d5d5;
    }
    table.dTable thead th, table.dataTable thead th div {
        height: 25px !important;
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
        <div class="tab-pane  active" id="list">
            <center>
                <?php echo form_open('admin/provident_report/get_report'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Month'); ?></label>
                                <div class="controls">
                                    <select name="month" class="expenseBy">
											<option value="">Please select</option>
											<option value="01">January</option>  											
											<option value="02">February</option>      
											<option value="03">March</option>      
											<option value="04">April</option>      
											<option value="05">May</option>      
											<option value="06">June</option>      
											<option value="07">July</option>      
											<option value="08">August</option>      
											<option value="09">September</option>      
											<option value="10">October</option>      
											<option value="11">November</option>      
											<option value="12">December</option>
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
									  print '<option value="'.$starting_year.'">'.$starting_year.'</option>';
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
                                    <input type="text" name="EmployeeID" />
                                </div>
                            </div> 
                        </td>
                        <td>
						<div class="control-group">
                                <label class="control-label"><?php echo translate('Employee_name'); ?></label>
                                <div class="controls">
                                    <select name="tname" class="form-control">
										<option value=""><?=translate('all')?>
										<?=make_select('teacher','name','name')?>
									</select>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('designation'); ?></label>
                                <div class="controls">
                                    <select name="designation" class="expenseName">
                                        <option value="">Please select</option>
                                        <?php	$d_designation = $this->db->get_where('designation')->result_array(); 
										foreach($d_designation as $row2):
										?>
                                    	<option value="<?php echo $row2['name'];?>"><?php echo $row2['name'];?></option>
										<?php
										endforeach;
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
                        <td colspan="2" align="center">
                            <input type="hidden" name="operation" value="selection" />
                            <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
                </form>
            </center>


            <br /><br />


            <?php                
                if ($status=='get_report') 
				{
					if($tname)
					$this->db->like('tname',$tname,'both');
					if($employeeID)
					$this->db->like('employeeID',$employeeID,'both');
					if($designation)
					$this->db->where('designation',$designation);
					if($month)
					$this->db->where('month',$month);
					if($year)
					$this->db->where('year',$year);
					$this->db->select('employeeID,tname,designation,id,csalary.teacher_id')
					->group_by('csalary.teacher_id');
					$result=$this->db->get('csalary');
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table tablesorter table-normal" id="xsaralyreport" style="overflow-x: auto;">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('#'); ?></div></th>
                            <th><div><?php echo translate('Employee ID'); ?></div></th>
                            <th><div><?php echo translate('Name'); ?></div></th>
							<th><div><?php echo translate('Designation'); ?></div></th>
                            <th><div><?php echo translate('pf'); ?></div></th>
                            <th><div><?php echo translate('total'); ?></div></th>
                            <th><div><?php echo translate('payment'); ?></div></th>
                            <th><div><?php echo translate('balance'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $serial_no = 1;
                        foreach ($result->result() as $row):
						$paid_amount=get_single_value('sum(paid_amount)','provident_payment',array('teacher_id'=>$row->teacher_id));
						$payment_date_con='';
						if($year and $month)
						{
							$payment_date_con=$year."-".$month;
						}
						else if($year and !$month)
						{
							$payment_date_con=$year;
						}
						else if(!$year and $month)
						{
							$payment_date_con=date('Y')."-".$month;
						}
						$this->db->like('payment_date',$payment_date_con)
						->where('teacher_id',$row->teacher_id);
						$payments=$this->db->get('provident_payment');
						$id=$row->id;
						if($month)
						$this->db->where('month',$month);
						if($year)
						$this->db->where('year',$year);
						$all_pf=$this->db->where('employeeID',$row->employeeID)->from('csalary')->get();
						?>
                            <tr>
                                <td><?php echo $serial_no; ?></td>
								<td><?=$row->employeeID?></td>
								<td><?=$row->tname?></td>
								<td><?=$row->designation?></td>
								<td>
									<?php
									$total_amount=0;
									foreach($all_pf->result() as $pf)
									{
										$pf_amount=$pf->pf;
										$total_amount+=$pf_amount;
										echo date('F',strtotime('0-'.$pf->month.'-0')).','.$pf->year.'&nbsp;='.$pf_amount."<br>";
									}
									?>
								</td>
								<td><?=$total_amount?></td>
								<td><?php
								$total_paid_amount=0;
								foreach($payments->result() as $pay)
								{
									$amount=$pay->paid_amount;
									$date=$pay->payment_date;
									$total_paid_amount+=$amount;
									echo "<b>".translate('date')."</b>: ".date("d/m/Y",strtotime($date))." <b>".translate('amount')."</b>: ".$amount."<br>";
								}
								echo "<b>".translate('total_payment')."</b>: ".$total_paid_amount;
								$current_balance=$total_amount-$total_paid_amount;
								?></td>
								<td><?=$current_balance?></td>
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