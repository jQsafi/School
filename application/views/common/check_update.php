<div class="row-fluid">
        
			
            <?php
     $updates = $this->db->get('update')->result_array();    
         ?>
	
	<table id="source2" class="table table-normal" style="background-color: white;" >
		<caption><?php echo translate('available_updates'); ?></caption>
		<tbody>
                    
                  <?php  foreach ($updates as $row)
				  {  ?>  
                    
                       <tr>
							<th><?php  echo $row['remark']; ?></th>
						</tr>           
		
                  <?php } ?>
		</tbody>
		<tfoot>
			<th align="center">
				<a href="#" class="btn btn-large btn-gray"><?=translate('apply_update')?></a>
			</th>
		</tfoot>
	</table>
	<div id="target2">
	</div>
</br>
            
            
      
            
        </div>
        <!---DASHBOARD MENU BAR ENDS HERE-->
    </div>