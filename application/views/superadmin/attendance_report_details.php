<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php include 'includes.php'; ?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
		<script>
		print_css="<?php echo base_url();?>template/css/schoolsoft.css";
	</script>
		 <style>

            select.attendance-dropdown {
                 -webkit-appearance: none;       
                 -moz-appearance: none;    
                 appearance: none;    
                 width: 100%;
                 
                 background-image: none !important;
				 font-size: 12px;
				 text-align: center;
                           }
            .foo {   
                 float: left;
                 width: 20px;
                 height: 20px;
                 border-width: 1px;
                 border-style: solid;
                 border-color: rgba(0,0,0,.2);}
                      body
					  {
					  	overflow-x: scroll !important;
						
					  }
         </style>
    </head>


    <body style="padding:10px">  
        <script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
 <?php 
            $year=$report_year;
            $class_id=$class_id;
            
            for($month_number=$start_month;$month_number<=$end_month;$month_number++){
            $month=$month_number; 
            $totalday = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                              
                if($month==$start_month){ $initial=$start_day;  }else{  $initial=1;  }
                if($month==$end_month){ $finish=$end_day; }else{ $finish= $totalday; }
      ?>
    
    
    
        <?php if($month >0 && $year >=0 && $year!=1970):?>
        
            <?php  if($student_id_attends){ 
        $class_id=$this->db->get_where('student', array('student_id' => $student_id_attends))->row()->class_id;
       } ?>
            <h4>Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
                Month: <?php echo $this->db->get_where('month', array('id' => $month))->row()->name; ?>
                 Year: <?php echo $year; ?></h4>
                <?php 
                if($Att_type_report){
             $attendancetype = $this->db->where(array('short_form' => $Att_type_report))->order_by('type_id')->get('attendance_type')->result_array();
                        
                }else{
             $attendancetype = $this->db->order_by('type_id')->get('attendance_type')->result_array();
                        
                }
               
                $tot_attendstype=count($attendancetype);
                ?>
               
            <?php  $countype=0;  
            foreach($attendancetype as $typerow){  
                $countype=$countype+1;
                ?>
                     
                                                   <?php } ?>
        <?php 
        
         foreach($attendancetype as $typerow){
               
               ${"total_month_".$typerow['short_form']}=0;
               ${"Month_total_".$typerow['short_form']}=0;
                                            }
                                            
                for($day=$initial;$day<=$finish;$day++){
                    foreach($attendancetype as $typerow){
                 ${"total_".$typerow['short_form']."_day".$day}=0;
                    }
                }
        
        
             $Allholidays = $this->db->order_by('holidayid')->get('holiday')->result_array();
             $this->db->where('class_id',$class_id);
             //$this->db->where('group_id',0);
            if($subject_id && $subject_id!=99999){
                $this->db->where('subject_id',$subject_id);    
                         }else{
                    $this->db->where('status',0); 
                    $this->db->where('group_id',0);
                       } 
            $subjects=$this->db->from('subject')->get()->result_array();
            $main_subjects=array();
            foreach($subjects as $row5):
              $main_subjects[]=$row5['subject_id']; 
            endforeach;
            ?>
		<table id="attendance_report" class="table" style="margin:0 auto;border-collapse: collapse;text-align: center;font-size: 12px;" border="1px">
            <tr>
               <th><?=translate("roll")."-".translate("name")?></th>
                <th><?=translate('subject')?></th>

                
        <?php for($day=$initial;$day<=$finish;$day++){  ?>
            <th> <?php  $timestamp = strtotime("$year-$month-$day");
                        $dayname = date('D', $timestamp);
                        echo $dayname; echo " ";echo $day;  ?> 
            </th>
                 <?php } 
                 foreach($attendancetype as $typerow){ ?>
            <th> <?php echo $typerow['short_form']; ?>  </th>
                                                <?php } ?>        
             </tr>
                
          <?php
        $i=0; 
        if($student_id_attends){
        $students = $this->db->where(array('class_id' => $class_id,'student_id'=>$student_id_attends))->order_by('roll')->get('student')->result_array();
                               }else{
     $students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
                                     
                               }
        foreach($students as $row):  
         $group_subjects=get_single_value('subject_id','student',array('student_id'=>$row['student_id']));
	
                            if($group_subjects){
                                    $subject_ids=explode('SC',$group_subjects);
                                    $group_subjects=array();
                                   foreach($subject_ids as $id){

                                                        if($id)
                                                        {
                                                                $group_subjects[]=$id;
                                                        }
                                    }

                                $fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$row['student_id']));
                                   if($fourth_subject){
                                        $group_subjects[]=$fourth_subject;
                                                       }

                                                }else{
                                                  $group_subjects=array();              
                                                       }
                             if($subject_id && $subject_id!=99999){
                                                  $group_subjects=array(); 
                                                                  }         
            $Finalsubjects=array();
            $Finalsubjects= array_merge($main_subjects,$group_subjects);  
            $numberofsubject=count($Finalsubjects); 
        
                         ?>
                                                  
      
       <tr>
            <td rowspan="<?php echo $numberofsubject+1;  ?>" >
           <img src="<?php echo base_url();?>uploads/student_image/<?php echo $row['student_id'];  ?>.jpg" width="40px" />
                 </br>
                <?=$row['roll']."-".$row['nick_name']; ?>  </td>
                     <?php     foreach($Finalsubjects as $eachsubid):
        $Allattendanceinfo=$this->db->get_where('attendance', array('class_id' => $class_id,'month'=>$month,'year'=>$year,'subject_id'=>$eachsubid,'student_id' => $row['student_id']))->result_array();             
              
        $verify_data = array(	
            'month' => $month,
            'class_id' => $class_id ,
            'year' => $year, 
            'student_id' => $row['student_id'],
            'subject_id' => $eachsubid
            );      ?> 
                              
                <tr>
                    <td><?php echo get_single_value('short_name','subject',array('subject_id'=>$eachsubid)); ?>
                                  
                    </td>    
                          
            <?php
            
        foreach($attendancetype as $typerow){
                ${"total_".$typerow['short_form']} = 0; 
                                            }
                                            
                for($day=$initial;$day<=$finish;$day++){
                    foreach($attendancetype as $typerow){
                    }
                }
                
                
                
            
        for($day=$initial;$day<=$finish;$day++){ 
                $datefield="date_".$day;
            
        foreach($Allattendanceinfo as $DayAttendance){
                $type=$DayAttendance[$datefield];
            }                
                             

        if($day<10){ $properday="0$day"; }else{$properday=$day;}
        if($month<10){ $propermonth="0$month"; }else{$propermonth=$month;}
                                        
         
            $Properdateformat="$year-$propermonth-$properday";
            $holidayname='';
            $holidayresult=search($Allholidays, 'holidaydate', $Properdateformat);
                    if($holidayresult){
                       $holidayname=$holidayresult[0]['holidayname'];
                                      }  
            $timestamp = strtotime("$year-$month-$day");   
            $dayname = date('D', $timestamp);
                               
            foreach($attendancetype as $typerow){
                                if($type==$typerow['short_form']){
                                ${"total_".$typerow['short_form']} = ${"total_".$typerow['short_form']}+1;     
                                                            }
                    
                                                }
                // start column wise calculation                                       
            foreach($attendancetype as $typerow){
                                if($type==$typerow['short_form']){
              
                   ${"total_".$typerow['short_form']."_day".$day} = ${"total_".$typerow['short_form']."_day".$day}+1;
               
                                                 }
                    
                                }    ?>
         
        <td  style="padding:0 !important;<?php 
         
                            if($dayname=="Fri"){
                               echo "background-color:#564D61";
                                               }
                            else if($holidayname){
                               echo "background-color:#66FF99";
                                               }  
         ?>"><div >  
                    <?php if($holidayname){ echo $holidayname; }  ?> 
              <?php
   
                if($Att_type_report){
                  if($Att_type_report==$type){
                                        echo $type; 
                                               }else{}
                   }else{  
                       echo $type; } ?>
                
                </div>               
         </td>
                          
            <?php   } $i++; ?>
          
                  <?php  foreach($attendancetype as $typerow){ ?>
                    <td style="background-color:<?=$typerow['color']?>"><div id="total_row<?php echo $typerow['short_form']; ?><?php echo $i;?>"> <?php echo ${"total_".$typerow['short_form']} ?> </div>
                        </td>  
                                                       <?php } ?>
                          
              </tr>
                              
                     <?php 
            foreach($attendancetype as $typerow){
                   ${"total_month_".$typerow['short_form']}=${"total_month_".$typerow['short_form']} +${"total_".$typerow['short_form']}; 
                   } 
                     endforeach;   ?>         
                          </td>
                          <tr>

            <?php  endforeach;   ?>
                    
                     
            <tr>
                   <td  style="text-align: right;" colspan="<?php echo ($finish-$initial)+3; ?>">Total</td>

                    <?php      foreach($attendancetype as $typerow){ ?>
                   <td style="background-color:<?=$typerow['color']?>"><?php echo  ${"total_month_".$typerow['short_form']}; ?> </td>
                <?php   }  ?>

                   </tr> 
                              
                              
                   <tr>
                            <td  style="text-align: right;" rowspan="<?php echo $tot_attendstype+1; ?>">Total Attendance</td>
                         
                          
                <?php    foreach($attendancetype as $typerow){   ?>
                                    
                             <tr style="background-color:<?=$typerow['color']?>"><td><?php echo $typerow['short_form']; ?></td>       


                            <?php 
                            ${"Month_total_".$typerow['short_form']}=0;
                                     for($day=$initial;$day<=$finish;$day++){  ?>
                 <td> 
                     <div id="total_col<?php echo $typerow['short_form']; ?><?php echo $day;?>">
                         
                     <?php 
                    if(${"total_".$typerow['short_form']."_day".$day}){
                     echo ${"total_".$typerow['short_form']."_day".$day};
                                      }else{echo 0;}
                            ${"Month_total_".$typerow['short_form']}=${"Month_total_".$typerow['short_form']}+${"total_".$typerow['short_form']."_day".$day};    ?> </td>
                                                        <?php } ?> 
                                 <td colspan="5"><div id="total_month_sum<?php echo $typerow['short_form']; ?>"> <?php echo ${"Month_total_".$typerow['short_form']}; ?> </div></td>
                                </tr> 
                              

                    
                               <?php     }      ?>                
                                  </div>
                            
                     </tr>       
                              
                      
         </table>
     
                           
         <?php endif;?>
    
    
            <?php } ?>
    
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</div>

	         <div>
                    <a data-toggle="modal" href="#" onClick ="$('#attendance_report').tableExport({type:'excel',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#attendance_report').tableExport({type:'doc',escape:'false',ignoreColumn: [19,20]});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
					<button print="#attendance_report" class="btn btn-blue">
                        <i class="icon-print"></i> <?php echo translate('print'); ?>
                    </button>
                 </div>

</body>
</html>

