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
        
            <h2 align="center"><?php echo $system_name; ?></h2>
            <h4 align="center"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?></h4>
            <h6 align="center"> Pay Slip </h6>
            <?php  
            
            $salaryinfo = $this->db->where(array('id' => $payslipid))->get('csalary')->result_array(); 
	    foreach($salaryinfo as $row):                                                                        
             $teacher_id = $row['teacher_id'];
         
            ?>
            <p align="center"> Employee Name : <?php echo $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->name; ?>     </p>
            <p align="center"> Designation :   <?php
				 $deg_id = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->row()->designation;              
                                    echo $this->db->get_where('designation', array('id' => $deg_id))->row()->name;
                                    ?>   </p>
            <p align="center"> Month & Year :  <?php
            $mons = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec");
                               
                                  $month_name = $mons[$row['month']];
                                  echo $month_name; echo " ";echo $row['year'];
                                  ?>  </p>
            
            <?php
            $Earning = array();
            if($row['Basic']>0){
               array_push($Earning, "Basic"); 
            }  if($row['MedicalAllowance']>0){
               array_push($Earning, "MedicalAllowance"); 
            }  if($row['HouseRent']>0){
               array_push($Earning, "HouseRent"); 
            }  if($row['Convince']>0){
               array_push($Earning, "Convince"); 
            }  if($row['Bonus']>0){
               array_push($Earning, "Bonus"); 
            }if($row['Others']>0){
               array_push($Earning, "Others"); 
            }
            
            $Deduction=array();
            if($row['Tax']>0){
               array_push($Deduction, "Tax"); 
            }  if($row['Advance']>0){
               array_push($Deduction, "Advance"); 
            }  if($row['Deduction']>0){
               array_push($Deduction, "Deduction"); 
            }  if($row['Loan']>0){
               array_push($Deduction, "Loan"); 
            }
           
            
            $Earncount = count($Earning);
            $deductcount=count($Deduction);
            $numofrow=max($Earncount,$deductcount);
            
         
            ?>
            
            <table class="table table-normal" cellpadding="0" cellspacing="0" border="1">
                    <thead>
                        <tr>
                            <th><div><?php echo translate('Earning'); ?></div></th>
                            <th><div><?php echo translate('Amount'); ?></div></th>
                            <th><div><?php echo translate('Deductions'); ?></div></th>
                            <th><div><?php echo translate('Amount'); ?></div></th>		
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php for($i=0;$i<$numofrow;$i++){  ?> 
                        
                      <tr>
                        <td><?php echo translate($Earning[$i]); ?> </td>
                        <td><?php echo $row[$Earning[$i]]; ?> </td>
                        <td><?php echo translate($Deduction[$i]); ?> </td>
                        <td><?php echo $row[$Deduction[$i]]; ?> </td>
                        </tr>   
                    <?php } ?>
                    <tr>
                        <td><?php echo translate('Total Addition'); ?> </td>
                        <td><?php  
                        $total_earn=$row['Basic']+$row['MedicalAllowance']+$row['HouseRent']+$row['Convince']+$row['bonus']+$row['Others'];
                        echo $total_earn;
                        
                        ?> </td>
                        <td><?php echo translate('Total Deduction'); ?> </td>
                        <td><?php
               $total_deduction=$row['Tax']+$row['Advance']+$row['Deduction']+$row['loan'];
                        echo $total_deduction;         
                            ?>
                        </td>
                        </tr>
                        <tr>
                        <td> </td>
                        <td> </td>
                        <td><?php echo translate('Net Salary'); ?> </td>
                        <td><?php $netsalary=$total_earn-$total_deduction; echo $netsalary; ?> </td>
                        </tr>
                     </tbody>
                 </table>
            
                
                                <?php          
                                endforeach;                                                                 
                                   ?>
                
        <div id="paymentprocess" >
             <b> Payment Method : </b>
           <select id="paymentmethod" onchange="forcheck()">
              <option value="">....</option>                  
              <option value="Cash">Cash</option>
              <option value="Cheque">Cheque</option>
           </select>
        </div>
        <div style="display:none" id="cashpayment">
             Cheque no <input type="text" name="Cheque-no" id="Cheque-no" />
             Name of Bank <input type="text" name="bank-name" id="bank-name" /> 
             <button onclick="processcheque()">process</button>
        </div>
        <div style="display:none" id="cash">
             <p> Payment method : Cash </p>        
        </div>
        <div style="display:none" id="Cheque">
            <p> Payment method : Cheque </p>
             Cheque no. <p id="chequeno"></p>
             Name of Bank : <p id="bankname"></p>
        </div>
            
            
            
                
                <p> Date : <?php echo date("j F, Y");   ?></p>
                <p >----------------------------- </p> <p align="center">-------------------------------------</p>
                <p >Signature of the employee </p>      <p align="center"> Account Officer</p>                  
</body>
</html>
<script>
    function forcheck(){
      var paymethod=document.getElementById("paymentmethod").value;
      if(paymethod=="Cheque"){        
    document.getElementById("cashpayment").style.display="block";              
                            }else if(paymethod=="Cash"){
     document.getElementById("paymentprocess").style.display="none";                           
     document.getElementById("cashpayment").style.display="none"; 
     document.getElementById("cash").style.display="block";
                            }
    }
    function processcheque(){
        var chequeno=document.getElementById("Cheque-no").value;
        var bankname=document.getElementById("bank-name").value;
        if (chequeno == null || chequeno == "") {
                       alert("chequeno must be filled out");
                              return false;
                                   }  
        if (bankname == null || bankname == "") {
                       alert("bankname must be filled out");
                              return false;
                                   }
    document.getElementById("paymentprocess").style.display="none";
    document.getElementById("cashpayment").style.display="none";
    document.getElementById("Cheque").style.display="block";
    document.getElementById("chequeno").innerHTML=chequeno;
    document.getElementById("bankname").innerHTML=bankname;
    }
</script>