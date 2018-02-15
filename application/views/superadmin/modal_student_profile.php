<?php //echo "$$$".$current_student_id;
$student_info = $this->crud_model->get_student_info($current_student_id);
foreach ($student_info as $row):
    ?>
    <center>
    <style>
		@media print {	
			.admission-form table{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;}
			.admission-form .institute-student-info img{width:120px; height:140px;}
			.institute-student-info table td:first-child {padding-right:20px;}
			.institute-student-info table td h3, .institute-student-info table td h5{margin:0; line-height:20px; padding:0;}
			@page { size:8.5in 11in;}
			.admission-form table{font-size:14px; text-transform:capitalize;}
			.admission-form .table td{ line-height:20px;}
		}
	</style>
        <div class="box admission-form">    
            <table class="admission-form-header">
             <tr>
                <td align="left">
                 <img src=" <?php echo base_url(); ?>template/images/system-logo.svg" width="100" height="100">
                </td>
                
                <td align="center">
                    <h2><?php echo get_single_value('description','settings',array('type'=>'system_name'));?></h2>
                    <h3><?php echo get_single_value('description','settings',array('type'=>'address'));?></h2>
                </td>
              </tr>
            </table>
             <hr />                 
            
            <table width="98%">
                <tr>
                    <td align="left">
                    	<b><?php echo translate('registration_no'); ?></b>: <?php echo $row['registration_no']; ?></td>
                    <td align="right">
                        <b><?php echo translate('admission_form_no'); ?>:</b> <?php echo $row['admission_form_no']; ?>
                    </td>
                </tr>
             </table> 
            
            <div class="institute-student-info">
            <table>
            	<tr>
                	<td>
                    <div class="avatar">
                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-big"/>
               		</div>
                    </td>
                    <td>
                     <h3>
					 	<?php echo $row['name']; ?>
						<?php if($row['nick_name']) echo "(".$row['nick_name'].")"; ?>
					</h3>
                     <h5>Student Id Number: <?php echo $row['student_unique_ID']; ?></h5>
                     <h5>Class: <?php echo $this->crud_model->get_class_name($row['class_id']); ?></h5>
                     <h5>Roll: <?php echo $row['roll']; ?></h5>
                     <h5>Section: <?php echo $row['section']; ?></h5>
					 <?php
					 if($row['academic_year'])
					 {
					 ?>
					 <h5>Academic Year: <?php echo $row['academic_year']; ?></h5>
					 <?php
					 }
					 $group_name=get_single_value('group_name','group',array('group_id'=>$row['group']));
					 if($row['group'])
					 { ?>
                     <h5>Group: <?php echo  $group_name; ?></h5>
					 <?php }?>
                    </td>
                 </tr>
             </table>
            </div>
            <?php
			$fourth_subject=get_single_value('fourth_id','student',array('student_id'=>$row['student_id']));
			$fourth_subject_name=get_single_value('name','subject',array('subject_id'=>$fourth_subject));
			$this->db->select('subject_id,name');
			$this->db->from('subject');
			$this->db->where('class_id',$row['class_id']);
			$this->db->where('group_id',0);
			$this->db->where('status',0);
			$this->db->where('subject_id !=',$fourth_subject);
			$result=$this->db->get();
			$subjects=array();
			//$li='<td class="subject_header compulsory list-header"><b>Compulsory Subject</b></td>';
			$li='';
			$subject_counter=1;
			foreach($result->result() as $sub)
			{
				$subject_counter++;
				$subject_id=$sub->subject_id;
				$sub_name=get_single_value('name','subject',array('subject_id'=>$subject_id));
				$li.="<tr><td>:".$sub_name."</td></tr>";
			}
			//$subject_counter++;
			$group_subjects=get_single_value('subject_id','student',array('student_id'=>$row['student_id']));
			$subject_ids=explode('SC',$group_subjects);
			$group_li='';
			$group_subject_counter=1;
			foreach($subject_ids as $id)
			{
				if($id)
				{
					$group_subject_counter++;
					$sub_name=get_single_value('name','subject',array('subject_id'=>$id));
					$group_li.="<tr><td>:".$sub_name."</td></tr>";	
				}
			}
			?>
            <br />
            <table class="table"> 
                
               <?php //if ($row['subject_id'] != ''): ?>
                    <tr>
						<td rowspan="<?php echo $subject_counter;?>" style="border-right: solid 1px #CCC;"><b>General Subject</b></td>
                    </tr>
						<?php echo $li; ?>
					<?php
					if($group_li)
					{
						?>
							<tr><td rowspan="<?php echo $group_subject_counter;?>"><b>Group Subject</b></td></tr>
						<?php
						echo $group_li;
					}?>
                <?php //endif; ?>               
                
                
                <?php if ($fourth_subject): ?>
                    <tr>
                        <td><b>Fourth Subject</b></td>
                        <td>: <?php echo $fourth_subject_name; ?></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['birthday'] != ''): ?>
                    <tr>
                        <td><b>Birthday</b></td>
                        <td>: <?php echo $row['birthday']; ?></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['sex'] != ''): ?>
                    <tr>
                        <td><b>Sex</b></td>
                        <td>: <?php echo $row['sex']; ?></td>
                    </tr>
                <?php endif; ?>
                <?php if ($row['maritial_status'] != ''): ?>
                    <tr>
                        <td><b>Maritial Status</b></td>
                        <td>: <?php echo $row['maritial_status']; ?></td>
                    </tr>
                <?php endif; ?>
				<?php if ($row['phone'] != ''): ?>
                    <tr>
                        <td><b>Student's Phone/Mobile Number</b></td>
                        <td>: <?php echo $row['phone']; ?></td>
                    </tr>
                <?php endif; ?>
               
                <tr>
                    <td><b>Blood Group</b></td>
                    <td>: <?php echo $row['blood_group']; ?>O+</td>
                </tr>  
                
                <?php if ($row['religion']): ?>
                    <tr>
                        <td><b>Religion</b></td>
                        <td>: <?php echo get_single_value('religion_name','religion',array('religion_id'=>$row['religion'])); ?></td>
                    </tr>
                <?php endif; ?>
                
                  <?php if ($row['nationality'] != ''): ?>
                    <tr>
                        <td><b>Nationality</b></td>
                        <td>: <?php echo $row['nationality']; ?></td>
                    </tr>
                <?php endif; ?>
                
                <?php if ($row['email'] != ''): ?>
                    <tr>
                        <td><b>Email Address</b></td>
                        <td>: <?php echo $row['email']; ?></td>
                    </tr>
                <?php endif; ?>
                
                <tr>
                    <td><b>Father Info</b></td>
                    <td>  
					<?php if ($row['father_name'] != ''): ?>
						<span><b>Name: </b><?php echo $row['father_name']; ?>,</span>
					<?php endif; ?>
                    
                    <?php if ($row['father_age'] != ''): ?>
						<span><b>Age:</b> <?php echo $row['father_age']; ?>,</span>
					<?php endif; ?>
                    <?php if ($row['father_education'] != ''): ?>
						<span><b>Education:</b> <?php echo $row['father_education']; ?>,</span>
					 <?php endif; ?> 
                     <?php if ($row['father_occupation'] != ''): ?>
						<span><b>Occupation:</b> <?php echo $row['father_occupation']; ?>,</span>
					 <?php endif; ?> 
                    
                     <?php if ($row['father_mobile'] != ''): ?>
						<span><b>Mobile Number:</b> <?php echo $row['father_mobile']; ?>,</span>
					 <?php endif; ?> 
                    <?php if ($row['father_birthday'] != ''): ?>
						<span><b>Birth Day:</b> <?php echo $row['father_birthday']; ?>,</span>
					 <?php endif; ?>     
                     <?php if ($row['father_blood_group'] != ''): ?>
						<span><b>Blood Group:</b> <?php echo $row['father_blood_group']; ?>,</span>
					 <?php endif; ?>     
                    
                     <?php if ($row['father_nidnumber'] != ''): ?>
						<span><b>National Id card No:</b> <?php echo $row['father_nidnumber']; ?>,</span>
					 <?php endif; ?>                    
                    </td>
                </tr>
                    
                <tr>
                    <td><b>Mother Info</b></td>
                    <td>  
					<?php if ($row['mother_name'] != ''): ?>
						<span><b>Name: </b><?php echo $row['mother_name']; ?>,</span>
					<?php endif; ?>
                    
                    <?php if ($row['mother_age'] != ''): ?>
						<span><b>Age:</b> <?php echo $row['mother_age']; ?>,</span>
					<?php endif; ?>
                    
                     <?php if ($row['mother_education'] != ''): ?>
						<span><b>Education:</b> <?php echo $row['mother_education']; ?>,</span>
					<?php endif; ?>
                    
                     <?php if ($row['mother_occupation'] != ''): ?>
						<span><b>Occupation:</b> <?php echo $row['mother_occupation']; ?></span>
					<?php endif; ?>
                    
                    <?php if ($row['mother_mobile'] != ''): ?>
						<span><b>Mobile Number:</b> <?php echo $row['mother_mobile']; ?>,</span>
					 <?php endif; ?> 
                    <?php if ($row['mother_birthday'] != ''): ?>
						<span><b>Birth Day:</b> <?php echo $row['mother_birthday']; ?>,</span>
					 <?php endif; ?>     
                     <?php if ($row['mother_blood_group'] != ''): ?>
						<span><b>Blood Group:</b> <?php echo $row['mother_blood_group']; ?>,</span>
					 <?php endif; ?>     
                    
                     <?php if ($row['mother_nidnumber'] != ''): ?>
						<span><b>National Id card No:</b> <?php echo $row['mother_nidnumber']; ?>,</span>
					 <?php endif; ?>
                    </td>
                </tr> 
                
                <?php if ($row['present_address'] != ''): ?>
                    <tr>
                        <td><b>Present Address</b></td>
                        <td>: <?php echo $row['present_address']; ?></td>
                    </tr>
                <?php endif; ?>
                
                <?php if ($row['permanent_address'] != ''): ?>
                    <tr>
                        <td><b>Permanent Address</b></td>
                        <td>: <?php echo $row['permanent_address']; ?></td>
                    </tr>
                <?php endif; ?>
                
                 <tr>
                    <td><b>Guardian Info</b></td>
                    <td>  
					 <?php if ($row['guardian_name'] != ''): ?>
						<span><b>Name: </b><?php echo $row['guardian_name']; ?>,</span>
					 <?php endif; ?>
                    <?php if ($row['guardian_age'] != ''): ?>
						<span><b>Age:</b> <?php echo $row['guardian_age']; ?>,</span>
					 <?php endif; ?>
					  <?php if ($row['guardian_profession'] != ''): ?>
						<span><b>Occupation:</b> <?php echo $row['guardian_profession']; ?>,</span>
					 <?php endif; ?>
					 <?php if ($row['guardian_income'] != ''): ?>
						<span><b>Anual Income:</b> <?php echo $row['guardian_income']; ?></span>
					 <?php endif; ?>
					 <?php if ($row['guardian_land'] != ''): ?>
						<span><b>Amount of land:</b> <?php echo $row['guardian_land']; ?></span>
					 <?php endif; ?>
					 <?php if ($row['guardian_nid'] != ''): ?>
						<span><b>NID:</b> <?php echo $row['guardian_nid']; ?>,</span>
					 <?php endif; ?>
					 <?php if ($row['guardian_birthday'] != ''): ?>
						<span><b>Birth Day:</b> <?php echo $row['guardian_birthday']; ?>,</span>
					 <?php endif; ?>
					 <?php if ($row['gardian_mobile'] != ''): ?>
						<span><b>Mobile Number:</b> <?php echo $row['gardian_mobile']; ?>,</span>
					 <?php endif; ?>
					 <?php if ($row['gardian_blood_group'] != ''): ?>
						<span><b>Blood Group:</b> <?php echo $row['gardian_blood_group']; ?>,</span>
					 <?php endif; ?>
					 <?php if ($row['guardian_address'] != ''): ?>
						<span><b>Address:</b> <?php echo $row['guardian_address']; ?></span>
					 <?php endif; ?>      
					 <?php if ($row['relation_id']): ?>
						<span><b>, Relation:</b> <?php echo get_single_value('relation_name','relation',array('relation_id'=>$row['relation_id'])); ?></span>
					 <?php endif; ?>          
                    </td>
                </tr> 
                
				<?php if ($row['tc_institution_name'] != ''): ?>
                <tr>
                    <td><b>Tc Information</b></td>
                    <td>  
					 <?php if ($row['tc_institution_name'] != ''): ?>
						<span><b>Tc From [Institute Name]: </b><?php echo $row['tc_institution_name']; ?>,</span>
					 <?php endif; ?>
                    
                     <?php if ($row['tc_form_no'] != ''): ?>
						<span><b>Tc Number:</b> <?php echo $row['tc_form_no']; ?>,</span>
					 <?php endif; ?>
                     
                      <?php if ($row['tc_date'] != ''): ?>
						<span><b>Date:</b> <?php echo $row['tc_date']; ?></span>
					 <?php endif; ?>
                    </td>
                </tr> 
                <?php endif; ?>
                
                 <?php if ($row['prev_institution_name'] != ''): ?>
                 <tr>
                    <td><b>Previous Exam Description</b></td>
                    <td>  
					 <?php if ($row['prev_institution_name'] != ''): ?>
						<span><b>Institute Name: </b><?php echo $row['prev_institution_name']; ?>,</span>
					 <?php endif; ?>
                     
                     <?php if ($row['prev_institution_address'] != ''): ?>
						<span><b>Institute Address: </b><?php echo $row['prev_institution_address']; ?>,</span>
					 <?php endif; ?>
                    
                     <?php if ($row['prev_class_id'] != ''): ?>
						<span><b>Class:</b> <?php echo $row['prev_class_id']; ?>,</span>
					 <?php endif; ?>
                     
                     <?php if ($row['prev_passing_yrs'] != ''): ?>
						<span><b>Passing Year:</b> <?php echo $row['prev_passing_yrs']; ?>,</span>
					 <?php endif; ?>
                     
                     <?php if ($row['prev_gpa'] != ''): ?>
						<span><b>GPA:</b> <?php echo $row['prev_gpa']; ?></span>
					 <?php endif; ?>
                    </td>
                </tr> 
                <?php endif; ?>
                
                <?php if ($row['other_student_name'] != ''): ?>
                 <tr>
                    <td><b>Same Guardian Other Student Info</b></td>
                    <td>  
					 <?php if ($row['other_student_name'] != ''): ?>
						<span><b>Student Name: </b><?php echo $row['other_student_name']; ?>,</span>
					 <?php endif; ?>
                     
                     <?php if ($row['others_class_id'] != ''): ?>
						<span><b>Class: </b><?php $prev_class_name=get_single_value('name','class',array('class_id'=>$row['others_class_id'])); if($prev_class_name) echo $prev_class_name; ?>,</span>
					 <?php endif; ?>
                    <?php if ($row['group_others'] != ''): ?>
						<span><b>Group:</b> <?php $prev_group_name=get_single_value('group_name','group',array('group_id'=>$row['group_others'])); if($prev_group_name) echo $prev_group_name; ?></span>
					 <?php endif; ?>
                     <?php if ($row['others_section'] != ''): ?>
						<span><b>Section:</b> <?php echo $row['others_section']; ?>,</span>
					 <?php endif; ?>
                     
                     <?php if ($row['others_roll'] != ''): ?>
						<span><b>Roll:</b> <?php echo $row['others_roll']; ?></span>
					 <?php endif; ?>
                    </td>
                </tr> 
                <?php endif; ?>
            </table>
        </div>
    </center>

<?php endforeach; ?>