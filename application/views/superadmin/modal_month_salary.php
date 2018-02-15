<style>
	
	@media print { 
		.table th, tr, td{
			border: solid 1px black;
			margin:0;
			padding:0;
	}
}
</style>

<center>
<div class="box">
	<div class="">
		<div class="title">
			<div>
				<div>
					<h1>Wemax International School</h1>																										
				</div>
				<div >
					<h3>Staff Salary for the month of <?php $monthName = date('F', mktime(0, 0, 0, $month, 10)); 
					 $lastday=date('t', mktime(0, 0, 0, $month, 10)); echo $monthName." ".$lastday.", "; ?><?php echo $year; ?></h3>
				</div>
			</div>
		</div>
	</div>
    <br />
	
		
	
	<table class="table table-normal">

  <tr>
    <th>Sl No</th>
    <th>EmployeeID</th>  
    <th>Index Number</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Basic</th>
    <th>House Rent</th>
    <th>Medical Allowance</th>
    <th>Convince</th>
    <th>Other</th>
    <th>Gross Salary</th>
    <th>Working day</th>
    <th>Advance</th>
    <th>Deduction</th>
	<th>Loan</th>
	<th>Bonus</th>
    <th>Tax</th>
    <th>Net Payable</th>
    <th>Note</th>
  </tr>
  
  <?php
  $count=1;
$salarymonth =	$this->db->where(array('month' => $month,'year' => $year,'status' =>1))->get('csalary')->result_array();
foreach($salarymonth as $row):?>
  <tr>
    <td><?php echo $count++;?></td>
    <td><?php echo $row['employeeID'];?></td>
    <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->row()->indexNumber;?></td>
    <td><?php echo $row['tname'];?></td>
    <td><?php echo $row['designation'];?></td>
    <td><?php echo $row['Basic'];?></td>
    <td><?php echo $row['HouseRent'];?></td>
    <td><?php echo $row['MedicalAllowance'];?></td>
    <td><?php echo $row['Convince'];?></td>
    <td><?php echo $row['Others'];?></td>
    <td><?php echo $row['gsalary'];?></td>
    <td><?php echo $row['WorkingHour'];?></td>
    <td><?php echo $row['Advance'];?></td>
    <td><?php echo $row['Deduction'];?></td>
	<td><?php echo $row['loan'];?></td>
	<td><?php echo $row['bonus'];?></td>
    <td><?php echo $row['Tax'];?></td>
    <td><?php echo $row['tsalary'];?></td>
    <td><?php echo $row['Note'];?></td>
  </tr>
  
  <?php endforeach;?>
  
</table>
</center>

