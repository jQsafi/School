
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Manage TC');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/transfar_certificate');?>
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
						<input type="submit" value="<?php echo translate('manage_testimonial');?>" class="btn btn-normal btn-gray" />
						</td>
                	</tr>
					<tr>
					</tr>
                </table>
                </form>
                </center>
                
                
                <br /><br />
                
                
                <?php if($class_id >0):?>
                <?php 
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
							echo form_open('admin/transfar_certificate'); 
							
							?>
       Granted All<input type="checkbox" id="testimonialall">         
                <table class="table tablesorter">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo translate('ID');?></th>
							<th><?php echo translate('Roll');?></th>
                            <th><?php echo translate('name');?></th>
                                                        <th>
								<?php echo translate('TC information');?>
							</th>
                                                    
                                   
                        </tr>
					</thead>
					<tbody>
						<input type="hidden"  value="<?php echo $class_id;?>" name="class_id">
						<input type="hidden"  value="<?php echo $group_id;?>" name="group_id">
						<input type="hidden"  value="<?php echo $exam_id;?>" name="exam_id">
                                                <input type="hidden"  value="<?php echo $year;?>" name="year">
						<input type="hidden"  value="update" name="operation">
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
							
                                                                                <td>
                                    class to which he/she was admitted     
                                    <input type="text" placeholder="Enter First class example:5[Five]" style="width:290px" name="admitted_class<?php echo $student_id;?>" > </br>
                                 Last day of attendance in this school
                                 <input type="text" placeholder="Enter Date" style="width:290px" class="datepicker fill-up" name="last_day_attends<?php echo $student_id;?>" > </br>
                                 Result At the end of Academic year
                                 <textarea name="result_<?php echo $student_id;?>" style="width:298px" rows="2" cols="50" placeholder="Example:Passed and Promoted to class 8[eight] for the academic year 2015-2016 with GPA 5"></textarea></br>

                                 Obserbation if Any
                            
             <textarea name="obserbation_<?php echo $student_id;?>" style="width:298px" rows="2" cols="50" placeholder="Enter Obserbations"></textarea></br>
                                         </textarea> </br>
                                 Date of leaving
                                 <input type="text" placeholder="Enter Date" style="width:298px" class="datepicker fill-up" name="leavingdate_<?php echo $student_id;?>" >


										</td>
                                                                                <td>
                                                                                           <input type="checkbox" class="testimonial" name="TC[]" value="<?php echo $student_id;?>"/>                
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
<script>
    $(".testimonialinfo").keyup(function()
	{
		if($("#same").is(':checked'))
		{
			var cv=$(this).val();
			$(".testimonialinfo").val(cv);
		}
	});
     $('#testimonialall').change(function(event) {  //on click
        if(this.checked) { // check select status
            $('.testimonial').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.testimonial').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }   
        
   
});
                
                
</script>

