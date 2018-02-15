<link href="<?php echo base_url();?>template/css/bootstrap-datetimepicker.min.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>template/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <div class="box box-border">
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane" id="list">
                <?php echo form_open('admin/employee_attendance/');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
						<td><?=translate('select_employee')?></td>
                        <td><?php echo translate('select_month');?></td>
                        <td><?php echo translate('select_year');?></td>
                	</tr>
                	<tr>
						<td>
							<select name="teacher_id" class="form-control" required="">
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
                
                
<?php if($month >0 && $year >=0 ):?>
<?php echo form_open('admin/employee_attendance');?>
<input type="hidden" name="month" value="<?=$month?>"/>
		<input type="hidden" name="year" value="<?=$year?>"/>
<table class="table table-normal">
<thead>
	<tr>
		<td>&nbsp;</td>
		<?php
		for($d=1; $d<=31; $d++)
		{
		    $time=mktime(12, 0, 0, $month, $d, $year);          
		    if (date('m', $time)==$month)  
			{
				?>
				<td>
				<?=$d.",".$day_name=date('D', $time)?>
				</td>
				<?php
			}     
		}
		?>
	</tr>
</thead>
<tbody>
<?php
	if($teacher_id)
	$this->db->where('teacher_id',$teacher_id);
	$teachers=$this->db->get('teacher');
	foreach($teachers->result() as $row)
	{
		$img=$row->photo;
		$img=base_url('uploads/teacher_image/'.$img);
		$designation=$row->designation;
		if($designation)
		$designation=get_single_value('name','designation',array('id'=>$designation));
		?>
		<input type="hidden" name="operation" class="span2" value="update">
		<input type="hidden" name="teacher_id" class="span2" value="<?=$row->teacher_id?>">
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
						//echo $this->db->last_query()."<br>";
						$in_time='';
						$out_time='';
						$status='';
						if($exist)
						{
							$in_time=get_single_value('in_time','employee_attendance',$condition);
							$out_time=get_single_value('out_time','employee_attendance',$condition);
							$status=get_single_value('status','employee_attendance',$condition);
						}
						?>
						<input type="hidden" name="day[]" value="<?=$d?>"/>
						<td>
							<div class="input-append date time">
								<input type="text" name="in_time[]" class="span2" placeholder="<?=translate('in_time')?>" value="<?=$in_time?>"/>
								<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
								</span>
							</div>
							<div class="input-append date time">
								<input type="text" name="out_time[]" class="span2" placeholder="<?=translate('out_time')?>" value="<?=$out_time?>"/>
								<span class="add-on">
											<i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
								</span>
							</div>
							<select name="status[]" class="span2">
								<option value=""><?=translate('leave_name')?></option>
								<?=make_select('leave_type','leave_name','leave_name',$status)?>
							</select>
						</td>
						<?php
					}     
				}
				?>
			</tr>
		<?php
	}
?>
</tbody>
</table>
<center><button class="btn btn-gray" type="submit"><?=translate('submit')?></button></center>
</form>
 <?php endif;?>
 <script type="text/javascript">
      $('.time').datetimepicker({
		format: 'HH:mm PP',
		pickDate: false,
        pickSeconds: false,
        pick12HourFormat: true
      });
    </script>
