<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('exam_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo translate('add_exam');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo translate('exam_name');?></div></th>
                    		<th><div><?php echo translate('exam_starting_date');?></div></th>
                    		<th><div><?php echo translate('publishing_date');?></div></th>
                    		<th><div><?php echo translate('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($exams as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['date'];?></td>
							<td><?php echo $row['publishing_date'];?></td>
							<td align="center">
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_exam',<?php echo $row['exam_id'];?>)" class="btn btn-gray btn-small">
                                		<i class="icon-wrench"></i> <?php echo translate('edit');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $row['exam_id'];?>')" class="btn btn-red btn-small">
                                		<i class="icon-trash"></i> <?php echo translate('delete');?>
                                </a>
        					</td>
                        </tr>
						<?php
						$subexam=$this->db->where('parent_id',$row['exam_id'])->from('exam')->get()->result_array();
						foreach($subexam as $exam)
						{
							?>
								<tr class="sub-exam">
		                            <td><?php echo $count++;?></td>
									<td><?php echo $exam['name'];?>(Sub Exam of <?php echo $row['name'];?>)</td>
									<td><?php echo $exam['date'];?></td>
									<td><?php echo $exam['publishing_date'];?></td>
									<td align="center">
		                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_exam',<?php echo $exam['exam_id'];?>)" class="btn btn-gray btn-small">
		                                		<i class="icon-wrench"></i> <?php echo translate('edit');?>
		                                </a>
		                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/exam/delete/<?php echo $exam['exam_id'];?>')" class="btn btn-red btn-small">
		                                		<i class="icon-trash"></i> <?php echo translate('delete');?>
		                                </a>
		        					</td>
		                        </tr>
							<?php
						}
						?>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/exam/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Parent');?></label>
                                <div class="controls">
                                    <select class="validate[required]" name="parent_id">
                                        <option value="0">Main Exam</option>
                                        <?php
                                        foreach ($exams as $item):
                                            if($item['parent_id']==0){
                                                echo "<option value='{$item['exam_id']}'>{$item['name']}</option>";
                                            }
                                        endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('exam_starting_date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="date"/>
                                </div>
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('publishing_date');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="publishing_date"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('comment');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="comment"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('add_exam');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>