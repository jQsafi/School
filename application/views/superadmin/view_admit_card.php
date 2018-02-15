<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<link rel="stylesheet" type="text/css" media="" href="<?php echo base_url();?>template/css/admit_card.css" />
		<?php
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		
		$system_name	=	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
		$system_title	=	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
		?>
		<title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
	<script>
		//window.print();
	</script>
<body class="admit_card">
<?php
$paper=$this->input->post('paper');
?>
                         <?php if($print_all=="yes"){ 
    
                foreach($all_admitid as $admit_id){
                    
             
                    
            $admitsinfo=$this->db->get_where('admit_card', array('admit_id' => $admit_id))->result_array();        
                    ?>
    
<?php foreach($admitsinfo as $admits ){ ?>
     
     
   <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $admits['student_id']))->result_array();
   
   foreach($studentinfo as $students ){ 
   
   ?> 
   
   <div class="a4">
   <div class="container">
			<div class="wraper">
				<!--Left Side-->
				<center>
				<img src="template/images/admit_card/school_name.svg" width="670">
					<h1><?php echo $this->db->get_where('exam', array('exam_id' => $admits['exam_id']))->row()->name; ?> Admit Card-<?php echo $admits[year]; ?></h1>
					<hr>

					<div style="display:block; margin-left: 85px;">					
						<div class="student_images">
								<img src="<?php echo base_url();?>uploads/student_image/<?php echo $students['student_id'];  ?>.jpg" width="74">
						</div>
					
						<div style="float:left">
							<table>
								<tr>
									<td>Name of Examinee</td>
									<td>: <b><?php echo $students['name']; ?></b></td>
								</tr>
								<tr>
									<td>Father&#8217;s Name</td>
									<td>: <?php echo $students['father_name']; ?></td>
								</tr>
								<tr>
									<td>Mother&#8217;s Name</td>
									<td>: <?php echo $students['mother_name']; ?></td>
								</tr>
								<tr>
									<td>Date Of Birth</td>
									<td>: <?php
									$dob=$students['birthday']; 
									$dob=str_replace('/','-',$dob);
									$dob=date("d-M-Y",strtotime($dob));
									echo $dob;
									?></td>
								</tr>
								<tr>
									<td>Exam Date</td>
									<td>: 
									<?php 
									$date=$this->db->get_where('exam', array('exam_id' => $admits['exam_id']))->row()->date; 
									echo date("d-M-Y",strtotime($date));
									?>
								</td>
								</tr>
							</table>
						</div>


						<div style="float:left; margin-left:30px;">
							<table>
								<tr>
									<td>Student ID</td>
									<td>: <?php echo $students['student_unique_ID']; ?></td>
								</tr>
								<tr>
									<td>Class</td>
									<td>: <?php echo $this->db->get_where('class', array('class_id' => $admits['class_id']))->row()->name; ?></td>
								</tr>
								<tr>
									<td>Group</td>
									<td>: <?php echo $this->db->get_where('group', array('group_id' => $students['group']))->row()->group_name; ?></td>
								</tr>
								<tr>
									<td>Section</td>
									<td>: <?php echo $students['section']; ?></td>
								</tr>
								<tr>
									<td>Roll</td>
									<td>: <?php echo $students['roll']; ?></td>
								</tr>
							</table>
						</div>
					</div>																
					<p class="granted_date">Granted : <span><?php echo date('d-M-Y',strtotime($admits['grantedform'])); ?> to <?php echo date('d-M-Y',strtotime($admits['grantedto'])); ?></span></p>
				</center>
				<div class="clear:both"></div>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="signature">
					<tr>
						<td>Accountant Signature</td>
						<td align="right">Headmaster Signature</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	 
   <?php } } ?>
                
    
                <?php  } ?>
    
                         <?php }else{ ?>
<?php foreach($admitsinfo as $admits ){ ?>
     
   <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $admits['student_id']))->result_array();
   
   foreach($studentinfo as $students ){ 
   
   ?> 
   
   
   <div class="a4">
   <div class="container">
			<div class="wraper">
				<!--Left Side-->

				<center>
				<img src="template/images/admit_card/school_name.svg" width="670">

					<h1><?php echo $this->db->get_where('exam', array('exam_id' => $admits['exam_id']))->row()->name; ?> Admit Card-<?php echo $admits[year]; ?></h1>
					<hr>
					
					<div style="display:block; margin-left: 85px;">					
						<div class="student_images">
								<img src="<?php echo base_url();?>uploads/student_image/<?php echo $students['student_id'];  ?>.jpg" width="74">
						</div>
					
						<div style="float:left">
							<table>
								<tr>
									<td>Name of Examinee</td>
									<td>: <b><?php echo $students['name']; ?></b></td>
								</tr>
								<tr>
									<td>Father&#8217;s Name</td>
									<td>: <?php echo $students['father_name']; ?></td>
								</tr>
								<tr>
									<td>Mother&#8217;s Name</td>
									<td>: <?php echo $students['mother_name']; ?></td>
								</tr>
								<tr>
									<td>Date Of Birth</td>
									<td>: <?php echo $students['birthday']; ?></td>
								</tr>
								<tr>
									<td>Exam Date</td>
									<td>: <?php echo $this->db->get_where('exam', array('exam_id' => $admits['exam_id']))->row()->date; ?></td>
								</tr>
							</table>
						</div>


						<div style="float:left; margin-left:30px;">
							<table>
								<tr>
									<td>Student ID</td>
									<td>: <?php echo $students['student_unique_ID']; ?></td>
								</tr>
								<tr>
									<td>Class</td>
									<td>: <?php echo $this->db->get_where('class', array('class_id' => $admits['class_id']))->row()->name; ?></td>
								</tr>
								<tr>
									<td>Group</td>
									<td>: <?php echo $this->db->get_where('group', array('group_id' => $students['group']))->row()->group_name; ?></td>
								</tr>
								<tr>
									<td>Section</td>
									<td>: <?php echo $students['section']; ?></td>
								</tr>
								<tr>
									<td>Roll</td>
									<td>: <?php echo $students['roll']; ?></td>
								</tr>
							</table>
						</div>
					</div>																
					<p class="granted_date">Granted : <span><?php echo date('d-M-Y',strtotime($admits['grantedform'])); ?> to <?php echo date('d-M-Y',strtotime($admits['grantedto'])); ?></span></p>
					

				</center>
				<!--Left Side-->
				<div style="clear:both"></div>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="signature">
					<tr>
						<td>Accountant Signature</td>
						<td align="right">Headmaster Signature</td>
					</tr>
				</table>
			</div>
		</div>
	
	   </div>
   <?php } } ?>
                
                         <?php } ?>
</body>
</html>





