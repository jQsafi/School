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
				<a href="<?php echo base_url();?>index.php?teacher/dashboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('dashboard_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/home.png" />
					<span><?php echo translate('dashboard');?></span>
				</a>
		</li>
        
        <!------student----->
		<li class="<?php if($page_name == 'student')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/student" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('student_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/user.png" />
					<span><?php echo translate('student');?></span>
				</a>
		</li>
        <li>
            <a href="<?=site_url('teacher/student_control')?>" target="frame">
                <i class="uk-icon-user-secret"></i> <?php echo translate('student_control'); ?>
            </a>
        </li>
        <!------teacher----->
		<li class="<?php if($page_name == 'teacher')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/teacher_list" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('teacher_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/teacher.png" />
					<span><?php echo translate('teacher');?></span>
				</a>
		</li>
        
        <!------subject----->
		<li class="<?php if($page_name == 'subject')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/subject" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('subject_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/subject.png" />
					<span><?php echo translate('subject');?></span>
				</a>
		</li>
        
        
        <!------marks----->
		<li class="<?php if($page_name == 'marks')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/marks" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('marks_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/marks.png" />
					<span><?php echo translate('marks-attendance');?></span>
				</a>
		</li>
         <!------marks Sheet----->
        <li class="<?php if ($page_name == 'marksheet') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/marksheet" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('marks_help');?><?php */ ?>">
                               <!--<i class="icon-pencil icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/mark-sheet.png" />
                <span><?php echo translate('Mark Sheet'); ?></span>
            </a>
        </li>
        <!------class routine----->
		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/class_routine" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('class_routine_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/routine.png" />
					<span><?php echo translate('class_routine');?></span>
				</a>
		</li>
        
        
        <!------book----->
		<li class="<?php if($page_name == 'book')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/book" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('book_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/book.png" />
					<span><?php echo translate('library');?></span>
				</a>
		</li>
        
        <!------transport----->
		<li class="<?php if($page_name == 'transport')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/transport" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('transport_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/transport.png" />
					<span><?php echo translate('transport');?></span>
				</a>
		</li>
        
        
        <!------noticeboard----->
		<li class="<?php if($page_name == 'noticeboard')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/noticeboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('noticeboard_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/noticeboard.png" />
					<span><?php echo translate('noticeboard-event');?></span>
				</a>
		</li>
        
        
        <!------backup-restore----->
		<li class="<?php if($page_name == 'backup_restore')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/backup_restore" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('backup_restore_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/backup.png" />
					<span><?php echo translate('backup_restore');?></span>
				</a>
		</li>
        
		<!------manage own profile--->
		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">
				<a href="<?php echo base_url();?>index.php?teacher/manage_profile" rel="tooltip" data-placement="right" 
                	data-original-title="<?php /*?><?php echo translate('profile_help');?><?php */?>">
                    <img src="<?php echo base_url();?>template/images/icons/profile.png" />
					<span><?php echo translate('profile');?></span>
				</a>
		</li>
		
	</ul>
	
</div>