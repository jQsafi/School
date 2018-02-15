
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


        
        
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('student_Attendance');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/student_attendance');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_month');?></td>
                        <td><?php echo translate('select_year');?></td>
                        <td><?php echo translate('select_class');?></td>
			<td><?php echo translate('select_group');?></td>
                        <td><?php echo translate('select_subject');?></td>
                	</tr>
                	<tr>
                        <td>
                     <select name="month" >
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
                        	 
            <select name="year" >
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
                        	<select name="class_id" class=""  onchange="show_subjects(this.value);showgroup(this.value);"  style="float:left;">
                                <option value=""><?php echo translate('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            Class <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
						<td>
                        	<select name="group_name" class="" style="width:100%;" id="std_group_name">
							<option value="">Select Group</option>
                            <?php
								echo make_select('group','group_id','group_name',$group_name);
							?>
                            </select>
                        </td>
						
                        <td>
                        	<!-----SELECT SUBJECT ACCORDING TO SELECTED CLASS--------->
							<?php 
                                $classes	=	$this->crud_model->get_classes(); 
                                foreach($classes as $row): ?>
                                
                                <select name="<?php if($class_id == $row['class_id'])echo 'subject_id';else echo 'temp';?>" 
                                      id="subject_id_<?php echo $row['class_id'];?>" 
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class=""  style="float:left;">
                                  
                                    <option value="">Subject of class <?php echo $row['name'];?></option>
                                    
                                    <?php 
                                    $subjects	=	$this->crud_model->get_subjects_by_class($row['class_id']); 
                                    foreach($subjects as $row2):
									$group_id=$row2['group_id'];
									//if($status==0)
									{
									?>
                                    <option value="<?php echo $row2['subject_id'];?>" 
									<?php if(isset($subject_id) && $subject_id == $row2['subject_id'])
                                                echo 'selected="selected"'; echo 'group='.$group_id;?>>
												<?php echo $row2['name'];?>
                                    </option>
                                    <?php 
									}
									endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
              <select name="temp" id="subject_id_0" 
                              style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="" style="float:left;">
                                    <option value="">Select a class first</option>
                            </select>  
                                
                        </td>
                        
                	</tr>
					<tr>
					<td>
                        	<input type="hidden" name="operation" value="selection" />
                    		<input type="submit" value="<?php echo translate('manage_attendence');?>" class="btn btn-normal btn-gray" />
                    </td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
                </table>
                </form>
                </center>
                
                </div>
			</div>
		</div>
                <br /><br />
                
                
        <?php if($month >0 && $class_id >0 && $year >=0 ):?>
            <h4>Class: <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>
                Month: <?php echo $this->db->get_where('month', array('id' => $month))->row()->name; ?>
                 Year: <?php echo $year; ?></h4>
                <?php $attendancetype = $this->db->order_by('type_id')->get('attendance_type')->result_array();
                
                $tot_attendstype=count($attendancetype);
                ?>
                <input type="hidden" id="totalattendancetype" value="<?php echo $tot_attendstype; ?>" >
            <?php  $countype=0;  
            foreach($attendancetype as $typerow){  
                $countype=$countype+1;
                ?>
                     <input type="hidden" id="attendancetype_<?php echo $countype; ?>" value="<?php echo $typerow['short_form']; ?>" >
            
                 <p><div class="foo" style="background-color:<?=$typerow['color']?>"><?php echo $typerow['short_form']; ?></div><?php echo $typerow['attendance_type']; echo "[".$typerow['short_form']."]"; ?> </p>
                                                   <?php } ?>
        <?php 
        
             $Allholidays = $this->db->order_by('holidayid')->get('holiday')->result_array();
             $this->db->where('class_id',$class_id);
             
            if($subject_id && $subject_id!=99999){
                $this->db->where('subject_id',$subject_id);    
                         }else{
                    $this->db->where('group_id',0);         
                    $this->db->where('status',0);                                 
                       } 
            $subjects=$this->db->from('subject')->get()->result_array();
            $main_subjects=array();
            foreach($subjects as $row5):
              $main_subjects[]=$row5['subject_id']; 
            endforeach;
            $totalday = cal_days_in_month(CAL_GREGORIAN, $month, $year); ?>
       <input type="hidden" id="totaldayofmonth" value="<?php echo $totalday; ?>" >        
       
          <?php    echo form_open('admin/student_attendance'); ?>
                 
    <input type="hidden" name="operation" value="update" />
	<div class="attendance">
        <table class="table" style="margin:0 auto;border-collapse: collapse;text-align: center;font-size: 12px;" border="1px">            
		<tr>
                <th><?=translate("roll")."-".translate("name")?></th>
                <th><?=translate('subject')?></th>
                
        <?php for($day=1;$day<=$totalday;$day++){  ?>
            <th> <?php  $timestamp = strtotime("$year-$month-$day");
                        $dayname = date('D', $timestamp);
                        echo $dayname; echo "<br>";echo $day;  ?> 
            </th>
                 <?php } 
                 foreach($attendancetype as $typerow){ ?>
            <th> <?php echo $typerow['short_form']; ?>  </th>
                                                <?php } ?>        
             </tr>
			</thead>
          <?php
        $i=0;  
        $students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
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
            <th rowspan="<?php echo $numberofsubject+1;  ?>" >                 <img src="<?php echo base_url();?>uploads/student_image/<?php echo $row['student_id'];  ?>.jpg" width="40px" />
                 </br>
                <?=$row['roll']."-".$row['nick_name']; ?>
			</th>
            
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
                                  
                     <input type="hidden" name="attendance[<?php echo $i;?>][attendence_id]" value="" />
                     <input type="hidden" name="attendance[<?php echo $i;?>][class_id]" value="<?php echo $class_id; ?>" />
                     <input type="hidden" name="attendance[<?php echo $i;?>][student_id]" value="<?php echo $row['student_id']; ?>" />
                     <input type="hidden" name="attendance[<?php echo $i;?>][year]" value="<?php echo $year; ?>" />
                     <input type="hidden" name="attendance[<?php echo $i;?>][month]" value="<?php echo $month; ?>" />
                     <input type="hidden" name="attendance[<?php echo $i;?>][subject_id]" value="<?php echo $eachsubid; ?>" />
                                  
                   </td>    
                          
            <?php
            
        foreach($attendancetype as $typerow){
                ${"total_".$typerow['short_form']} = 0;     
                                            }
            
        for($day=1;$day<=$totalday;$day++){ 
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
         
        <td style="padding:0 !important;">
                    <?php if($holidayname){ echo $holidayname; }  ?>
                
        <select  id="attends_<?php echo $i;?>_day_<?php echo $day;?>" name="attendance[<?php echo $i;?>][<?php echo $day;?>]" class="attendance-dropdown" style="border:none;padding: 0 !important;margin:0 !important;<?php 
                      foreach($attendancetype as $typerow){
                                if($type==$typerow['short_form']) { echo 'background-color:'.$typerow['color']; }
                                                          }
                              if($holidayname){echo "background-color:#66FF99";}  
                              if($dayname=="Fri"){ echo "background-color:#564D61"; }
                                       ?>"  onchange="
                                           attendancecalculation(<?php echo $i;?>,<?php echo $day;?>);
                             <?php  foreach($attendancetype as $typerow){ ?>
                    if(this.options[this.selectedIndex].text=='<?php echo $typerow['short_form']; ?>') this.style.backgroundColor ='<?=$typerow['color']?>';
                                   <?php } ?> 
                        "> <option></option>
        <?php  foreach($attendancetype as $typerow){ ?>
            <option <?php  if($type==$typerow['short_form']) { echo "selected"; } ?> value="<?php echo $typerow['short_form']; ?>"><?php echo $typerow['short_form']; ?></option>
                                               <?php } ?> 
                </select>
               
         </td>
                          
            <?php   } $i++; ?>
          
                  <?php  foreach($attendancetype as $typerow){ ?>
                    <td><div id="total_row<?php echo $typerow['short_form']; ?><?php echo $i;?>"> <?php echo ${"total_".$typerow['short_form']} ?> </div>
                        <input type="hidden" id="total_row_value<?php echo $typerow['short_form']; ?><?php echo $i;?>" value="<?php echo ${"total_".$typerow['short_form']} ?>"></td>  
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
                   <td  style="text-align: right;" colspan="<?php echo $totalday+2; ?>">Total</td>

                    <?php      foreach($attendancetype as $typerow){ ?>
                   <td><div id="total_column_sum<?php echo $typerow['short_form']; ?>"><?php echo  ${"total_month_".$typerow['short_form']}; ?> </div></td>
                <?php   }  ?>

                   </tr> 
                              
                              
                   <tr>
                            <td  style="text-align: right;" rowspan="<?php echo $tot_attendstype+1; ?>">Total Attendance</td>
                         
                          
                <?php    foreach($attendancetype as $typerow){   ?>
                                    
                             <tr><td><?php echo $typerow['short_form']; ?></td>       


                            <?php 
                            ${"Month_total_".$typerow['short_form']}=0;
                                     for($day=1;$day<=$totalday;$day++){  ?>
                 <td> <input type="hidden" id="total_col_value<?php echo $typerow['short_form']; ?><?php echo $day;?>" value="<?php if(${"total_".$typerow['short_form']."_day".$day}){
                     echo ${"total_".$typerow['short_form']."_day".$day};
                                      }else{echo 0;} ?>">
                         
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
                              
                      
   
                
    <tr><td colspan="10" style="text-align: center;"><button type="submit" class="btn btn-normal btn-gray "> Update attendance </button></td>          </tr>
	</table>
		 </div>   
  </form>        
 <?php endif;?>
     <input type="hidden" name="totalrowfinal" id="totalrowfinal" value="<?php echo $i; ?>"  >
<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.stickyheader.js"></script> 
<script type="text/javascript">
$(function()
{
	$("#std_group_name").trigger('change');
});
$("#std_group_name").change(function()
{
	var group=$(this).val();
	$("[group]").hide();
	$("[group="+group+"]").show();
	$("[group=0]").show();
});
  function show_subjects(class_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('subject_id_'+i).style.display = 'none' ;
	  		  document.getElementById('subject_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      document.getElementById('subject_id_'+class_id).style.display = 'block' ;
	  document.getElementById('subject_id_'+class_id).setAttribute("name" , "subject_id");
  }

  function show_subExam(exam_id)
  {
      for(i=0;i<=100;i++)
      {

          try
          {
              document.getElementById('exam_id_'+i).style.display = 'none' ;
	  		  document.getElementById('exam_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
	  if(exam_id >0)
	  {
        document.getElementById('exam_id_'+ exam_id ).style.display = 'block' ;
		document.getElementById('exam_id_'+ exam_id ).setAttribute("name" , "exam_sub_id");
		}
  }




</script> 

<script type="text/javascript">
    var mytextbox = document.getElementById('mytext');
    var mydropdown = document.getElementById('dropdown');

    mydropdown.onchange = function(){
          mytextbox.value =this.value; //to appened
    }
</script>
<script>
 function attendancecalculation(fieldid,attendancedate){
      var totaltype=document.getElementById("totalattendancetype").value;
      var maxrowfinal=document.getElementById("totalrowfinal").value;
    for(var count=1;count<=totaltype;count++){
     var typename=document.getElementById('attendancetype_'+count).value;      
                                             }
     var totaldayofmonth= document.getElementById("totaldayofmonth").value; 
     
       var attendancecounter = [];
       var colattendance = [];
       var columntotaltype=[];
       var rowtotaltype=[];
       
         for(var count=1;count<=totaltype;count++){
                var typename=document.getElementById('attendancetype_'+count).value;
                attendancecounter[typename]=0;
                colattendance[typename]=0;
                columntotaltype[typename]=0;
                rowtotaltype[typename]=0;
                          }
        
        
        for(var day=1;day<=totaldayofmonth;day++){
        var type=document.getElementById('attends_'+fieldid+'_day_'+day).value;
                 
     for(var count=1;count<=totaltype;count++){
        var typename=document.getElementById('attendancetype_'+count).value;
                   if(typename==type){
                       attendancecounter[typename]=attendancecounter[typename]+1;
                       
                                    }

                          }  
                          
        }
        
       
        for(var col=0;col<maxrowfinal;col++){
            var coltype=document.getElementById('attends_'+col+'_day_'+attendancedate).value;
       
        for(var count=1;count<=totaltype;count++){
            var typename=document.getElementById('attendancetype_'+count).value;
           
                   if(typename==coltype){
                       colattendance[typename]=colattendance[typename]+1;
                       
                                    }

                          }  
 
            
                }
        
        
      
      var rownumber=fieldid+1;
      for(var count=1;count<=totaltype;count++){
          var typename=document.getElementById('attendancetype_'+count).value;
       
          document.getElementById('total_row'+typename+rownumber).innerHTML=attendancecounter[typename];
          document.getElementById('total_row_value'+typename+rownumber).value=attendancecounter[typename];
      }    
          
     for(var count=1;count<=totaltype;count++){
        var typename=document.getElementById('attendancetype_'+count).value; 
        document.getElementById('total_col'+typename+attendancedate).innerHTML=colattendance[typename];
        document.getElementById('total_col_value'+typename+attendancedate).value=colattendance[typename];
        }  
                         
     
          
      for(var count=1;count<=totaltype;count++){
           var typename=document.getElementById('attendancetype_'+count).value;
              for(var col=1;col<=maxrowfinal;col++){
           var colmonthtotal=document.getElementById('total_row_value'+typename+col).value;
              columntotaltype[typename]=columntotaltype[typename] + parseInt(colmonthtotal);
                                                 }
            
                          }  
                         
        
      for(var count=1;count<=totaltype;count++){
           var typename=document.getElementById('attendancetype_'+count).value; 
           document.getElementById('total_column_sum'+typename).innerHTML=columntotaltype[typename];
                                               } 
   
   
      for(var count=1;count<=totaltype;count++){
          var typename=document.getElementById('attendancetype_'+count).value;
   
          
                  for(var day=1;day<=totaldayofmonth;day++){
         var allcolmtype=document.getElementById('total_col_value'+typename+day).value;
            rowtotaltype[typename]=rowtotaltype[typename] + parseInt(allcolmtype);
                                           }
          
            
                          } 
   
      for(var count=1;count<=totaltype;count++){
                               
        var typename=document.getElementById('attendancetype_'+count).value; 
       document.getElementById('total_month_sum'+typename).innerHTML=rowtotaltype[typename];
                                               } 

    }   
</script>

