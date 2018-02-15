<style type="text/css">
	.container {
		width: 3000px;
	}
	
	.exam-wraper {
		float: left;
                background: #fff;
	}
	
	.number-total {
		background-color: #8cff38;
		font-weight: bold;
	}
	
	.result-card {
		border-collapse: collapse;
		border-spacing: 0;
	}
	
	.total-row {
		background-color: #ffbebe;
	}
	
	.hm-row {
		background-color: #a3fff8;
	}
	
	.gpa-row {
		background-color: #bcb0ff;
	}
	
	.lgp-row {
		background-color: #ffffb0;
	}
	
	.result-card table,
	td,
	th {
		font-size: 12px;
                text-align: center;
	}
	
	.number-input-header td {
		writing-mode: tb-rl;
		-webkit-transform: rotate(-90deg);
		-moz-transform: rotate(-90deg);
		-o-transform: rotate(-90deg);
		-ms-transform: rotate(-90deg);
		height: 80px;
	}
	
	.result-card td {
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
	}
	
	.result-card th {
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
	}
	
	.result-card .result-card-054q,
	.result-card-s6z2 {
		text-align: center
	}
	
	.result-card .result-card-0ord {
		text-align: right
	}
        
        tbody{ float: left;}
</style>
 
            <!----TABLE LISTING STARTS--->
                <?php if($class_id >0  ):?>
                <?php 
                    
                    $this->db->select('*');
                    $this->db->from('marksheet');
                    $this->db->where('marksheet.class_id', $class_id);	
                    $this->db->where('marksheet.student_id', $student_id);	
                    $this->db->order_by('marksheet.exam_id', 'ASC');
                    $query_result = $this->db->get();
                    $count_exam = $query_result->result();
                    $countt_exam_result = array();

                    foreach ($count_exam as $item_conut){
                            $count_exam = count($countt_exam_result[$item_conut->exam_id]);
                            $countt_exam_result[$item_conut->exam_id][$count_exam] = $item_conut;
                    }
		?>
                 
            <div class="exam-wraper">
		<table class="result-card">
                    <?php
                    
                        $ms = 0;
                        $main_exam_switch = 0;
                        foreach ( $countt_exam_result as $key => $ms_main_item):
                            $this->db->select('name');
                            $this->db->from('exam');
                            $this->db->where('exam.exam_id', $key);	
                                
                            $main_exam_name =$this->db->get();
                            $main_exam_name = $main_exam_name->row();
                            ?>
                    <tbody class="pullLeft">
                            <tr>
                                <?php 
                                echo ($ms == 0) ? "<th rowspan='3'>Subject Name</th>" : '';
                                
                                foreach ($ms_main_item as $item_sub_exam):
                                
                                $this->db->select('mark.*, student.name, student.roll, student.group, student.passing_year, student.section, exam.name as examname, class.name as classmname, subject.name as subjectname ');
                                $this->db->from('mark');
                                $this->db->join('student', 'mark.student_id=student.student_id', 'left');
                                $this->db->join('subject', 'mark.subject_id=subject.subject_id', 'left');
                                $this->db->join('exam', 'mark.sub_exam_id=exam.exam_id', 'left');
                                $this->db->join('class', 'mark.class_id=class.class_id', 'left');
                                $this->db->where('mark.class_id', $class_id);	
                                $this->db->where('mark.student_id', $student_id);	
                                $this->db->where('mark.exam_id', $item_sub_exam->exam_id);	
                                $this->db->where('mark.sub_exam_id', $item_sub_exam->sub_exam_id);	
                                $this->db->order_by('mark.subject_id', 'ASC');	
                                $query_result = $this->db->get();
                                $marks_total_subject = $query_result->num_rows();
                                $marks = $query_result->result();
                                
                                $this->db->select('*');
                                $this->db->from('marksheet');
                                $this->db->where('marksheet.class_id', $class_id);	
                                $this->db->where('marksheet.student_id', $student_id);	
                                $this->db->where('marksheet.exam_id', $item_sub_exam->exam_id);	
                                $this->db->where('marksheet.sub_exam_id', $item_sub_exam->sub_exam_id);	

                                $query_result = $this->db->get();
                                $marksheet = $query_result->row();
                                ?>
				
                            </tr>
			<tr class="">
                                <td colspan='10'>
                                     <?php echo $main_exam_name->name . ' ('; 
                                     
                            $this->db->select('name');
                            $this->db->from('exam');
                            $this->db->where('exam.exam_id', $item_sub_exam->sub_exam_id);	
                                
                            $sub_exam_name =$this->db->get();
                            $sub_exam_name = $sub_exam_name->row();
                             echo $sub_exam_name->name. ' )';   
                                ?></td>
				
			</tr>
			<tr class="number-input-header">
				<td>Written</td>
				<td>Objective</td>
				<td>Practical</td>
				<td>SBA</td>
				<td>Total</td>
				<td>Highest<br>Markes</td>
				<td>80%</td>
				<td>20%</td>
				<td>G.P.A</td>
				<td>Letter<br>Grade</td>
				 
			</tr>
                        
                        <?php 
                        
                        $tota_vertical = array(
                            'formation' => 0 ,
                            'objective' => 0 ,
                            'sba' => 0 ,
                            'practical' => 0 ,
                            );
                        $tota_vertical_hight = array(
                            'formation' => 0 ,
                            'objective' => 0 ,
                            'sba' => 0 ,
                            'practical' => 0 ,
                            );
                        
                            $i= 0;
                        foreach ($marks as $item):
                            $where_selector = array(
                                'mark.class_id' => $class_id,
                                'mark.subject_id' => $item->subject_id,
                                'mark.sub_exam_id' =>  $item_sub_exam->sub_exam_id
                                
                            );
                            
                            $this->db->select_max('sub_total');
                            $query_result = $this->db->get_where('mark', $where_selector);
                            $hight_mark = $query_result->row();
                            
                            $this->db->select_max('formation');
                            $query_result = $this->db->get_where('mark', $where_selector);
                            $hight_formation= $query_result->row();
                            $tota_vertical_hight['formation'] += $hight_formation->formation;
                            
                            $this->db->select_max('objective');
                            $query_result = $this->db->get_where('mark', $where_selector);
                            $hight_objective= $query_result->row();
                            $tota_vertical_hight['objective'] += $hight_objective->objective;

                            
                            
                            $this->db->select_max('practical');
                            $query_result = $this->db->get_where('mark', $where_selector);
                            $hight_practical = $query_result->row();
                            $tota_vertical_hight['practical'] += $hight_practical->practical;

                            
                            $this->db->select_max('sba');
                            $query_result = $this->db->get_where('mark', $where_selector);
                            $hight_sba = $query_result->row();
                            $tota_vertical_hight['sba'] += $hight_sba->sba;
                            ?>
                        <tr>
                                <?php if ($ms == 0){ ?><td><?php echo $item->subjectname;?></td> <?php }?>
				<td><?php echo $item->formation;
                                $tota_vertical['formation'] += $item->formation;
                                
                                ?></td>
				<td><?php echo $item->objective;
                                $tota_vertical['objective'] += $item->objective;
                                ?></td>
				<td><?php echo $item->practical;
                                 $tota_vertical['practical'] += $item->practical;
                                ?></td>
				<td><?php echo $item->sba;
                                 $tota_vertical['sba'] += $item->sba;
                                ?></td>
				<td><?php echo  $sub_total =  $item->formation + $item->objective  + $item->practical + $item->sba; ?></td>
				<td><?php echo $hight_mark->sub_total;?></td>
				<td><?php echo $sub_total*80/100;?></td>
				<td><?php echo $sub_total*20/100;?></td>
                                <?php if($i==0):?>
				<td rowspan="<?php 
                                    $this->db->select('mark_id');
                                    $this->db->from('mark');
                                    $this->db->where('class_id', $class_id);	
                                    $this->db->where('student_id', $student_id);
                                    $this->db->where('exam_id', $item_sub_exam->exam_id);	
                                    $this->db->where('sub_exam_id', $item_sub_exam->sub_exam_id);	
                                
                                    $num_of_sub =$this->db->get();
                                     echo $num_of_sub->num_rows();
                                
                                ?>"><?php echo $marksheet->gpa; ?></td>
				<td rowspan="<?php  echo $num_of_sub->num_rows();?>" ><?php $latterGrad = $marksheet->total/$marks_total_subject ; $latterGrad =  $latterGrad /20;
                               echo number_format((float)$latterGrad, 2, '.', ''); 
                                ?></td>
                                <?php endif; $i++;?>
				<?php if ($ms == 0){ ?>
<!--				<td rowspan="9"></td>
				<td rowspan="9"></td>
				<td rowspan="9"></td>-->
                                <?php }?>
			</tr>
                        <?php endforeach;?>
			
			<tr class="total-row">
                                <?php if ($ms == 0){ ?><td>Total</td> <?php }?>
				<td><?php echo  $tota_vertical['formation'] ?></td>
				<td><?php echo  $tota_vertical['objective'] ?></td>
				<td><?php echo  $tota_vertical['practical'] ?></td>
				<td><?php echo  $tota_vertical['sba'] ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr class="hm-row">
                                <?php if ($ms == 0){ ?><td>Highest Markes</td> <?php } ?>
				<td><?php echo $tota_vertical_hight['formation'];?></td>
				<td><?php echo $tota_vertical_hight['objective'];?></td>
				<td><?php echo $tota_vertical_hight['practical'];?></td>
				<td><?php echo $tota_vertical_hight['sba'];?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			 
			<tr>
                                <?php if ($ms == 0){ ?><td>Merit</td><?php } ?>
				<td colspan="7" style="padding: 8.5px 0px;"></td>
				<td colspan="3"></td>
			</tr>
		</tbody>
                   <?php $ms++; endforeach;  endforeach;?>
                
                </table>
	</div>                         
            
            <?php  endif;?>
             