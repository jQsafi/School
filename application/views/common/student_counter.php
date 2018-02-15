<div class="row-fluid">
        <div class="span30">
            <!-- find me in partials/action_nav_normal -->
            <!--big normal buttons--> 			
      
            <center>
                <span class="label label-blue hover-shadow dog3"  data-corner="20px"> 
                    <img src="template/images/icons/user.png" /> <span><?=translate('total_students','capitalize')?> &nbsp;<?php echo $this->db->count_all_results('student'); ?> </span>
                </span>

                <span class="label label-blue hover-shadow dog3"  data-corner="20px"> 
                    <img src="template/images/icons/user.png" /> <span><?=translate('active_students','capitalize')?> &nbsp;<?php echo $active=get_single_value('count(student_id)','student',array('status'=>'1')); ?> </span>
                </span>
				<span class="label label-blue hover-shadow dog3"  data-corner="20px"> 
                    <img src="template/images/icons/user.png" /> <span><?=translate('inactive_students','capitalize')?> &nbsp;<?php echo $active=get_single_value('count(student_id)','student',array('status'=>'0')); ?> </span>
                </span>
            </center>
			
            <?php
     $classes = $this->db->get('class')->result_array();    
         ?>
	<div class="box box-border">
	<table id="source2" class="table table-hover table-condenced" style="background-color: white;" >
		<caption><?php echo translate('student information'); ?></caption>
		<thead>
			<tr>
				<th><?php echo translate('class'); ?></th>
				<th><?php echo translate('boys'); ?></th>
				<th><?php echo translate('girls'); ?></th>
				<th>Total</th>	
				
			</tr>
		</thead>
		<tbody>
                    
                  <?php  foreach ($classes as $row){  ?>  
                    
               <tr>
				<th><?php  echo $row['name']; ?></th>
				<td><?php echo count($this->db->get_where('student', array('class_id' =>  $row['class_id'],'sex' =>'male'))->result_array()); ?></td>
				<td><?php echo count($this->db->get_where('student', array('class_id' => $row['class_id'],'sex' =>'female'))->result_array()); ?></td>
				<td><?php echo count($this->db->get_where('student', array('class_id' => $row['class_id']))->result_array()); ?></td>
			</tr>           
		
              <?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Total</th>
				<td><?php echo count($this->db->get_where('student', array('sex' =>'male'))->result_array()); ?></td>
				<td><?php echo count($this->db->get_where('student', array('sex' =>'female'))->result_array()); ?></td>
				<td><?php echo count($this->db->get_where('student')->result_array()); ?></td>
			</tr>
		</tfoot>
	</table>
	</div>
	<div id="target2">
	</div>
	
	<table  class="table" style="background-color: white;">
		<caption><?php echo translate('Collection History'); ?></caption>
		<thead>
			<tr>
				<th>Class</th>
				
				<th><?php echo translate('Today Collection'); ?></th>
				<th><?php echo translate('Collection of this month'); ?></th>
				<th><?php echo translate('Collection'); ?></th>
			</tr>
		</thead>
		<tbody>
                    
                  <?php
				  $total_today_collection=0;
				  $total_tomonth_collection=0;
				  $total_today_collection=0; 
				  foreach ($classes as $row)
				  {
				  $this->db->select('sum(total_collection) as total_collection,class_id');
				  $this->db->from('invoice');
				  $this->db->join('student','invoice.student_id=student.student_id','left');
				  $this->db->where('class_id',$row['class_id']);
				  $invoice=$this->db->get();
				  foreach ($invoice->result() as $inv)
				  {
				  	$class_name=get_single_value('name','class',array('class_id'=>$row['class_id']));
					$collection=$inv->total_collection;
					if(!$collection)
					$collection=0;
					$total_collection+=$collection;
					$today=date("Y-m-d");
					$this->db->like('payment_date',$today,'both');
					$this->db->where('class_id',$row['class_id']);
					$this->db->from('invoice');
					$this->db->select('sum(total_collection) as total_collection');
					$this->db->join('student','invoice.student_id=student.student_id','left');
					$tc=$this->db->get();
					foreach ($tc->result() as $c)
				  	{
						$today_collection=$c->total_collection;
						$total_today_collection+=$today_collection;
					}
					$tomonth=date("Y-m");
					$this->db->like('payment_date',$tomonth,'both');
					$this->db->where('class_id',$row['class_id']);
					$this->db->from('invoice');
					$this->db->select('sum(total_collection) as total_collection');
					$this->db->join('student','invoice.student_id=student.student_id','left');
					$tc=$this->db->get();
					foreach ($tc->result() as $c)
				  	{
						$tomonth_collection=$c->total_collection;
						$total_tomonth_collection+=$tomonth_collection;
					}
				  ?>  
                    
             <tr>
				<td><?php echo $class_name; ?></td>				
				<td><?=$today_collection?></td>
				<td><?=$tomonth_collection?></td>
				<td><?php echo $collection; ?></td>
			</tr>           
		
               <?php 
			   } }
			   ?>
		</tbody>
		<tfoot>
			<tr>
				<th><?=translate('total')?></th>				
				<td><?=$total_today_collection?></td>
				<td><?=$total_tomonth_collection?></td>
				<td><?=$total_collection?></td>
			</tr>
		</tfoot>
	</table>
<script type="text/javascript">
	$(function() {
		$('#source2').tableBarChart('#target2', '', true);
	});
</script>    
            
            
      
            
        </div>
        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>