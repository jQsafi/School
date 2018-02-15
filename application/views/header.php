<div class="navbar navbar-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="brand" href="<?php echo base_url();?>"><?php echo $system_name;?>
			</a>
			<!-- the new toggle buttons -->
			<ul class="nav pull-right">
				<li class="toggle-primary-sidebar hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-primary"><button type="button" class="btn btn-navbar"><i class="icon-th-list"></i></button></li>
				<li class="hidden-desktop" data-toggle="collapse" data-target=".nav-collapse-top"><button type="button" class="btn btn-navbar"><i class="icon-align-justify"></i></button></li>
			</ul>
			<div class="nav-collapse nav-collapse-top collapse">
            	<ul class="nav pull-right">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-globe"></i><?php echo translate($this->session->userdata('login_type')).' '.translate('panel');?> <b class="caret"></b></a>
					<!-- Account Selector -->
                    <ul class="dropdown-menu">
                    	<li class="with-image">
                            <div class="avatar">
                                <img src="<?php echo base_url();?>template/images/icons_big/<?php echo $this->session->userdata('login_type');?>.png" class="avatar-medium"/>
                            </div>
                            <span><?php echo $this->session->userdata('name');?></span>
                        </li>
                    	<li class="divider"></li>
                        
                        <?php
							if ($this->session->userdata('login_type')	==	'parent')
								$account_type	=	'parents';
							else
								$account_type	=	$this->session->userdata('login_type');
						?>
						<li><a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile" target="frame">
                        		<i class="icon-user"></i><span><?php echo translate('profile');?></span></a></li>
                        <li><a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile" target="frame">
                        		<i class="icon-key"></i><span><?php echo translate('change_password');?></span></a></li>
						<li><a  data-toggle="modal" href="#modal-confirm" onclick="modal_confirm('<?php echo site_url('login/logout'); ?>')">
                        		<i class="icon-off"></i><span><?php echo translate('logout');?></span></a></li>
					</ul>
                	<!-- Account Selector -->
					</li>
				</ul>
				
				<ul class="nav pull-right">
							<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-wrench"></i>
							<?=translate($this->input->cookie('language'))?> <b class="caret"></b></a>
							<!-- Language Selector -->
		                        <ul class="dropdown-menu">
									<li>
										<a href="<?=site_url('multilanguage/language/english')?>">
											<i class="icon-globe"></i><?=translate('english')?>
										</a>
									</li>
									<li>
										<a href="<?=site_url('multilanguage/language/bangla')?>">
											<i class="icon-globe"></i><?=translate('bangla','nochange')?>
										</a>
									</li>
		                        </ul>
		                	<!-- Language Selector -->
							</li>
						</ul>
                <!--<ul class="nav pull-right">
					<li class="dropdown">
					<a href="#" ><i class="icon-user"></i><?php echo translate($this->session->userdata('login_type')).' '.translate('panel');?> </a>
					</li>
				</ul>-->
			</div>
		</div>
	</div>
</div>