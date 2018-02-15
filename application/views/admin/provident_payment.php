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
                <?php echo form_open('admin/provident_payment/get_record'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">     
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
                if ($status=='get_record') 
				{
					if($tname)
					$this->db->like('tname',$tname,'both');
					if($employeeID)
					$this->db->like('employeeID',$employeeID,'both');
					if($designation)
					$this->db->where('designation',$designation);
					$this->db->select('employeeID,tname,designation,id,csalary.teacher_id')
					->group_by('teacher_id');
					$result=$this->db->get('csalary');
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table tablesorter table-normal" id="xsaralyreport" style="overflow-x: auto;">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('#'); ?></div></th>
                            <th><div><?php echo translate('Employee ID'); ?></div></th>
                            <th><div><?php echo translate('Name'); ?></div></th>
							<th><div><?php echo translate('Designation'); ?></div></th>
                            <th><div><?php echo translate('pf','upper_case'); ?></div></th>
                            <th><div><?php echo translate('total'); ?></div></th>
                            <th><div><?php echo translate('payment'); ?></div></th>
                            <th><div><?php echo translate('balance'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
						echo form_open('admin/provident_payment/pay');
                        $serial_no = 1;
                        foreach ($result->result() as $row): 
						$paid_amount=get_single_value('sum(paid_amount)','provident_payment',array('teacher_id'=>$row->teacher_id));
						if(!$paid_amount)
						$paid_amount=0;
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
									$current_balance=$total_amount-$paid_amount;
									?>
								</td>
								<td><?=$total_amount?></td>
								<td>
									<input type="hidden" class="form-control" name="teacher_id[]" value="<?=$row->teacher_id?>"/>
									<input type="text" class="	datepicker fill-up" name="payment_date[]"  placeholder="<?=translate('payment_date')?>" value="<?=date('d/m/Y')?>"/>
									<input type="text" class="form-control" name="paid_amount[]" placeholder="<?=translate('paid_amount')?>" number max_value="<?=$current_balance?>"/>
								</td>
								<td><?=$current_balance?></td>
                            </tr>
                    <?php 
                        $serial_no++;    
                        endforeach; 
                    ?>
                    </tbody>
					<tfoot>
						<tr>
							<td colspan="9" align="center" style="text-align: center;">
								<button class="btn btn-normal btn-success" type="submit"><?=translate('submit')?></button>
							</td>
					</tfoot>
                </table>
            <?php }  ?>
        </div>
        <!----TABLE LISTING ENDS--->
    </div>