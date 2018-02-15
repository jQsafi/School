
						<div class="box-content padded textarea-problem">
					            <!----TABLE LISTING STARTS--->
					            <div class="tab-pane active" id="list">
									<center>
					                <?php echo form_open('progress_card/progresscard/'.$type);?>
					                <table border="0" cellspacing="0" cellpadding="0" class="table">
					                	<tr>
											<td><?php echo translate('select_exam');?></td>
					                        <td><?php echo translate('Grade');?></td>
					                        <td>&nbsp;</td>
					                	</tr>
					                	<tr>
					                        <td>
												<input type="text" name="class_id" value="<?=$class_id?>">
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
					                
					                
					                <?php if(isset($this->input->post())):?>
					                <?php 
					                     
					                    $this->db->select('student.name,student_id,student.roll,student.group,student.passing_year, student.section, student.student_unique_ID,student.fourth_id,student.class_id');
					                    $this->db->from('student');
					                    $this->db->where('student.class_id', $class_id);
										$this->db->where('student.student_id', $this->session->userdata('student_id'));
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