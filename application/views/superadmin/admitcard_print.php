<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php 
		$this->load->view('includes');
		$system_title=get_single_value('description','settings',array('type'=>'system_name'));
		?>
		
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body style="">    
	<?php
	$this->load->view('modal_hidden');
	?>
<div class="box box-border"  id="main_body">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Print Admit Card');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/admit_card_print');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
                        <td><?php echo translate('select_exam');?></td>
                         <td><?php echo translate('select_year');?></td>
						<td>
						</td>
                	</tr>
                	<tr>
                        <td>
                        	<select name="class_id">
                                <option value=""><?php echo translate('select_class');?></option>
                                <?php 
									echo make_select('class','class_id','name',$class_id);
                                ?>
                            </select>
                        </td>
						<td>
                        	<select name="group_id">
							<option value=""><?php echo translate('select_group');?></option>
                            <?php
								echo make_select('group','group_id','group_name',$group_id);
							?>
                            </select>
                        </td>
						
                        <td>
                                <select name="exam_id" id="exam_id">
									<option value=""><?php echo translate('select_exam');?></option>
									<?php
										echo make_select('exam','exam_id','name',$exam_id);
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
						<input type="hidden" name="operation" value="selection"/>
						<input type="submit" value="<?php echo translate('manage_admit');?>" class="btn btn-normal btn-gray" />
						</td>
                	</tr>
					<tr>
					</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php 
				$footer_str='';
				if($class_id >0 && $exam_id >=0 ):?>
                <?php 
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
							echo form_open('admin/view_admit_card',array('target'=>'_blank')); 
							$fess_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fess_id));
							?>
                
                <input type="hidden"  value="printall" name="operation">
               
                <table class="table tablesorter">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo translate('ID');?></th>
							<th><?php echo translate('Roll');?></th>
                            <th><?php echo translate('name');
                             $tot_exams=count($examlist);
                            
                            ?></th>
				   <input type="hidden" id="totalexam" value="<?php echo $tot_exams; ?>" > 			
                                                <?php 
                                                    
                                                $count=0;
                                                foreach($examlist as $examname){
                                                   $count=$count+1;
                                                    ?>
                            
                                                        <th class="{sorter: false}">
                                                            
								<input type="checkbox" id="admitcardall<?php echo $count; ?>" style="width:0px;overflow: visible;" rel="tooltip" data-placement="right" data-original-title="Check&nbsp;All">
								<?php echo $examname['name'];?>
							</th>
                                                <?php 
								$footer_str.='<th><input type="checkbox" id="admitcardall_f'.$count.'" style="width:0px;overflow: visible;" rel="tooltip" data-placement="right" data-original-title="Check&nbsp;All">'.$examname['name'].'</th>';
							} ?>
                                                    
                                   
                        </tr>
					</thead>
					<tbody>
						<input type="hidden"  value="<?php echo $class_id;?>" name="class_id">
						<input type="hidden"  value="<?php echo $group_id;?>" name="group_id">
						<input type="hidden"  value="<?php echo $exam_id;?>" name="exam_id">
                                                <input type="hidden"  value="<?php echo $year;?>" name="year">
						
                            <?php
							
							if($group_id)
								$students = $this->db->get_where('student', array('class_id' => $class_id,'group' => $group_id))->result_array();
								else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
						
                            $i=0;
							foreach($students as $row):
									$student_id=$row['student_id'];
									$i++;
									$grantedform=get_single_value('grantedform','admit_card',array('student_id'=>$student_id,'exam_id'=>$exam_id,'year'=>$year));
                                                                        
                                                                        $grantedto=get_single_value('grantedto','admit_card',array('student_id'=>$student_id,'exam_id'=>$exam_id,'year'=>$year));
									if(!$grantedto or $grantedto=='-'){
									$grantedto='';
                                                                        }else{
                                                    $date_string1= strtotime(str_replace('-', '/', $grantedto));

                                                    $grantedto =date("d/m/Y",$date_string1);                         
                                                                        }
                                                                           if(!$grantedform or $grantedform=='-'){
									    $grantedform='';
                                
                                                                                              }else{
                                                                  $date_string2= strtotime(str_replace('-', '/', $grantedform));
                                                                  $grantedform =date("d/m/Y",$date_string2);                                   
                                                                               
                                                                           }
                                    ?>                               
                                    <tr>
										<td>
											<?php echo $i;?>
										</td>
										<td>
                                            <?php echo $row['student_unique_ID']; ?>
                                        </td>
										<td>
                                            <?php echo $row['roll']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        
                                         <?php
                                    $countype=0;     
                                         foreach($examlist as $examdetail){ 
                                            
                                             $examid=$examdetail['exam_id'];
                                $admits = $this->db->get_where('admit_card', array('class_id' => $class_id,'exam_id' => $examid,'student_id' => $student_id,'year' => $year))->result_array(); 
                                
                            
                              $countype=$countype+1;
                                             ?>
                                
										<td>
                                                                                    <?php if($admits){
                                                                            
                                                                            foreach($admits as $admitdetail){            
                                                                                        
                                                                                        ?>
                                   
                                                                                        
                                                 <input type="checkbox" class="admitcard<?php echo $countype; ?>" name="admitcard[]" value="<?php echo $admitdetail['admit_id'];?>"/> 
											
                                                                                                                          <div class="btn-group action-dropdown">
                                                       <button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                       Action
                                                        </button>
                                                        
                                                        <ul class="dropdown-menu">
                                                        
                                                        <li> 
                                                            <a href="<?php echo base_url();?>index.php?admin/view_admit_card/<?php echo $admitdetail['admit_id'];?>" window="new" win_height="816px" win_width="1200px" >
                                                      <i class="icon-file-alt"></i><?php echo translate('view');?>
                                                           </a>
                                                        
                                                        </li>
     
                                                        <li> 


  <?php 
														if ($this->session->userdata('user_role') != 'accountant') { ?>
                                                            
                                                          <a href="<?php echo site_url('modal/popup/edit_admitcard/'.$admitdetail['admit_id']);?>" window="new" win_height="800px" win_width="1000px"><i class="icon-wrench"></i> <?php echo translate('edit'); ?></a>    
															</li>
                                                            <li> 
        

                                                                <a data-toggle="modal" href="#modal-delete" 
																onclick="modal_delete('<?=site_url('admin/admit_card_print/delete/'.$admitdetail['admit_id'].'/'.$class_id)?>')">
                                                                <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                            </a></li>
                                                        </ul>
                                                       
                                                       
                                                       
                                                     
                                                           
                                                        <?php } ?>
                                                        </div>      
                                                 
                                                                            <?php    }    }  ?>
										</td>
                                         <?php } ?>
                                                                                      
                                    </tr>
                 
                         	<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3">
									Paper Size
								</td>
								<td>
									<select name="paper">
										<option value="a4">A4</option>
										<option value="legal">Legal</option>
									</select>
								</td>
								<?=$footer_str?>
							</tr>
						<tr>
                            <td colspan="10" style="text-align: center;">
							<button type="submit" class="btn btn-normal btn-gray "> Submit </button></td>
                        </tr>
					</tfoot>
                  </table>
			</form>
            
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</body>
</html>    
<script>

    var totaltype=document.getElementById("totalexam").value;
    
for(var count=1;count<=totaltype;count++){

    $('#admitcardall'+count).change({msg: count},function(event) {
        
        var classid=event.data.msg;
    if(this.checked) {
          $(".admitcard"+classid).each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.admitcard'+classid).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }   
        
   }); 
   $('#admitcardall_f'+count).change({msg: count},function(event) {
        
        var classid=event.data.msg;
    if(this.checked) {
          $(".admitcard"+classid).each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.admitcard'+classid).each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }   
        
   }); 
  
}
                
                
</script>
    


