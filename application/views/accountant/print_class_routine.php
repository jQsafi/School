
<link href="<?php echo base_url();?>template/css/bootstrap-datetimepicker.min.css" media="screen" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>template/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

                                              <?php if($class_id=='all')
											  { 
											/*  if($class_id!='all')
											  $this->db->where('class_id',$class_id);*/
					                   $classes = $this->db->get('class')->result_array();
					                    foreach($classes as $row):
						                                  ?>		
						<h4 align="center"><strong> Class Routine for <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?>  </strong> </h4>

                                    <div class="accordion-inner">
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-normal">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                if($d==1)$day='saturday';
                                                else if($d==2)$day='sunday';
                                                else if($d==3)$day='monday';
                                                else if($d==4)$day='tuesday';
                                                else if($d==5)$day='wednesday';
                                                else if($d==6)$day='thursday';
                                                else if($d==7)$day='friday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $row['class_id']);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                            	<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?> by
																<?php 
																$techer_id = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->teacher_id;
                                                                echo $this->db->get_where('teacher', array('teacher_id' => $techer_id))->row()->name;			
																?>
																<?php echo '<br>'.'Start-'.$row2['time_start'].' End-'.$row2['time_end'].'';?>
                                                            	
                                                            </button>
												
														</div>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
                                        
                                    </div>

						<?php endforeach;?> 
											  <?php  }
											 else{
											 	
											 	?>
 <h4 align="center"><strong> Class Routine for <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?>  </strong> </h4>

                                    <div class="accordion-inner">
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-normal">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                if($d==1)$day='saturday';
                                                else if($d==2)$day='sunday';
                                                else if($d==3)$day='monday';
                                                else if($d==4)$day='tuesday';
                                                else if($d==5)$day='wednesday';
                                                else if($d==6)$day='thursday';
                                                else if($d==7)$day='friday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $class_id);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
														<div class="btn-group">
															<button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                            	<?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?> by
																<?php 
																$techer_id = $this->db->get_where('subject', array('subject_id' => $row2['subject_id']))->row()->teacher_id;
                                                                echo $this->db->get_where('teacher', array('teacher_id' => $techer_id))->row()->name;			
																?>
																<?php echo '<br>'.'Start-'.$row2['time_start'].' End-'.$row2['time_end'].'';?>
                                                            	
                                                            </button>
													
														</div>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
                                        
                                    </div>
									
									<?php  } ?>
      