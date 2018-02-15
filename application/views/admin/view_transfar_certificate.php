<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
      <?php include 'application/views/includes.php';?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
<body>
                         <?php if($print_all=="yes"){ 
    
                foreach($all_tcinfo as $tcid){
        $tcinfo = $this->db->get_where('transfer_certificate', array('tc_id' => $tcid))->result_array();                    
                    ?>
    <div class="a4">
		<center>
            <h2 align="center"><?php echo $system_name; ?></h2>
     <h4 align="center"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?></h4>
<?php foreach($tcinfo as $tc ){ ?>
     
<h1 align="center">Transfar Certificate</h1>
   <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $tc['student_id']))->result_array();
   
   foreach($studentinfo as $students ){ 
   
   ?> 
   
     <table>
         <tr>
            
             <td>Name of Student :</td>
              <td><?php echo $students['name']; ?></td>
            
         </tr>
         <tr>
         
             <td>Father's Name :</td>
             <td><?php echo $students['father_name']; ?></td>
        </tr>
        <tr> 
           
             <td>Mother's Name :</td>
             <td><?php echo $students['mother_name']; ?></td>
        </tr>
        <tr> 
           
             <td>Date Of Birth :</td>
             <td><?php echo $students['birthday']; ?></td>
        </tr> 
        <tr> 
           
             <td>Nationality:</td>
             <td><?php echo $students['nationality']; ?></td>
        </tr> 
        <tr> 
           
             <td>Class to which he/she was admitted:</td>
             <td><?php echo $tc['admitted_class']; ?></td>
        </tr>  
        <tr> 
           
             <td>The Present Class</td>
             <td><?php echo $students['class_id']; ?>[<?php echo $this->db->get_where('class', array('class_id' => $students['class_id']))->row()->name; ?>] Section :<?php echo $students['section']; ?> Group :
                 
                 <?php echo $this->db->get_where('group', array('group_id' => $students['group']))->row()->group_name; ?>
            </td>
        </tr> 
         <tr> 
           
             <td>Last day of attendance in this school:</td>
             <td><?php echo $tc['last_day_attends']; ?></td>
        </tr> 
        <tr> 
           
             <td>Result at the end of the Academic Year:</td>
             <td><?php echo $tc['result']; ?></td>
        </tr>
        <tr> 
           
             <td>Observations if any:</td>
             <td><?php echo $tc['obserbation']; ?></td>
        </tr>
       <tr> 
           
             <td>Date of Leaving :</td>
             <td><?php echo $tc['leavingdate']; ?></td>
        </tr>
         <tr> 
           
             <td colspan="2">
			 	<p>&nbsp;</p>
			 	 <p>----------------------------- </p> 
<p> Principal Signature</p>	
			 </td>
        </tr>
        
     </table>
</center>
</div>    
   <?php } } } ?>
                         <?php }else{ ?>
	<div class="a4" align="center">
     <h2 align="center"><?php echo $system_name; ?></h2>
     <h4 align="center"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?></h4>
<?php foreach($tcinfo as $tc ){ ?>
     
<h1 align="center">Transfar Certificate</h1>
   <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $tc['student_id']))->result_array();
   
   foreach($studentinfo as $students ){ 
   
   ?> 
   
     <table>
        <tr>
            
             <td>Student Id:</td>
              <td><?php echo $students['student_id']; ?></td>
            
         </tr>
         <tr>
            
             <td>Name of Student :</td>
              <td><?php echo $students['name']; ?></td>
            
         </tr>
         <tr>
         
             <td>Father's Name :</td>
             <td><?php echo $students['father_name']; ?></td>
        </tr>
        <tr> 
           
             <td>Mother's Name :</td>
             <td><?php echo $students['mother_name']; ?></td>
        </tr>
        <tr> 
           
             <td>Date Of Birth :</td>
             <td><?php echo $students['birthday']; ?></td>
        </tr> 
        <tr> 
           
             <td>Nationality:</td>
             <td><?php echo $students['nationality']; ?></td>
        </tr> 
        <tr> 
           
             <td>Class to which he/she was admitted:</td>
             <td><?php echo $tc['admitted_class']; ?></td>
        </tr>  
        <tr> 
           
             <td>The Present Class</td>
             <td><?php echo $students['class_id']; ?>[<?php echo $this->db->get_where('class', array('class_id' => $students['class_id']))->row()->name; ?>] <?php if($students['section']){ ?> Section :<?php echo $students['section']; ?> <?php } ?>
                 
                
                 
                 <?php $group=$this->db->get_where('group', array('group_id' => $students['group']))->row()->group_name;
                 if($group){  ?>
                 Group :<?php echo $group; ?>     
                 <?php }  ?>
            </td>
        </tr> 
         <tr> 
           
             <td>Last day of attendance in this school:</td>
             <td><?php  echo  date("d F Y",strtotime($tc['last_day_attends']));  ?></td>
        </tr> 
        <tr> 
           
             <td>Result at the end of the Academic Year:</td>
             <td><?php echo $tc['result']; ?></td>
        </tr>
        <tr> 
           
             <td>Observations if any:</td>
             <td><?php echo $tc['obserbation']; ?></td>
        </tr>
       <tr> 
           
             <td>Date of Leaving :</td>
             <td><?php  echo  date("d F Y",strtotime($tc['leavingdate']));  ?></td>
        </tr>
         <tr> 
           
             <td colspan="2">
			 	<p>&nbsp;</p>
			 	 <p>----------------------------- </p> 
<p> Principal Signature</p>	
			 </td>
        </tr>
        
     </table>
</div>
   <?php } } ?>
                
                         <?php } ?>
</body>
</html>





