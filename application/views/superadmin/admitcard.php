<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Manage Admit Card');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open('admin/admit_card');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">
                	<tr>
                        <td><?php echo translate('select_class');?></td>
						<td><?php echo translate('select_group');?></td>
                        <!--<td><?php echo translate('select_fee');?></td>-->
                         <td><?php echo translate('select_year');?></td>
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
                
                
                <?php if($class_id >0 && $exam_id >=0 ):?>
                <?php 
							if($group_name)
							{
						    $students = $this->db->where(array('class_id' => $class_id,'group' => $group_name))->order_by('roll')->get('student')->result_array();
							}
							else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
							echo form_open('admin/admit_card'); 
							$fess_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fess_id));
							?>
   
                <table class="table tablesorter table-hover">
                    <thead>
                        <tr>
							<th>#</th>
							<th><?php echo translate('ID');?></th>
							<th><?php echo translate('Roll');?></th>
                            <th><?php echo translate('name');?></th>
							<th class="{sorter: false}">
								<?php echo translate('granted form');?>
							</th>
							<th class="{sorter: false}">
								<?php echo translate('granted to');?>
							</th>
							<th class="{sorter: false}">
								<input type="checkbox" id="admitcardall">&nbsp;Granted All
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
										<td>
											<input type="text" id="pppp" name="grantedform<?php echo $student_id;?>" class="datepicker grantedform input" value="<?php echo $grantedform; ?>"/>
										</td>
                                                                                <td>
											<input type="text" name="grantedto<?php echo $student_id;?>" class="datepicker grantedto input" value="<?php echo $grantedto; ?>"/>
										</td>
                                                                                <td>
                                                                                           <input type="checkbox" class="admitcard" name="admitcard[]" value="<?php echo $student_id;?>"/>                
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
   
    $(".grantedform").change(function(event)
	{
		if($("#same").is(':checked'))
		{
			var cv=$(this).val();
                        var dateAr = cv.split('/');
                        var grantedformdate = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
                        $('.grantedform').datepicker('setDate', new Date(grantedformdate));
		}
	});
        $(".grantedto").change(function(event)
	{
		if($("#same").is(':checked'))
		{
			var cv=$(this).val();
                        var dateAr = cv.split('/');
                        var grantedtodate = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
                         $('.grantedto').datepicker('setDate', new Date(grantedtodate));
		}
	});
        
 
     $('#admitcardall').change(function(event) {  //on click
        if(this.checked) { // check select status
            $('.admitcard').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.admitcard').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }   
        
   
});
                
                
</script>

