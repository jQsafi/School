<div id="offcanvas" class="uk-offcanvas uk-active">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-show">
		<ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{ multiple: false }">
			<li>
				<a href="<?=site_url('admin/dashboard')?>"  target="frame">
					<i class="uk-icon-desktop"></i> <?php echo translate('dashboard'); ?>
				</a>
			</li>

			<li>
				<a href="<?=site_url('admin/teacher')?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('Teacher & stuff'); ?>
				</a>
			</li>

			<li>
				<a href="<?=site_url('admin/class_setup')?>" target="frame">
					<i class="uk-icon-code-fork"></i> <?php echo translate('Manage class'); ?>
				</a>
			</li>

			<li>
				<a href="<?=site_url('admin/subject_setup')?>" target="frame">
					<i class="uk-icon-book"></i> <?php echo translate('Manage subject'); ?>
				</a>
			</li>

			<li class="uk-parent">
				<a href="#"><i class="uk-icon-graduation-cap"></i>Manage Student</a>
                <ul class="uk-nav-sub">
                     <li>
                        <a href="<?=site_url('admin/student_add')?>"  target="frame">
                            <i class="uk-icon-user-plus"></i> <?php echo translate('Student admission'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('admin/student')?>" target="frame">
                            <i class="uk-icon-info-circle"></i> <?php echo translate('Student Information'); ?>
                        </a>
                    </li>
					<li>
						<a href="<?=site_url('admin/student_info_sheet')?>" target="frame">
							<i class="uk-icon-file-excel-o"></i> <?php echo translate('Export/Import'); ?>
						</a>
					</li>
					<li>
                        <a href="<?=site_url('admin/student_control')?>" target="frame">
                            <i class="uk-icon-user-secret"></i> <?php echo translate('student_control'); ?>
                        </a>
                    </li>
				</ul>
			</li>

            <li>
                <a href="<?=site_url('admin/class_routine')?>" target="frame">
                    <i class="uk-icon-bell"></i> <?php echo translate('Class routine'); ?>
                </a>
            </li>

			<li>
				<a href="<?=site_url('admin/parent')?>" target="frame">
					<i class="uk-icon-group"></i> <?php echo translate('Manage parent'); ?>
				</a>
			</li>
			
			<li>
				<a href="<?=site_url('admin/committee')?>" target="frame">
					<i class="uk-icon-group"></i> <?php echo translate('Manage Committee'); ?>
				</a>
			</li>

            <li>
                <a href="<?=site_url('admin/exam_setup')?>" target="frame">
                    <i class="uk-icon-star-half-empty"></i> <?php echo translate('Manage exam'); ?>
                </a>
            </li>

            <li>
                <a href="<?=site_url('admin/grade_setup')?>" target="frame">
                    <i class="uk-icon-angellist"></i> <?php echo translate('Setup grade'); ?>
                </a>
            </li>

           	<li class="uk-parent">
				<a href="#"><i class="uk-icon-calculator"></i><?php echo translate('Manage Marks'); ?></a>
                <ul class="uk-nav-sub">	
					<li>
						<a href="<?=site_url('admin/marks_input_sheet')?>"  window="new" win_height="800px" win_width="1500px">
							<i class="uk-icon-file-text"></i> <?php echo translate('Marks input sheet'); ?>
						</a>
					</li>
					
                     <li>
						<a href="<?=site_url('admin/marks')?>" window="new" win_height="800px" win_width="1200px">
							<i class="uk-icon-edit"></i> <?php echo translate('Input Marks'); ?>
						</a>
					</li>

					<li>
						<a href="<?=site_url('admin/result_process')?>" target="frame">
							<i class="uk-icon-spinner"></i> <?php echo translate('Process Result'); ?>
						</a>
					</li>
				</ul>
			</li>

			<li class="uk-parent">
				<a href="#"><i class="uk-icon-th"></i> <?=translate('progress_card')?></a>
                <ul class="uk-nav-sub">
                    <li>
						<a href="<?=site_url('progress_card/progresscard/details')?>"  target="frame">
							<i class="uk-icon-file-text-o"></i> <?=translate('Progress card- details')?>
						</a>
					</li>

                    <li>
                        <a href="<?=site_url('progress_card/progresscard/sba')?>"  target="frame">
                            <i class="uk-icon-file-o"></i> <?=translate('Pprogress card- SBA')?>
                        </a>
                    </li>

					<li>
						<a href="<?=site_url('progress_card/progresscard/grsc')?>"  target="frame">
							<i class="uk-icon-file-text"></i> <?=translate('Progress card- short')?>
						</a>
					</li>
				</ul>
			</li>  

            <li>
                <a href="<?=site_url('admin/mark_sheet_glance')?>" target="frame">
                    <i class="uk-icon-buysellads"></i> <?php echo translate('result at a glance'); ?>
                </a>
            </li>

             <li class="uk-parent">
                <a href="#"><i class="uk-icon-newspaper-o"></i> <?=translate('tabulation_sheet')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/tabulation_sheet')?>"  window="new" win_height="800px" win_width="1400px">
                            <i class="uk-icon-file-o"></i> <?php echo translate('Tabulation sheet'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/tabulation_sheet/sba')?>"  window="new" win_height="800px" win_width="1500px">
                            <i class="uk-icon-file"></i> <?php echo translate('tabulation_sheet-SBA'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-ticket"></i> <?=translate('Admit Card')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/admit_card')?>"  target="frame">
                            <i class="uk-icon-shield"></i> <?php echo translate('Admit Card setup'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/admit_card_print')?>"   window="new" win_height="800px" win_width="1500px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print Admit Card'); ?>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="uk-parent">
                <a href="#"><i class="uk-icon-trello"></i> <?=translate('Testimonial')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/testimonial')?>" target="frame">
                            <i class="uk-icon-twitch"></i> <?php echo translate('Testimonial setup'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/testimonial_print')?>"   window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print Testimonial'); ?>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="uk-parent">
                <a href="#"><i class="uk-icon-stack-overflow"></i> <?=translate('TC')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/transfar_certificate')?>" target="frame">
                            <i class="uk-icon-stack-exchange"></i> <?php echo translate('Setup TC'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/transfar_certificate_print')?>"   window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print TC'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-slideshare"></i> <?=translate('Human Resource')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/holiday')?>" target="frame">
                            <i class="uk-icon-plane"></i> <?php echo translate('holiday setup'); ?>
                        </a>
                    </li>
					<li>
                        <a href="<?=site_url('admin/shift_setup')?>" target="frame">
                            <i class="uk-icon-plane"></i> <?php echo translate('shift_setup'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('admin/stattendancetype_setup')?>" target="frame">
                            <i class="uk-icon-tasks"></i> <?php echo translate('Setup attendance Type'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/leave_type')?>" target="frame">
                            <i class="uk-icon-calendar-o"></i> <?php echo translate('leave_type'); ?>
                        </a>
                    </li>

					<li>
						<a href="<?=site_url('admin/noticeboard')?>" target="frame">
							<i class="uk-icon-align-left"></i> <?php echo translate('Noticeboard'); ?>
						</a>
					</li>

                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-calendar"></i> <?=translate('Manage attendance')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/student_attendance')?>" window="new" win_height="800px" win_width="1500px">
                            <i class="uk-icon-street-view"></i> <?php echo translate('Student Attendance'); ?>
                        </a>
                    </li>

                    <li>
						<?php
						$atts = array(
				              'width'      => '1200',
				              'height'     => '800',
				              'scrollbars' => 'yes',
				              'status'     => '0',
				              'resizable'  => '0',
				              'screenx'    => '50%',
				              'screeny'    => '50%'
				            );
						?>
						<?=anchor_popup(site_url('admin/employee_attendance'),'<i class="uk-icon-user-secret"></i>'.translate('employee_attendance'),$atts)?>
                    </li>

                     <li>
                        <a href="<?=site_url('admin/attendance_report')?>" target="frame">
                            <i class="uk-icon-sliders"></i> <?php echo translate('arrival Report Student'); ?>
                        </a>
                    </li>
					<li>
						<?php
						$atts = array(
				              'width'      => '1200',
				              'height'     => '800',
				              'scrollbars' => 'yes',
				              'status'     => '0',
				              'resizable'  => '0',
				              'screenx'    => '50%',
				              'screeny'    => '50%'
				            );
						?>
						<?=anchor_popup(site_url('admin/employee_attendance_report'),'<i class="uk-icon-user-secret"></i>'.translate('arrival Report Teacher'),$atts)?>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-credit-card"></i> <?=translate('Fees Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/fees_setup')?>" target="frame">
                            <i class="uk-icon-plus-square"></i> <?php echo translate('Add Fees Head'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/fees')?>" target="frame">
                            <i class="uk-icon-check-square"></i> <?php echo translate('Assign Fees'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('admin/bill_collection')?>" target="frame">
                            <i class="uk-icon-paypal"></i> <?php echo translate('Payment'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('admin/invoice')?>" target="frame">
                            <i class="uk-icon-ticket"></i> <?php echo translate('Invoice'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('admin/fees_report')?>" target="frame">
                            <i class="uk-icon-line-chart"></i> <?php echo translate('Fees Report'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('admin/due_report')?>" target="frame">
                            <i class="uk-icon-pie-chart"></i> <?php echo translate('Due Fees Report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-dollar"></i> <?=translate('Income Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/income')?>" target="frame">
                            <i class="uk-icon-money"></i> <?php echo translate('Add income'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/income_report')?>" target="frame">
                            <i class="uk-icon-sliders"></i> <?php echo translate('Income report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-credit-card"></i> <?=translate('Expense Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/expense')?>" target="frame">
                            <i class="uk-icon-money"></i> <?php echo translate('Add Expense'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/expense_report')?>" target="frame">
                            <i class="uk-icon-area-chart"></i> <?php echo translate('Expense report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-bank"></i> <?=translate('Bank Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/add_bank_account')?>" target="frame">
                            <i class="uk-icon-key"></i> <?php echo translate('Add Account'); ?>
                        </a>
                    </li>					
									
					<li>
                        <a href="<?=site_url('admin/bank_deposit')?>" target="frame">
                            <i class="uk-icon-paper-plane"></i> <?php echo translate('Deposit'); ?>
                        </a>
                    </li>
					
					<li>
                        <a href="<?=site_url('admin/bank_expense')?>" target="frame">
                            <i class="uk-icon-paper-plane"></i> <?php echo translate('withdraw'); ?>
                        </a>
                    </li>

                    <!--<li>
                        <a href="<?=site_url('admin/check_bank_Balance')?>" target="frame">
                            <i class="uk-icon-check-square-o"></i> <?php echo translate('Check Balance'); ?>
                        </a>
                    </li>-->

                    <li>
                        <a href="<?=site_url('admin/check_statement')?>" target="frame">
                            <i class="uk-icon-line-chart"></i> <?php echo translate('check_statement'); ?>
                        </a>
                    </li>
                </ul>
            </li>
			<li>
                <a href="<?=site_url('admin/balance_sheet')?>" target="frame">
                    <i class="uk-icon-check-square-o"></i> <?php echo translate('balance_sheet'); ?>
                </a>
             </li>
            <li class="uk-parent">
                <a href="#"><i class="uk-icon-ils"></i> <?=translate('Salary')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('admin/salary_setup')?>" target="frame">
                            <i class="uk-icon-cubes"></i> <?php echo translate('Payroll Setup'); ?>
                        </a>
                    </li>
                   
                    <li>
                        <a href="<?=site_url('admin/salary_genarate')?>" target="frame">
                            <i class="uk-icon-outdent"></i> <?php echo translate('Genarate Salary'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/salary_status')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-file-o"></i> <?php echo translate('Salary Sheet'); ?>
                        </a>
                    </li>

                    <!--<li>
                        <a href="<?=site_url('admin/payslip')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-list-alt"></i> <?php echo translate('Pay Slip'); ?>
                        </a>
                    </li>-->
					
					<li>
                        <a href="<?=site_url('admin/provident_payment')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-money"></i> <?php echo translate('Pay provident Fund'); ?>
                        </a>
                    </li>
					
					 <li>
                        <a href="<?=site_url('admin/provident_report')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-newspaper-o"></i> <?php echo translate('provident Fund Report'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('admin/salaryreport')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-bars"></i> <?php echo translate('Salary Report'); ?>
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="<?=site_url('admin/book')?>" target="frame">
                    <i class="uk-icon-columns"></i> <?php echo translate('Library'); ?>
                </a>
            </li>

            <li>
                <a href="<?=site_url('admin/transport')?>" target="frame">
                    <i class="uk-icon-bus"></i> <?php echo translate('Transport'); ?>
                </a>
            </li>

            <li>
                <a href="<?=site_url('admin/dormitory')?>" target="frame">
                    <i class="uk-icon-hotel"></i> <?php echo translate('Dormitory'); ?>
                </a>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-gears"></i> <?=translate('Settings')?></a>
                <ul class="uk-nav-sub">
                    <li>
						<?php
						$settings_id=get_single_value('settings_id','settings');
						if($settings_id>0)
						$ext_url='/edit/'.$settings_id;
						else
						$ext_url='/add/';
						?>
                        <a href="<?=site_url('admin/settings'.$ext_url)?>" target="frame">
                            <i class="uk-icon-wrench"></i> <?php echo translate('System Settings'); ?>
                        </a>
                    </li>
					
					<li>
                        <a href="<?=site_url('admin/class_section')?>" target="frame">
                            <i class="uk-icon-user"></i> <?php echo translate('Class Section'); ?>
                        </a>
                    </li>
					
                    <li>
                        <a href="<?=site_url('admin/academic_year')?>" target="frame">
                            <i class="uk-icon-user"></i> <?php echo translate('Academic year'); ?>
                        </a>
                    </li>
					
					<li>
                        <a href="<?=site_url('admin/designation')?>" target="frame">
                            <i class="uk-icon-user"></i> <?php echo translate('Teacher Designation'); ?>
                        </a>
                    </li>
                </ul>
            </li>
			<!--<li>
                <a href="<?=site_url('language')?>" target="frame">
                    <i class="uk-icon-database"></i> <?php echo translate('manage_language'); ?>
                </a>
            </li>-->
            <li>
                <a href="<?=site_url('admin/backup_restore')?>" target="frame">
                    <i class="uk-icon-database"></i> <?php echo translate('Backup & restore'); ?>
                </a>
            </li>
		</ul>
	</div>
</div>