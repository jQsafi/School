<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                	<?php foreach($edit_data as $row):?>
                    <?php echo form_open('admin/salary_setup/do_update/'.$row['id'] , array('class' => 'form-horizontal validatable','target'=>'_parent','enctype' => 'multipart/form-data'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
								<?php $query = $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']));
										$res = $query->result_array();
										foreach ($res as $row1)
												$teachername=$row1['name'];
								?>
                                    <input type="text" name="name" DISABLED value="<?php echo $teachername;?>"/>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Basic');?></label>
                                    <input type="text" name="Basic" id="basic" value="<?php echo $row['Basic'];?>" />TK.
                            </div>
							
							
						
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Medical_Allowance');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="MedicalAllowance" placeholder="amount in Taka" value="<?php echo $row['MedicalAllowance'];?>" />TK.
                            </div>
                            
                            
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('House_Rent');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="HouseRent" placeholder="amount in Taka" value="<?php echo $row['HouseRent'];?>" />TK.
                                </div>
                            
                            
                              
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('Convince');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Convince" placeholder="amount in Taka" value="<?php echo $row['Convince'];?>" />TK.
                            </div>
                            
							<!--<div class="control-group">
                                    <label class="control-label"><?php echo translate('Working_Hour'); ?></label>
                                        <input type="text" name="WorkingHour" value="<?php echo $row['WorkingHour'];?>" />
                            </div>-->
							<div class="control-group">
                                <label class="control-label"><?php echo translate('pf');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="pf"  placeholder="amount in Taka" value="<?php echo $row['pf'];?>" />TK.
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Tax');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Tax"  placeholder="amount in Taka" value="<?php echo $row['Tax'];?>" />TK.
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Others');?></label>
								<input type="text" onkeyup="changevalue(this)"  placeholder="amount in %" />% &nbsp;&nbsp;&nbsp;
									<input type="text" name="Others"  placeholder="amount in Taka" value="<?php echo $row['Others'];?>" />TK.
                            </div>
							
							<!--<div class="control-group">
                                <label class="control-label"><?php echo translate('Advance');?></label>
									<input type="text" name="Advance" placeholder="amount in Taka" value="<?php echo $row['Advance'];?>" />TK.
                            </div>-->
							
							<!--<div class="control-group">
                                <label class="control-label"><?php echo translate('Deduction');?></label>
									<input type="text" name="Deduction"  placeholder="amount in Taka" value="<?php echo $row['Deduction'];?>" />TK.
                            </div>-->
							
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('notes');?></label>
                                    <input type="text"  name="notes" value="<?php echo $row['Note'];?>" />
                            </div>
							</div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('edit_salary');?></button>
                        </div>
                    </form>
                    <?php endforeach;?>
                </div>
			</div>
			<script>
				function changevalue(element)
				{
					var basic=$("#basic").val();
					if(basic)
					{
						var percenttage=$(element).val();
						var changeamount=(basic*percenttage)/100;
						$(element).next('input').val(changeamount);
					}
					else
					alert("Please Give Basic Salary amount.");
				}
			</script>