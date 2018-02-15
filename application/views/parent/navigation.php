<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>
<div class="primary-sidebar">
	<!-- Main nav -->
   	<br />
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/dashboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('dashboard_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/home.png" />
					<span><?php echo translate('dashboard');?></span>
				</a>
		</li>
        
        <!------teacher----->
		<li class="<?php if($page_name == 'teacher')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/teacher_list" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('teacher_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/teacher.png" />
					<span><?php echo translate('teacher');?></span>
				</a>
		</li>
        
        
        <!------marks----->
		<li class="<?php if($page_name == 'marks')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/marks" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('marks_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/marks.png" />
					<span><?php echo translate('marks-attendance');?></span>
				</a>
		</li>
        
        <!------class routine----->
		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/class_routine" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('class_routine_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/routine.png" />
					<span><?php echo translate('class_routine');?></span>
				</a>
		</li>
        
        
        <!------invoice----->
		<li class="<?php if($page_name == 'invoice')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/invoice" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('invoice_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/payment.png" />
					<span><?php echo translate('payment');?></span>
				</a>
		</li>
        
        
        <!------book----->
		<li class="<?php if($page_name == 'book')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/book" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('book_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/book.png" />
					<span><?php echo translate('library');?></span>
				</a>
		</li>
        
        <!------transport----->
		<li class="<?php if($page_name == 'transport')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/transport" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('transport_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/transport.png" />
					<span><?php echo translate('transport');?></span>
				</a>
		</li>
        
        <!------dormitory----->
		<li class="<?php if($page_name == 'dormitory')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/dormitory" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('dormitory_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/dormitory.png" />
					<span><?php echo translate('dormitory');?></span>
				</a>
		</li>
        
        
        <!------noticeboard----->
		<li class="<?php if($page_name == 'noticeboard')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/noticeboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('noticeboard_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/noticeboard.png" />
					<span><?php echo translate('noticeboard-event');?></span>
				</a>
		</li>
        
        
		<!------manage own profile--->
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?parents/manage_profile" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('profile_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/profile.png" />
					<span><?php echo translate('profile');?></span>
				</a>
		</li>
		
	</ul>
	
</div>