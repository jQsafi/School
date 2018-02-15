<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php 
		$this->load->view('includes');
		$system_title=get_single_value('description','settings',array('type'=>'system_name'));
		?>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body style="padding:10px">
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Manage Fees');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/fees');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
                        <td><?php echo translate('select_fee');?></td>
						<td>
							<input type="checkbox" name="same" id="same" class="checkbox" checked="true"/>
							All values are same?
						</td>
                	</tr>
                	<tr>
                        <td>
                        	<select name="class_id">
                                <option value=""><?php echo translate('select_class');?></option>
                                <?php 
									echo make_select('class','class_id','name',$class_id);
                                ?>
                            </select>
                        </td>
						<td>
                        	<select name="group_id">
							<option value=""><?php echo translate('select_group');?></option>
                            <?php
								echo make_select('group','group_id','group_name',$group_id);
							?>
                            </select>
                        </td>
						
                        <td>
                                <select name="fess_id" id="fees_id">
									<option value=""><?php echo translate('select_fee');?></option>
									<?php
										echo make_select('fees_name','fees_name_id','fee_full_name',$fess_id);
									?>
                                </select> 
                        </td>
                        <td>
						<input type="hidden" name="operation" value="selection"/>
						<input type="submit" value="<?php echo translate('manage_fees');?>" class="btn btn-normal btn-gray" />
						</td>
                	</tr>
					<tr>
					</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($class_id >0 && $fees_id >=0 ):?>
                <?php 
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
							echo form_open('admin/fees'); 
							$fess_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fess_id));
							?>
                
                <table class="table tablesorter">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo translate('ID');?></th>
							<th><?php echo translate('Roll');?></th>
                            <th><?php echo translate('name');?></th>
							<th>
								<?php echo $fess_name;?>
							</th>
                        </tr>
					</thead>
					<tbody>
						<input type="hidden"  value="<?php echo $class_id;?>" name="class_id">
						<input type="hidden"  value="<?php echo $group_id;?>" name="group_id">
						<input type="hidden"  value="<?php echo $fess_id;?>" name="fess_id">
						<input type="hidden"  value="update" name="operation">
                            <?php
							
							if($group_id)
								$students = $this->db->get_where('student', array('class_id' => $class_id,'group' => $group_id))->result_array();
								else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
						
                            $i=0;
							foreach($students as $row):
									$student_id=$row['student_id'];
									$i++;
									$current_amount=get_single_value('amount','fees',array('student_id'=>$student_id,'fees_id'=>$fess_id));
									if(!$current_amount or $current_amount=='-')
									$current_amount='';
                                    ?>
                                    <tr>
										<td>
											<?php echo $i;?>
										</td>
										<td>
                                            <?php echo $row['student_unique_ID']; ?>
                                        </td>
										<td>
                                            <?php echo $row['roll']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
										<td>
											<input type="text" number name="<?php echo $student_id;?>" class="input fees" value="<?php echo $current_amount;?>">
										</td>
                                    </tr>
                                    
                         	<?php endforeach; ?>
						</tbody>
						<tr>
                            <td colspan="10" style="text-align: center;">
							<button type="submit" class="btn btn-normal btn-gray "> Submit </button></td>
                        </tr>
                  </table>
			</form>
            
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</body>
<script>
	$(".fees").keyup(function()
	{
		if($("#same").is(':checked'))
		{
			var cv=$(this).val();
			$(".fees").val(cv);
		}
	});
</script>
</html>