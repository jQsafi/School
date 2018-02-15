        <div class="box box-border">
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane" id="list">
                <?php echo form_open('admin/employee_attendance_report/search');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
						<td><?=translate('select_employee')?></td>
                        <td><?php echo translate('select_month');?></td>
                        <td><?php echo translate('select_year');?></td>
                	</tr>
                	<tr>
						<td>
							<select name="teacher_id" class="form-control">
								<option value=""><?=translate('select_employee')?></option>
								<?=make_select('teacher','teacher_id','name',$teacher_id)?>
							</select>
						</td>
                        <td>
                     <select name="month"  required="">
                    <option value="">- Select month -</option>    
                                                                <?php
                                                                $currentmonth=date("n");
                    $months = $this->db->get('month')->result_array();
                                                                foreach ($months as $row3):
                                                                ?>
                                                                 <?php if ($row3['id']<=$currentmonth): ?>


                    <option value="<?php echo $row3['id']; ?>"
                    <?php if ($month == $row3['id']) echo 'selected'; ?>>
                    <?php echo $row3['name']; ?></option>


                                                                <?php endif; ?>
                                                                <?php
                                                                endforeach;
                                                                ?>
                </select>

                        </td>
                       
                      <td>
                        	 
            <select name="year"  required="">
                                    <?php
                                             $starting_year  = 2015;
                                             $ending_year    = date('Y');


                                             for($thisYear; $starting_year <= $ending_year; $starting_year++) {
                                             ?>
                <option value="<?php echo $starting_year; ?>"
                <?php if ($year == $starting_year) echo 'selected'; ?>>
                <?php echo $starting_year; ?></option>


                            <?php
                                            }

                            ?>							
                            </select>
                            
                        </td>
					<td>
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo translate('manage_attendence');?>" class="btn btn-normal btn-gray" />
                    </td>
					</tr>
                </table>
                </form>
                </center>
        </div></div>    </div>
                
                
<?php if($month >0 && $year >=0 ):
	if($teacher_id)
	$this->db->where('teacher_id',$teacher_id);
	$teachers=$this->db->get('teacher');
	foreach($teachers->result() as $row)
	{
		$counter=0;
		$condition=array(
					'teacher_id'=>$row->teacher_id,
					'year'=>$year,
					'month'=>$month
					);
			$time_exist=get_single_value('count(teacher_id)','employee_attendance',$condition);
			if($time_exist){
		?>
			<br><table class="table table-normal">
			<tbody>
		<?php
		$late_count=0;
		$absent_count=0;
		$present_count=0;
		if(!$counter)
		{
			?>
			<tr>
				<td>&nbsp;</td>
				<?php
				for($d=1; $d<=31; $d++)
				{
				    $time=mktime(12, 0, 0, $month, $d, $year);          
						if (date('m', $time)==$month)  
					{
						$condition=array(
					'teacher_id'=>$row->teacher_id,
					'year'=>$year,
					'month'=>$month,
					'day'=>$d
					);
						$exist=get_single_value('count(teacher_id)','employee_attendance',$condition);
						if($exist)
						{
							?>
						<td colspan="3">
						<?=$d.",".$day_name=date('D', $time)?>
						</td>
						<?php
						}
					}     
				}
				?>
					<th colspan="3"><?=translate('total')?></th>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<?php
			for($d=1; $d<=31; $d++)
			{
			    $time=mktime(12, 0, 0, $month, $d, $year);          
			    if (date('m', $time)==$month)  
				{
					if (date('m', $time)==$month)  
					{
						$condition=array(
					'teacher_id'=>$row->teacher_id,
					'year'=>$year,
					'month'=>$month,
					'day'=>$d
					);
						$exist=get_single_value('count(teacher_id)','employee_attendance',$condition);
						if($exist)
						{
							?>
							<td><?=translate('IN')?></td>
							<td><?=translate('OUT')?></td>
							<td><?=translate('status')?></td>
						<?php	
						}
					}
				}     
			}
				?>
				<th><?=translate('present')?></th>
			<th><?=translate('late')?></th>
			<th><?=translate('leave')?><br>/<?=translate('absent')?></th>
			</tr>
			<?php		

		}
		$img=$row->photo;
		$img=base_url('uploads/teacher_image/'.$img);
		$designation=$row->designation;
		if($designation)
		$designation=get_single_value('name','designation',array('id'=>$designation));
		$condition=array(
					'teacher_id'=>$row->teacher_id,
					'year'=>$year,
					'month'=>$month,
					);
						$exist=get_single_value('count(teacher_id)','employee_attendance',$condition);
						if($exist){
		?>
			<tr>
				<td>
					<div class="thumbnail">
						<img  src="<?=$img?>"/>
						<div class="caption">
						<b><?=translate('name')?>:</b> <?=$row->name?><br>
						<b><?=translate('designation')?>:</b> <?=$designation?><br>
						</div>
					</div>
				</td>
				<?php
				for($d=1; $d<=31; $d++)
				{
				    $time=mktime(12, 0, 0, $month, $d, $year);          
				    if (date('m', $time)==$month)  
					{
						$condition=array(
					'teacher_id'=>$row->teacher_id,
					'year'=>$year,
					'month'=>$month,
					'day'=>$d
					);
						$exist=get_single_value('count(teacher_id)','employee_attendance',$condition);
						if($exist)
						{
							$in_time=get_single_value('in_time','employee_attendance',$condition);
							$out_time=get_single_value('out_time','employee_attendance',$condition);
							$status=get_single_value('status','employee_attendance',$condition);
							if($in_time=='00:00:00' or $in_time=='-')
							{
								$in_time='';
								$out_time='';
							}
							if($status=='-')
							$status='';
							if($in_time or $out_time)
							{
								$shift_in_time=get_single_value('in_time','shift',array('shift_id'=>$row->shift_id));
								if($shift_in_time<$in_time)
								{
									$status="Late";
									$late_count++;
								}
								else
								{
									$status="Present";
									$present_count++;
								}
							}
							else
							{
								$in_time='X';
								$out_time='X';
								$absent_count++;
							}
							?>
							<td><?=$in_time?></td>
							<td><?=$out_time?></td>
							<td><?=$status?></td>
							<?php
						}
					}     
				}
				?>
				<td><?=$present_count?></td>
				<td><?=$late_count?></td>
				<td><?=$absent_count?></td>
			</tr>
		<?php	
		}
		$counter++;
		?>
		</tbody>
</table>
		<?php
		}
	}
?>
 <?php endif;?>