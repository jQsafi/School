        <?php
		$atts = array(
              'width'      => '1200',
              'height'     => '1000',
              'scrollbars' => 'no',
              'status'     => 'no',
              'resizable'  => '0',
              'screenx'    => '50px',
              'screeny'    => '50px'
            );
		?>
		<div class="container-fluid navbar" >
            <div class="row-fluid">
                <div class="area-top clearfix">
                    <div class="pull-left header">
                        <h5 class="title nav">
						<?=anchor_popup(current_url(),$page_title,$atts)?>
						</h5>
                    </div>

                </div>
            </div>
        </div>
        <!--------FLASH MESSAGES--->
        
		<!--<?php if($this->session->flashdata('flash_message') != ""):?>
        <div class="container-fluid padded">
        	<div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?php echo $this->session->flashdata('flash_message');?>
            </div>
        </div>
        <?php endif;?>-->
        
        
        <?php if($this->session->flashdata('flash_message') != ""):?>
 		<script>
			$(document).ready(function() {
				Growl.info({title:"<?php echo $this->session->flashdata('flash_message');?>",text:" "})
			});
		</script>
        <?php endif;?>