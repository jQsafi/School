<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
		<link rel="shortcut icon" href="<?=base_url()?>images/wemax_edu.ico" type="image/x-icon" />
		<link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css" />
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">-->
        <link href="<?php echo base_url();?>template/css/schoolsoft.css" media="screen" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
        <script src="<?php echo base_url();?>template/js/html5shiv.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/excanvas.js" type="text/javascript"></script>
        <![endif]-->
        <script src="<?php echo base_url();?>template/js/ekattor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url();?>template/js/sp8.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/sp-8-form-validation.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>


    <body style="padding:10px">
<div class="box box-border" id="main_body">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('manage_attendance_mark');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded textarea-problem">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane active" id="list">
                
                <br /><br />
                <table class="table">
					<tr>
						<th>
							Class: &nbsp;<?=get_single_value('name','class',array('class_id'=>$class_id))?>
						</th>
						<th>
							Exam Name: &nbsp;<?=get_single_value('name','exam',array('exam_id'=>$exam_id))?>
						</th>
						<th>
							Sub-Exam Name: &nbsp;<?=get_single_value('name','exam',array('exam_id'=>$sub_exam_id))?>
						</th>
					</tr>
				</table>
                            <?php echo form_open('admin/manage_attendance/'.$class_id.'/'.$exam_id.'/'.$sub_exam_id); ?>
							<input  type="hidden" name="action" value="save"/>
                
                <table class="table table-normal box tablesorter">
                    <thead>
                        <tr>
							<td><?=translate('roll')?></td>
                            <td><?=translate('student_name')?></td>
                            <td><?php echo translate('attendance');?></td>
                            <td><?php echo translate('classday');?></td>
                            <td><?php echo translate('home_work');?></td>
							<td><?=translate("Guardian's_care")?></td>
							<td><?php echo translate('Attention for Leassion');?></td>
							<td><?php echo translate('Behavior');?></td>
                        </tr>
					</thead>
					<tbody>
                            <?php
							
							if($group_name)
								$students = $this->db->get_where('student', array('class_id' => $class_id,'group' => $group_name))->result_array();
								else
								$students = $this->db->where(array('class_id' => $class_id))->order_by('roll')->get('student')->result_array();
						
                            $i=0;
                            foreach ($students as $row):

                                $verify_data = array(
									'exam_id' => $exam_id,
                                    'class_id' => $class_id,
                                    'sub_exam_id' => $sub_exam_id , 
                                    'student_id' => $row['student_id']);
									$attend=get_single_value('attend','attendance_mark',$verify_data);
									$classday=get_single_value('classday','attendance_mark',$verify_data);
									$homework=get_single_value('homework','attendance_mark',$verify_data);
									$gardian_care=get_single_value('gardian_care','attendance_mark',$verify_data);
									$attention=get_single_value('attention','attendance_mark',$verify_data);
									$behave=get_single_value('behave','attendance_mark',$verify_data);
									if($attend=='-')
									$attend='';
									if($class_day=='-')
									$class_day='';
									if($comment=='-')
									$comment='';
                                    ?>
                                    <tr>
										<td>
                                            <?php echo $row['roll']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
											<input type="hidden" value="<?=$row['student_id']?>" name="student_id[]"  />
                                        </td>
                                        <td>
                                            <input type="text" value="<?=$attend?>" name="attend[]"  />
                                        </td>
                                        <td>
                                            <input type="text" value="<?=$classday?>" name="classday[]"  />
                                        </td>
                                        <td>
											<input type="text" value="<?=$homework?>" name="homework[]"  />
                                        </td>
										<td>
											<input type="text" value="<?=$gardian_care?>" name="gardian_care[]"  />
                                        </td>
										<td>
											<input type="text" value="<?=$attention?>" name="attention[]"  />
                                        </td>
										<td>
											<input type="text" value="<?=$behave?>" name="behave[]"  />
                                        </td>
                                      
                                    </tr>
                                    
                                    <?php  endforeach;$i++;?>
                                    
                                    
                         	<?php //endforeach; ?>
                        <tr>
                            <td colspan="10" style="text-align: center;">
							 <input type="hidden" value="<?=count($students)?>" name="total"  />
							<button type="submit" class="btn btn-normal btn-gray "> Update Marks </button>
							</td>
                        </tr>
						</tbody>
                  </table>
                                    
                                    </form>
			</div>
            <!----TABLE LISTING ENDS--->
            
		</div>
	</div>
</body>
</html>