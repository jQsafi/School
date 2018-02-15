<style>
     table.dataTable {
        border: 1px solid #d5d5d5;
    }
    table.dataTable thead th, table.dataTable thead th div {
        height: 45px !important;
    }
    #list label {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 0;
        min-width: 105px;
    }
    #list .control-group {
        margin-bottom: 0;
    }
    #list .controls, #list .controls select, #list .controls input select
	{
		padding:0px !important;
        display: inline-block;
		height: 30px !important;
		background-color: rgb(239, 239, 239) !important;
    }
	.select2-input,
	.select2-container,
	.select2-choice
	{
		background-color: rgb(239, 239, 239) !important;
		border: 1px solid #d5d5d5 !important;
		border-style: solid !important;
		border-width: 1px !important;
	}
</style>
<script src="<?php echo base_url();?>template/js/tableExport.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
<script>
	function select_student()
	{
		var student_class=$("#class_id").val();
		$.ajax({
		  url: "<?php echo site_url('admin/studentlist/'); ?>/"+student_class,
		  success:function(msg)
		  {
		  	$("#students").html(msg).val('').trigger('liszt:updated');
		  }
		});
	}
</script>
<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('Due Report'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------->

    </div>
    
    <div class="box-content padded textarea-problem clearfix">
        <!----TABLE LISTING STARTS--->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open(''); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('class'); ?></label>
                                <div class="controls">
                                    <select name="class_id" onchange="select_student();" id="class_id" class="">
                                        <option value="">All</option>
										<?php
											echo make_select('class','class_id','name',$_POST['class_id']);
										?>
                                    </select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('group'); ?></label>
                                <div class="controls">
                                    <select name="group">
                                        <option value="">Please select</option>
                                        <?php 
											echo make_select('group','group_id','group_name',$_POST['group']);
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('section'); ?></label>
                                <div class="controls">
                                    <select name="section" class="uniform" style="width:100%;">
											<option value=""><?=translate('section')?></option>
											<?=make_select('class_section','section_name','section_name',$_POST['section'])?>
									</select>
                                </div>
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('student'); ?></label>
                                   <select name="student_id"  class="select chzn-select" id="students">
								   <option class="" value="">All</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $students = $this->db->get('student')->result_array();
                                    foreach ($students as $row):
                                        ?>
                                        <option class="student <?php echo $row['class_id']; ?>" value="<?php echo $row['student_id']; ?>"  <?php if ($input['student_id'] == $row['student_id']) echo 'selected'; ?>>
                                            <?php if($row['student_unique_ID']) echo $row['student_unique_ID'].'-';echo $row['name'];if($row['class_id']){?>-Class-<?php echo $this->crud_model->get_class_name($row['class_id']);}if($row['roll']){?>-Roll-<?php echo $row['roll'];}?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Fees Name'); ?></label>
                                <div class="controls">
                                    <select name="fees_id" id="fees_id">
									<option class="" value="">All</option>
									<?php
										echo make_select('fees_name','fees_name_id','fee_full_name',$_POST['fees_id']);
									?>
                                </select> 
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('due'); ?></label>
								<select name="due_con" style="width: 60px;" class="input">
										<option value="=">=</option>
										<option value="<"><</option>
										<option value=">">></option>
									</select>
                                    <input style="width: 220px;" type="text" class="" name="due" value="<?php echo $_POST['due']; ?>"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="<?php echo translate('Show Report'); ?>" class="btn btn-normal btn-gray" />
                        </td>
                    </tr>
                </table>
				</center>
                </form>
            


            <br /><br />


            <?php
				if(count($_POST)):
			?>
			<?php	
				//$this->db->select('*');
				$this->db->from('fees');
				if($_POST['student_id'])
		        $this->db->where('fees.student_id', $_POST['student_id']);
				if($_POST['class_id'])
		        $this->db->where('student.class_id', $_POST['class_id']);
				if($_POST['fees_id'])
		        $this->db->where('fees.fees_id', $_POST['fees_id']);
				$this->db->join('student','student.student_id=fees.student_id');
		        $query = $this->db->get()->result_array();
				$total_amount=0;
				$total_weaver=0;
				$total_fine=0;
				$total_due=0;
                $number_of_row = count($query);
                if ($number_of_row >= 1) {
            ?>
                <table cellpadding="0" cellspacing="0" border="0" class="table tablesorter responsive" id="xincomereport">
                    <thead>
                        <tr>
                            <th><div>#</div></th>                            
                            <th><div><?php echo translate('Class'); ?></div></th>
                            <th><div><?php echo translate('ID'); ?></div></th>
                            <th><div><?php echo translate('roll'); ?></div></th>
                            <th><div><?php echo translate('name'); ?></div></th>
                            <th><div><?php echo translate('fees_name'); ?></div></th>
							<th><div><?php echo translate('Fees&nbsp;Amount'); ?></div></th>
							<th><div><?php echo translate('Paid&nbsp;Amount'); ?></div></th>
							<th><div><?php echo translate('weaver'); ?></div></th>
							<th><div><?php echo translate('due'); ?></div></th>
							<th><div><?php echo translate('fine'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 1;
                            foreach ($query as $row):
							$class_name=get_single_value('name','class',array('class_id'=>$row['class_id']));
							$fees_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$row['fees_id']));
							$paid=get_single_value('sum(collection_amount)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							if(!$paid) $paid=0;
							$weaver=get_single_value('sum(weaver)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							if(!$weaver) $weaver=0;
							$fine=get_single_value('sum(fine)','invoice_details',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							if(!$fine) $fine=0;
							$fees_amount=get_single_value('amount','fees',array('student_id'=>$row['student_id'],'fees_id'=>$row['fees_id']));
							$due=$fees_amount-($paid+$weaver);
							if(!$row['amount'] and !$paid and !$weaver and !$fine or !$due)
							continue;
							if($_POST['due_con']=='=' and $_POST['due'])
							{
								if($due!=$_POST['due'])
								continue;
							}
							if($_POST['due_con']=='>' and $_POST['due'])
							{
								if(!($due>$_POST['due']))
								continue;
							}
							if($_POST['due_con']=='<' and $_POST['due'])
							{
								
								if($due<$_POST['due'])
								continue;
							}
							 ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $class_name; ?></td>
                                <td><?php echo $row['student_unique_ID']; ?></td>
                                <td><?php echo $row['roll'];if(!$row['roll']) echo "&nbsp;&nbsp;&nbsp;&nbsp;"; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $fees_name; ?></td>
								<td><?php echo $row['amount']; ?></td>
								<td><?php echo $paid; ?></td>
								<td><?php echo $weaver; ?></td>
								<td><?php echo $due; ?></td>
								<td><?=$fine?></td>
                                    <?php 
										$total_amount+=$row['amount'];
                                        $grand_total+=$paid;
										$total_weaver+=$weaver;
										$total_fine+=$fine;
										$total_due+=$due;
                                    ?>
                            </tr>
                        <?php $count++; endforeach; ?>
                    </tbody>
					<tfoot>
					<tr>
							<td colspan="6" align="right">Total</td>
							<td><?=$total_amount?></td>
							<td><?=$grand_total?></td>
							<td><?=$total_weaver?></td>
							<td><?=$total_due?></td>
							<td><?=$total_fine?></td>
                        </tr>
					</tfoot>
                </table>
                <br />            
                <div>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomereport').tableExport({type:'excel',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download excel'); ?>
                    </a>
                    <a data-toggle="modal" href="#" onClick ="$('#xincomereport').tableExport({type:'doc',escape:'false'});" class="btn btn-blue">
                        <i class="icon-download"></i> <?php echo translate('download word'); ?>
                    </a>
                </div>

            <?php }endif;  ?>
        </div>
    </div>
</div>
<?php  die; ?>