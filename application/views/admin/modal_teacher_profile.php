
<?php
$teacher_info	=	$this->crud_model->get_teacher_info($current_teacher_id);
foreach($teacher_info as $row):?>
<?php
$photo=$row['photo'];
if(!$photo)
$photo= base_url().'template/images/icons_big/teacher.png';
else
$photo= base_url('uploads/teacher_image/'.$photo);
?>
<center>
<div class="box">
	<div class="">
		<div class="title">
			<div style="float:left;width:370px;height:147px;text-align:left;position:relative; margin-bottom:20px;">
				<div class="avatar" style="position:absolute;bottom:0px;left:20px;">
					<img src="<?php echo $photo;?>" 
						class="avatar-big" style="max-height:130px;max-width:100px;" />
				</div>
				<div  style="position:absolute; bottom:10px;left:150px;">
					<h3 style=" color:#666;font-weight:100;"><?php echo $row['name'];?></h3>
				</div>
			</div>
		</div>
	</div>
    <br />
	<table class="table table-normal">
	
	   <?php if($row['employeeID'] != ''):?>
		<tr>
			<td width="150">Employee ID</td>
			<td><b><?php echo $row['employeeID'];?></b></td>
		</tr>
		<?php endif;?>
		
		<?php if($row['indexNumber'] != ''):?>
		<tr>
			<td width="150">Index Number</td>
			<td><b><?php echo $row['indexNumber'];?></b></td>
		</tr>
		<?php endif;?>

		<?php if($row['name'] != ''):?>
		<tr>
			<td width="150">Name</td>
			<td><b><?php echo $row['name'];?></b></td>
		</tr>
		<?php endif;?>
		<?php
		$this->db->where('teacher_id',$row['teacher_id']);
		$this->db->from('teacher_education');
		$result=$this->db->get();
		?>
	    <?php if($result->num_rows()>0):?>
		<tr>
			<td>Educational Qualification</td>
			<td><b><?php
			if($result->num_rows()>0)
			{
				?>
					<table>
						<tr>
							<th>
								Institute
							</th>
							<th>
								Year of Passing
							</th>
							<th>
								Result
							</th>
						</tr>
						<?php
						foreach($result->result() as $edu)
						{
							?>
							<tr><td><?=$edu->institute?></td><td><?=$edu->year?></td><td><?=$edu->result?></td></tr>
							<?php
						}
						?>
					</table>
				<?php
			}
			?></b></td>
		</tr>
		<?php endif;?>
	
    	<?php if($row['experience'] != ''):?>
		<tr>
			<td>experience</td>
			<td><b><?php echo $row['experience'];?></b></td>
		</tr>
		<?php endif;?>
		
	    <?php if($row['joiningDate'] != ''):?>
		<tr>
			<td>Joining Date</td>
			<td><b><?php echo $row['joiningDate'];?></b></td>
		</tr>
		<?php endif;?>
		
		
		 <?php if($row['designation'] != ''):?>
		<tr>
			<td>Designation</td>
			<td><b><?php $deg_id = $this->db->get_where('teacher', array('teacher_id' => $current_teacher_id))->row()->designation;
                                    echo $this->db->get_where('designation', array('id' => $deg_id))->row()->name;?></b></td>
		</tr>
		<?php endif;?>
		 <?php if($row['department'] != ''):?>
		<tr>
			<td>Department</td>
			<td><b><?php echo $row['department'];?></b></td>
		</tr>
		<?php endif;?>
		 <?php if($row['subject'] != ''):?>
		<tr>
			<td>Subject</td>
			<td><b><?php echo $row['subject'];?></b></td>
		</tr>
		<?php endif;?>
		<?php if($row['birthday'] != ''):?>
		<tr>
			<td>Birthday</td>
			<td><b><?php echo $row['birthday'];?></b></td>
		</tr>
		<?php endif;?>
	
    	<?php if($row['sex'] != ''):?>
		<tr>
			<td>Sex</td>
			<td><b><?php echo $row['sex'];?></b></td>
		</tr>
		<?php endif;?>
        <?php if($row['religion']):?>
		<tr>
			<td>Religion</td>
			<td><b><?php echo get_single_value('religion_name','religion',array('religion_id'=>$row['religion']));?></b></td>
		</tr>
		<?php endif;?>
		<?php if($row['blood_group'] != ''):?>
		<tr>
			<td>Blood Group</td>
			<td><b><?php echo $row['blood_group'];?></b></td>
		</tr>
		<?php endif;?>
        
		<?php if($row['address'] != ''):?>
		<tr>
			<td>Address</td>
			<td><b><?php echo $row['address'];?></b></td>
		</tr>
		<?php endif;?>
		<?php if($row['per_address'] != ''):?>
		<tr>
			<td>Permanent Address</td>
			<td><b><?php echo $row['per_address'];?></b></td>
		</tr>
		<?php endif;?>
		<?php if($row['phone'] != ''):?>
		<tr>
			<td>Phone</td>
			<td><b><?php echo $row['phone'];?></b></td>
		</tr>
		<?php endif;?>
	
		<?php if($row['email'] != ''):?>
		<tr>
			<td>Email</td>
			<td><b><?php echo $row['email'];?></b></td>
		</tr>
		<?php endif;?>
	</table>
</center>

<?php endforeach;?>