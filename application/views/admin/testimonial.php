
<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Manage Testimonial');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/testimonial');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
						<td>
							<input type="checkbox" name="same" id="same" class="checkbox" checked="true"/>
							All values are same?
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
							echo form_open('admin/testimonial'); 
							
							?>
                   <a class="btn btn-gray btn-normal dropdown-toggle" href="<?php echo base_url(); ?>index.php?admin/teglist" rel="tooltip" data-placement="right" 
                  data-original-title="" window="new" win_height="816px" win_width="1200px">Teg list</a>            
       Granted All<input type="checkbox" id="testimonialall">         
                <table class="table tablesorter">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo translate('ID');?></th>
							<th><?php echo translate('Roll');?></th>
                            <th><?php echo translate('name');?></th>
                                                        <th>
								<?php echo translate('Testimonial info');?>
							</th>
                                                    
                                   
                        </tr>
					</thead>
					<tbody>
						<input type="hidden"  value="<?php echo $class_id;?>" name="class_id">
						<input type="hidden"  value="<?php echo $group_id;?>" name="group_id">
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
                                                                                    <textarea style="width:373px" name="testimonialinfo<?php echo $student_id;?>" class="testimonialinfo" rows="4" cols="50"></textarea>
      
										</td>
                                                                                <td>
                                                                                           <input type="checkbox" class="testimonial" name="testimonial[]" value="<?php echo $student_id;?>"/>                
                                                                               </td>             
                                    </tr>
                 
                         	<?php endforeach; ?>
						</tbody>
						<tr>
                            <td colspan="10" style="text-align: center;">
							<button type="submit" class="btn btn-normal btn-gray "> <?=translate('submit')?> </button></td>
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

