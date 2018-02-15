

    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo translate('student_info_sheet'); ?>
                    </a>
                </li>  
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <script>
                        $(document).ready(function() 
						{
							<?php
							if(!$class_id)
							{
								?>
								function ask()
                            {
                                Growl.info({title:"Select a class to get student list",text:" "});
                            }
                            setTimeout(ask, 500);
								<?php
							}
							?>
							<?php
							if($error)
							{
								?>
								function ask()
                            {
                                Growl.info({title:"<?=$error?>",text:" "});
                            }
                            setTimeout(ask, 500);
								<?php
							}
							?>
                        });
                    </script>

                <div class="pull-left student-info-upload">  
					<center>				
						<div class="tab-pane  active" id="list">
							
								
									   <select name="class_id" onchange="setclassvalue()" id="class_id">
									<option value=""><?php echo translate('select_a_class'); ?></option>
									<?php
									$classes = $this->db->get('class')->result_array();
									foreach ($classes as $row):
										?>
										<option value="<?php echo $row['class_id']; ?>"
												<?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
											Class <?php echo $row['name']; ?></option>
										<?php
									endforeach;
									?>
								</select>
						</div>
						<div><a href="#" id="send_btn" type="submit" class="btn btn-gray"><?php echo translate('download sample_excel'); ?></a></div>
					</center>
                </div>
				
				<div class="pull-left student-info-upload">
					<center>
					<?php echo form_open('admin/student_info_sheet/upload_excel', array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data')); ?>
                         <input type="hidden" name="Stclassid" id="Stclassid" value="">
                         <div>
						 	<select name="class_id" class="form-control" required="">
								<option value=""><?php echo translate('select_a_class'); ?></option>
								<?php
								$classes = $this->db->get('class')->result_array();
								foreach ($classes as $row):
									?>
									<option value="<?php echo $row['class_id']; ?>"
											<?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
										Class <?php echo $row['name']; ?></option>
									<?php
								endforeach;
								?>
							</select>
                            <span>
                                Browse <input type="file" class="" name="xlfile" id="xlfile" />
                            </span>
                         </div>
						</br>
                        <div>
							<button id="send_btn" type="submit" class="btn btn-gray"><?php echo translate('Import From Excel'); ?></button>
                        </div>
					<?php echo form_close();  ?>
					</center>
				</div>
                <!----TABLE LISTING ENDS--->
				<?php
				if($this->session->flashdata('message'))
				{
					?>
					Growl.info({title:"<?=$this->session->flash_data('message')?>",text:" "});
					<?php
				}
				?>
				
            </div>
        </div>
    </div>
	<script>

    function setclassvalue()
	{
	   var class_id=$("#class_id").val();
	   if(!class_id)
	   return false;
	   var open_url="<?=site_url('admin/student_excel')?>/"+class_id;
	   var win=window.open(open_url, 'Student list','width=1500,height=800,menubar=yes,status=yes,directories=no,scrollbars=yes,resizable=no,toolbar=no');
	   win.focus();
	   return true;
    }
</script>