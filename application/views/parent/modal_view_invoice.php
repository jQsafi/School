<div class="tab-pane box active" id="edit" style="padding: 20px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        
        
        <div class="pull-left">
			<span style="font-size:20px;font-weight:100;">
				<?php echo translate('payment_to');?>
            </span>
            <br />
            <?php echo $system_name;?>
            <br />
            <?php echo $this->db->get_where('settings' , array('type'=>'address'))->row()->description;?>
        </div>
        <div class="pull-right">
			<span style="font-size:20px;font-weight:100;">
				<?php echo translate('bill_to');?>
            </span>
            <br />
				<?php echo $this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->name;?>
            <br />
            	<?php echo translate('roll');?> : 
            	<?php echo $this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->roll;?>
            <br />
            	<?php echo translate('class');?> : 
            	<?php 
				$class_id	=	$this->db->get_where('student' , array('student_id'=>$row['student_id']))->row()->class_id;
				echo $this->db->get_where('class' , array('class_id'=>$class_id))->row()->name;
				?>
        </div>
        <div style="clear:both;"></div>
        <hr />
        <table width="100%">
        	<tr style="background-color:#7087A3; color:#fff; padding:5px;">
            	<td style="padding:5px;"><?php echo translate('invoice_title');?></td>
            	<td width="30%" style="padding:5px;">
					<div class="pull-right">
						<?php echo translate('amount');?>
                    </div>
                </td>
            </tr>
        	<tr>
            	<td>
					<span style="font-size:20px;font-weight:100;">
						<?php echo $row['title'];?>
                    </span>
                    <br />
					<?php echo $row['description'];?>
                </td>
            	<td width="30%" style="padding:5px;">
					<div class="pull-right">
						<span style="font-size:20px;font-weight:100;">
							<?php echo $row['amount'];?>
                        </span>
                    </div>
                </td>
            </tr>
        	<tr>
            	<td></td>
            	<td width="30%" style="padding:5px;">
                	<div class="pull-right">
                    <hr />
                    <?php echo translate('status');?> : <?php echo $row['status'];?>
                    <br />
                    <?php echo translate('invoice_id');?> : <?php echo $row['invoice_id'];?>
                    <br />
                    <?php echo translate('date');?> : <?php echo date('m/d/Y', $row['creation_timestamp']);?>
                    </div>
                </td>
            </tr>
        </table>
<br />
<br />

        
        <?php endforeach;?>
    </div>
</div>