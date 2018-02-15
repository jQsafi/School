<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		
        <?php
		$this->load->view("includes");
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		
		$system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
		?>
		<title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>

                    <script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
					<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
    <body>
	<?php
	$this->load->view('context_menu');
	?>
        <div id="main_body">
            <div class="main-content" style="margin-left: 0;">
                <?php $this->load->view('page_info'); ?>
                <div class="container-fluid padded">
					<div class="box box-border">
						<div class="box-header">
					    
					    	<!------CONTROL TABS START------->
							<ul class="nav nav-tabs nav-tabs-left">
								<li class="active">
					            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
										<?=translate('progress_card')?>
					                    	</a></li>
							</ul>
					    	<!------CONTROL TABS END------->
					        
						</div>
						<div class="box-content padded textarea-problem">
					            <!----TABLE LISTING STARTS--->
					            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
									<center>
					                <?php echo form_open('progress_card/progresscard/'.$type);?>
					                <table border="0" cellspacing="0" cellpadding="0" class="table">
					                	<tr>
					                        <td><?php echo translate('select_class');?></td>
											<td><?php echo translate('select_exam');?></td>
					                        <td><?php echo translate('Grade');?></td>
					                        <td>&nbsp;</td>
					                	</tr>
					                	<tr>
					                        <td>
					                        	<select name="class_id" class="combobox" required="">
					                                <option value=""><?php echo translate('select_a_class');?></option>
					                                <?php 
					                                $classes = $this->db->get('class')->result_array();
					                                foreach($classes as $row):
					                                ?>
					                                    <option value="<?php echo $row['class_id'];?>"
					                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>Class <?php echo $row['name'];?></option>
					                                <?php
					                                endforeach;
					                                ?>
					                            </select>
					                        </td>
											<td>
					                            <select name="exam_id" class="combobox"  style="float:left;">
												<option value=""><?php echo translate('select_exam'); ?></option>
												<?php
													 $exams = $this->db->where('parent_id','0')->from('exam')->get()->result_array();
					                                foreach($exams as $row):
					                                ?>
													<optgroup label="<?=$row['name']?>">
					                                    <option value="<?php echo $row['exam_id'];?>"
					                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>><?=$row['name']?></option>
																<?php
																$sub_exams = $this->db->where('parent_id',$row['exam_id'])->from('exam')->get()->result_array();
																foreach($sub_exams as $srow):
					                                ?>
					                                    <option value="<?php echo $srow['exam_id'];?>"
					                                        <?php if($exam_id == $srow['exam_id'])echo 'selected';?>><?=$srow['name']?></option>
					                                <?php
																?>
																<?php
																endforeach;
																?>
														</optgroup>
					                                <?php
					                                endforeach;
												?>
												</select>
											</td>
					                         <td>
					                            <select name="grade" class="combobox"  style="float:left;">
					                                <option value=""><?php echo translate('Select Grade'); ?></option>
					                                <?php
													$grade=$this->input->post('grade');
													if(!$grade)
													$grade='';
													echo make_select('grade','name','name',$grade,'grade_point','desc');
													?>
					                            </select>
					                        </td>
					                        
					                        
					                        
					                        <td> 
					                        	<input type="hidden" name="operation" value="selection" />
					                    		<!--<input type="submit" value="Submit" class="btn btn-normal btn-gray" />-->
												<button type="submit" class="btn btn-normal btn-gray">
													<?=translate('submit')?>
												</button>
					                        </td>
					                	</tr>
					                </table>
					                </form>
					                </center>
					                
					                
					                <br /><br />
					                
					                
					                <?php if(isset($class_id) and $class_id >0):?>
					                <?php 
					                     
					                    $this->db->select('student.name,student_id,student.roll,student.group,student.passing_year, student.section, student.student_unique_ID,student.fourth_id,student.class_id');
					                    $this->db->from('student');
					                    $this->db->where('student.class_id', $class_id);
										$this->db->order_by('roll');
					                    $query_result = $this->db->get();
							?>
					                <?php echo form_open('progress_card/progresscard_print_all/'.$type,array('target'=>'_blank'));?>
									<input type="hidden" value="<?=$class_id?>" name="class_id"/>
									<input type="hidden" value="<?=$exam_id?>" name="exam_id"/>
									<input type="hidden" value="<?=$type?>" name="type"/>
					                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover tablesorter">
					                    <thead>
					                        <tr>
												<th class="{sorter: false}">
												<input type="checkbox" class="check_all" id="check_all" style="width:0px;overflow:visible;"/></th>
												<th><?=translate('#')?></th>
					                            <th><?=translate('ID')?></th>
												<th><?=translate('roll')?></th>
					                            <th><?=translate('name')?></th>
					                            <th><?=translate('group')?></th>
					                            <th><?=translate('section')?></th>
												<th><?=translate('exam')?></th>
												<th><?=translate('total_obtain_mark')?></th>
					                            <th><?=translate('highestmark')?></th>
												<th><?=translate('merit_list')?></th>
					                            <th><?=translate('GPA')?></th>
												<th><?=translate('letter_grade')?></th>
					                        </tr>
					                    </thead>
										<tbody>
					                        <?php 
											$sl=0;
											foreach ($query_result->result() as $item ):
												$sl++;
												$this->load->helper('mark_sheet');
												$student_id=$item->student_id;
												$class_id=$item->class_id;
												$exam_link='all';
												if($exam_id)
												{
													$exam_name=get_single_value('name','exam',array('exam_id'=>$exam_id));
													$parent_id=get_single_value('parent_id','exam',array('exam_id'=>$exam_id));
													if($parent_id):
													$highest_mark=get_single_value('total_mark','exam_result',array('exam_id'=>$parent_id,'sub_exam_id'=>$exam_id,'class_id'=>$class_id,'merit_position'=>'1'));
													$this->db->where('exam_id',$parent_id);
													$this->db->where('sub_exam_id',$exam_id);
													else:
													$highest_mark=get_single_value('total_mark','exam_result',array('exam_id'=>$exam_id,'class_id'=>$class_id,'merit_position'=>'1'));
													$this->db->where('exam_id',$exam_id);
													endif;
													$exam_link=$exam_id;
												}
												else if(!$exam_id)
												{
													$exam_name='All Exam';
													$highest_mark=get_single_value('total_mark','exam_result',array('class_id'=>$class_id,'merit_position'=>'1'));
												}
												$this->db->where('class_id',$class_id);
												$this->db->where('student_id',$student_id);
												
												$exam_result=$this->db->from('exam_result')->get()->result();
												
												$total_mark='-';
												$gpa='-';
												$grade='-';
												$merit_position='-';
												foreach($exam_result as $res)
												{
													$total_mark=$res->total_mark;
													$gpa=$res->gpa;
													$grade=$res->grade;
													$merit_position=$res->merit_position;
													if(!$merit_position) $merit_position="X";
													$merit_position=number_to_word($merit_position);
												}
												$link=site_url('progress_card/details/'.$type.'/'.$student_id.'/'.$exam_link.'/'.$class_id);
											?>
					                    
					                        <tr>
												<td>
													<input type="checkbox" name="student_id[]" style="width: 0px;overflow:visible;" value="<?=$student_id?>" class="check"/>
												</td>
												<td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>">
													<?=$sl?>
												</td>
					                            <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>">
													<?=$item->student_unique_ID;?>
												</td>
												<td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>">
													<?=$item->roll;?>
												</td>
					                            <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>">
													<?=$item->name;?>
												</td>
					                           <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>">
											   <?php if($item->group) echo get_single_value('group_name','group',array('group_id'=>$item->group));?></td>
											   <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $item->section;?></td>
											   <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $exam_name;?></td>
					                           <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $total_mark;?></td>
					                           <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $highest_mark;?></td>
											   <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $merit_position;?></td>
											   <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $gpa; ?></td>
					                           <td href="<?php echo $link;?>"  window="new" win_height="816px" win_width="1200px" title="<?=$link?>"><?php echo $grade;?></td>
					                        </tr>
					                        <?php 
											endforeach;?>
					                        </tbody>
											<tfoot>
												<tr>
													<th>
														<input type="checkbox" class="check_all" style="width:0px;overflow:visible;"/>
													</th>
													<th colspan="13">
														<button class="btn btn-gray" type="submit">
															<?=translate('print')?>
														</button>
													</th>
												</tr>
											</tfoot>
					                  </table>
					                                            
					            
					            <?php  endif;?>
								</div>
								<div>
					                    <a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
					                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
					                    </a>
					                    <a data-toggle="modal" href="#" onClick ="$('#export').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
					                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
					                    </a>
					                </div>
					            <!----TABLE LISTING ENDS--->
					            
							</div>
						</div>
					</div>
                </div>       
                <?php $this->load->view('footer'); ?>
            </div>
        </div>
    </body>
</html>