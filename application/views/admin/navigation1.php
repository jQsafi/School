<div class="sidebar-background">
    <div class="primary-sidebar-background">
    </div>
</div>
<div class="primary-sidebar">
    <!-- Main nav -->
    <br />
    <ul class="nav nav-collapse collapse nav-collapse-primary">
        
        <!------dashboard----->
        <li class="<?php if ($page_name == 'dashboard') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('dashboard_help');?><?php */ ?>">
                <!--<i class="icon-desktop icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/home.png" />
                <span><?php echo translate('dashboard'); ?></span>
            </a>
        </li>
		
        
        <!------student----->
        <li class="<?php if ($page_name == 'student') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/student" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('student_help');?><?php */ ?>">
                               <!--<i class="icon-user icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                <span><?php echo translate('student'); ?></span>
            </a>
        </li>
		
		<!------student add----->
        <li class="<?php if ($page_name == 'student_add') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/student_add" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('student_help');?><?php */ ?>">
                               <!--<i class="icon-user icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                <span><?php echo translate('admission'); ?></span>
            </a>
        </li>
		
        <?php if($this->session->userdata('user_role') != 'accountant'){ ?>
        <!------teacher----->
        <li class="<?php if ($page_name == 'teacher') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/teacher" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('teacher_help');?><?php */ ?>">
                               <!--<i class="icon-user icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/teacher.png" />
                <span><?php echo translate('teacher'); ?></span>
            </a>
        </li>

        <!------parent----->
        <li class="<?php if ($page_name == 'parent') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/parent" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('teacher_help');?><?php */ ?>">
                               <!--<i class="icon-user icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/parent.png" />
                <span><?php echo translate('parent'); ?></span>
            </a>
        </li>

        <!------subject----->
        <li class="<?php if ($page_name == 'subject') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/subject" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('subject_help');?><?php */ ?>">
                               <!--<i class="icon-tasks icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/subject.png" />
                <span><?php echo translate('subject'); ?></span>
            </a>
        </li>

        <!------classes----->
        <li class="<?php if ($page_name == 'class') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/classes" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('class_help');?><?php */ ?>">
                               <!--<i class="icon-sitemap icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/class.png" />
                <span><?php echo translate('class'); ?></span>
            </a>
        </li>

        <!------exam----->
        <li class="<?php if ($page_name == 'exam') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/exam" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('exam_help');?><?php */ ?>">
                               <!--<i class="icon-paste icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/exam.png" />
                <span><?php echo translate('exam'); ?></span>
            </a>
        </li>

        <!------marks----->
        <li class="<?php if ($page_name == 'marks') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/marks" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('marks_help');?><?php */ ?>">
                               <!--<i class="icon-pencil icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/marks.png" />
                <span><?php echo translate('marks-attendance'); ?></span>
            </a>
        </li>
		
		<!------marks Sheet----->
        <li class="<?php if ($page_name == 'marksheet') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/marksheet" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('marks_help');?><?php */ ?>">
                               <!--<i class="icon-pencil icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/marks.png" />
                <span><?php echo translate('Mark Sheet'); ?></span>
            </a>
        </li>


        <!------grade----->
        <li class="<?php if ($page_name == 'grade') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/grade" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('grade_help');?><?php */ ?>">
                               <!--<i class="icon-list-ol icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/grade.png" />
                <span><?php echo translate('exam-grade'); ?></span>
            </a>
        </li>

        <!------class routine----->
        <li class="<?php if ($page_name == 'class_routine') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/class_routine" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('class_routine_help');?><?php */ ?>">
                               <!--<i class="icon-indent-right icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/routine.png" />
                <span><?php echo translate('class_routine'); ?></span>
            </a>
        </li>
        <?php } ?>
        

		<!------attendance----->
        <li class="<?php if ($page_name == 'attendance') echo 'dark-nav'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/attendance" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('dashboard_help');?><?php */ ?>">
                <!--<i class="icon-desktop icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/home.png" />
                <span><?php echo translate('attendance'); ?></span>
            </a>
        </li>
		
        <!------invoice----->
        <li class="<?php if ($page_name == 'invoice') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/invoice" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                               <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Student Fees'); ?></span>
            </a>
        </li>        

        <li class="<?php if ($page_name == 'report') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/report/" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Student Fees Report'); ?></span>
            </a>
        </li>
        
        <!------Income----->
        <li class="<?php if ($page_name == 'income') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/income" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Income'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'income_report') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/income_report/" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Income Report'); ?></span>
            </a>
        </li>
        
        <!------Expense----->
        <li class="<?php if ($page_name == 'expense') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/expense" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Expense'); ?></span>
            </a>
        </li>
        <li class="<?php if ($page_name == 'expense_report') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/expense_report/" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('Expense Report'); ?></span>
            </a>
        </li>
        
        <?php if($this->session->userdata('user_role') != 'accountant'){ ?>
        <!------book----->
        <li class="<?php if ($page_name == 'book') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/book" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('book_help');?><?php */ ?>">
                               <!--<i class="icon-book icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/book.png" />
                <span><?php echo translate('library'); ?></span>
            </a>
        </li>

        <!------transport----->
        <li class="<?php if ($page_name == 'transport') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/transport" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('transport_help');?<?php */ ?>">
                               <!--<i class="icon-truck icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/transport.png" />
                <span><?php echo translate('transport'); ?></span>
            </a>
        </li>

        <!------dormitory----->
        <li class="<?php if ($page_name == 'dormitory') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/dormitory" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('dormitory_help');?><?php */ ?>">
                               <!--<i class="icon-hospital icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/dormitory.png" />
                <span><?php echo translate('dormitory'); ?></span>
            </a>
        </li>

        <!------noticeboard----->
        <li class="<?php if ($page_name == 'noticeboard') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('noticeboard_help');?><?php */ ?>">
                               <!--<i class="icon-columns icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/noticeboard.png" />
                <span><?php echo translate('noticeboard-event'); ?></span>
            </a>
        </li>


        <!------System Settings--->
        <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                          <!--<i class="icon-h-sign"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/system_settings.png" />
                <span><?php echo translate('system_settings'); ?></span>
            </a>
        </li>
        
        <!------Fees setup --->
        <li class="<?php if ($page_name == 'fees_setup') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/fees_setup">
                          <!--<i class="icon-h-sign"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/system_settings.png" />
                <span><?php echo translate('fees_setup'); ?></span>
            </a>
        </li>

		<!------salary setup --->
        <li class="<?php if ($page_name == 'salary_setup') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/salary_setup">
                          <!--<i class="icon-h-sign"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/system_settings.png" />
                <span><?php echo translate('salary'); ?></span>
            </a>
        </li>
		
		<li class="<?php if ($page_name == 'salary_genarate') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/salary_genarate">
                          <!--<i class="icon-h-sign"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/system_settings.png" />
                <span><?php echo translate('Salary Generate'); ?></span>
            </a>
        </li>
		
		<li class="<?php if ($page_name == 'salary_status') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/salary_status">
                          <!--<i class="icon-h-sign"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/system_settings.png" />
                <span><?php echo translate('Salary Sheet'); ?></span>
            </a>
        </li>
		
        <li class="<?php if ($page_name == 'salaryreport') echo 'dark-nav active'; ?>">
            <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/salaryreport/" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('invoice_help');?><?php */ ?>">
                <!--<i class="icon-money icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/payment.png" />
                <span><?php echo translate('salary_Report'); ?></span>
            </a>
        </li>
        <!------Manage Language--->
        <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                          <!--<i class="icon-globe"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/language.png" />
                <span><?php echo translate('manage_language'); ?></span>
            </a>
        </li>
        <?php } ?>

        <!------manage own profile--->
        <li class="<?php if ($page_name == 'manage_profile') echo 'dark-nav active'; ?>">
                <!--<span class="glow"></span>-->
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile" rel="tooltip" data-placement="right" 
               data-original-title="<?php /* ?><?php echo translate('profile_help');?><?php */ ?>">
                               <!--<i class="icon-lock icon-1x"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/profile.png" />
                <span><?php echo translate('profile'); ?></span>
            </a>
        </li>
        
        <?php if($this->session->userdata('user_role') != 'accountant'){ ?>
        <!------Backup and Restore--->
        <li class="<?php if ($page_name == 'backup_restore') echo 'dark-nav active'; ?>">
            <a href="<?php echo base_url(); ?>index.php?admin/backup_restore">
            <!--<i class="icon-download-alt"></i>-->
                <img src="<?php echo base_url(); ?>template/images/icons/backup.png" />
                <span><?php echo translate('backup_restore'); ?></span>
            </a>
        </li>
        <?php } ?>
    </ul>

</div>