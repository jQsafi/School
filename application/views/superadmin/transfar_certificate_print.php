<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php 
		$this->load->view('includes');
                $this->load->view('modal_hidden');
		$system_title=get_single_value('description','settings',array('type'=>'system_name'));
		?>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body style="padding:10px">    
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Print TC');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/transfar_certificate_print');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
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
						<input type="hidden" name="operation" value="selection"/>
						<input type="submit" value="<?php echo translate('manage_TC');?>" class="btn btn-normal btn-gray" />
						</td>
                	</tr>
					<tr>
					</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($class_id >0 ):?>
                <?php 
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
							echo form_open('admin/view_transfar_certificate'); 
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
                      
                            
                                                        <th class="{sorter: false}">
                                                            
						               TC
									   Check All<input type="checkbox" class="check_all"
							</th>
          
                                                    
                                   
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

                            $tcs = $this->db->get_where('transfer_certificate', array('class_id' => $class_id,'student_id' => $student_id))->result_array(); 
                                             ?>
                                
										<td>
                                                                                    <?php if($tcs){
                                                                            
                                                                            foreach($tcs as $tc){            
                                                                                        
                                                                                        ?>
                                   
                                                                                        
                                                 <input type="checkbox" class="testimonial check" name="TC[]" value="<?php echo $tc['tc_id'];?>"/> 
											
                                                                                                                          <div class="btn-group action-dropdown">
                                                       <button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                      
                                                           TC DATE:<?php echo $tc['TC_date']; ?>
                                                        </button>
                                                        
                                                        <ul class="dropdown-menu">
                                                        
                                                        <li> 
                                                            <a href="<?php echo base_url();?>index.php?admin/view_transfar_certificate/<?php echo $tc['tc_id'];?>" window="new" win_height="816px" win_width="1200px" >
                                                      <i class="icon-file-alt"></i><?php echo translate('view');?>
                                                           </a>
                                                        
                                                        </li>
     
                                                        <li>   <?php 
														if ($this->session->userdata('user_role') != 'accountant') { ?>
                                                            
                                                          <a href="<?php echo site_url('modal/popup/edit_TC/'.$tc['tc_id']);?>" window="new" win_height="800px" win_width="1000px"><i class="icon-wrench"></i> <?php echo translate('edit'); ?></a>    
                                          
                                </a>
															</li>
                                                            <li> 
        

                                                                <a  href="<?php echo base_url(); ?>index.php?admin/transfar_certificate_print/delete/<?php echo $tc['tc_id']; ?>/<?php echo $class_id; ?>" class="">
                                                                <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                            </a></li>
                                                        </ul>
                                                       
                                                       
                                                       
                                                     
                                                           
                                                        <?php } ?>
                                                        </div>      
                                                 
                                                                            <?php    }    }  ?>
										</td>
                                        
                                                                                      
                                    </tr>
                 
                         	<?php endforeach; ?>
						</tbody>
						<tr>
                            <td colspan="10" style="text-align: center;">
							<button type="submit" class="btn btn-normal btn-gray "> Submit </button></td>
                        </tr>
                  </table>
			</form>
            
            <?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</body>
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
  
}
                
                
</script>
</html>

