<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#backup" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('backup');?>
                    	</a></li>
			<li class="">
            	<a href="#restore" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('restore');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">            
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active span7" id="backup">
				<center>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-normal" >
                    <tbody> 
                        
                        
                        
                <!--        <?php 
						for($i = 1; $i<= 28; $i++):
						
							if($i	==	1)	$type	=	'teacher';
							else if($i	==	2)$type	=	'class';
							else if($i	==	3)$type	=	'subject';
							else if($i	==	4)$type	=	'student';
							else if($i	==	5)$type	=	'parent';
							else if($i	==	6)$type	=	'class_routine';
							else if($i	==	7)$type	=	'studentattendance';
							else if($i	==	8)$type	=	'exam';
							else if($i	==	9)$type	=	'grade';
							else if($i	==	10)$type=	'mark';
							else if($i	==	11)$type=	'marksheet';
							else if($i	==	12)$type=	'overallmarksheet';
							else if($i	==	13)$type=	'noticeboard';
							else if($i	==	14)$type=	'fees_name';
                                                        else if($i	==	15)$type	=	'fees_setup';
							else if($i	==	16)$type	=	'expense';
							else if($i	==	17)$type	=	'income';
							else if($i	==	18)$type	=	'invoice';
							else if($i	==	19)$type	=	'csalary';
							else if($i	==	20)$type	=	'salarysetup';
							else if($i	==	21)$type	=	'month';
							else if($i	==	22)$type	=	'book';
							else if($i	==	23)$type=	'dormitory';
							else if($i	==	24)$type=	'noticeboard';
							else if($i	==	25)$type=	'religion';
							else if($i	==	26)$type=	'settings';
							else if($i	==	27)$type=	'transport';
							else if($i	==	28)$type=	'all';
							?>
							<tr>
								<td><?php echo translate($type);?></td>
								<td align="center">
									<a href="<?php echo base_url();?>index.php?accountant/backup_restore/create/<?php echo $type;?>" 
										class="btn btn-gray" rel="tooltip" data-original-title="download backup"><i class="icon-download-alt" ></i>
											Download Backup</a>
								
								</td>
							</tr>
							<?php 
						endfor;
						?>-->
                        
                        
                        
                        
                        
                        <?php $dbs = $this->db->list_tables();
                        foreach ($dbs as $type){
                            ?>
                        							<tr>
								<td><?php echo translate($type);?></td>
								<td align="center">
									<a href="<?php echo base_url();?>index.php?accountant/backup_restore/create/<?php echo $type;?>" 
										class="btn btn-gray" rel="tooltip" data-original-title="download backup"><i class="icon-download-alt" ></i>
											<?=translate('download_backup')?></a>
									<!--<a href="<?php echo base_url();?>index.php?accountant/backup_restore/delete/<?php echo $type;?>" 
										class="btn btn-red" rel="tooltip" data-original-title="delete data" onclick="return confirm('delete confirm?');"><i class="icon-trash"></i>
											Delete Backup</a>-->
								</td>
							</tr>
                        <?php
 
                                              }
                        ?>
                                                      <tr>
								<td><?php echo translate('ALL');?></td>
								<td align="center">
									<a href="<?php echo base_url();?>index.php?accountant/backup_restore/create/all" 
										class="btn btn-gray" rel="tooltip" data-original-title="download backup"><i class="icon-download-alt" ></i>
											Download Backup</a>
									<!--<a href="<?php echo base_url();?>index.php?accountant/backup_restore/delete/all" 
										class="btn btn-red" rel="tooltip" data-original-title="delete data" onclick="return confirm('delete confirm?');"><i class="icon-trash"></i>
											Delete Backup</a>-->
								</td>
							</tr>            
                    	
                    </tbody>
                </table>
                </center>
			</div>
            <!----TABLE LISTING ENDS--->
            
            <!----RESTORE--->
            <div class="tab-pane box  span6" id="restore">
				<?php echo form_open('accountant/backup_restore/restore' , array('enctype' => 'multipart/form-data'));?>
                    <input name="userfile" type="file" />
                    <br /><br />
                    <center><button type="submit" class="btn btn-blue"><?=translate('upload_&_restore_from_backup')?></button></center>
                    <br />
                </form>
			</div>
            <!----RESTORE ENDS--->
		</div>
	</div>
</div>