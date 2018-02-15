<div id="offcanvas" class="uk-offcanvas uk-active">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-show">
		<ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{ multiple: false }">
			<li>
				<a href="<?=site_url('accountant//dashboard')?>"  target="frame">
					<i class="uk-icon-desktop"></i> <?php echo translate('dashboard'); ?>
				</a>
			</li>

			<li>
				<a href="<?=site_url('accountant//teacher')?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('Teacher & stuff'); ?>
				</a>
			</li>

			

			<li class="uk-parent">
				<a href="#"><i class="uk-icon-graduation-cap"></i>Manage Student</a>
                <ul class="uk-nav-sub">
                     <li>
                        <a href="<?=site_url('accountant//student_add')?>"  target="frame">
                            <i class="uk-icon-user-plus"></i> <?php echo translate('Student admission'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('accountant//student')?>" target="frame">
                            <i class="uk-icon-info-circle"></i> <?php echo translate('Student Information'); ?>
                        </a>
                    </li>
				</ul>
			</li>

            <li>
                <a href="<?=site_url('accountant//class_routine')?>" target="frame">
                    <i class="uk-icon-bell"></i> <?php echo translate('Class routine'); ?>
                </a>
            </li>


            <li class="uk-parent">
                <a href="#"><i class="uk-icon-ticket"></i> <?=translate('Admit Card')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//admit_card')?>"  target="frame">
                            <i class="uk-icon-shield"></i> <?php echo translate('Admit Card setup'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//admit_card_print')?>"   window="new" win_height="800px" win_width="1500px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print Admit Card'); ?>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="uk-parent">
                <a href="#"><i class="uk-icon-trello"></i> <?=translate('Testimonial')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//testimonial')?>" target="frame">
                            <i class="uk-icon-twitch"></i> <?php echo translate('Testimonial setup'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//testimonial_print')?>"   window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print Testimonial'); ?>
                        </a>
                    </li>
                </ul>
            </li>

             <li class="uk-parent">
                <a href="#"><i class="uk-icon-stack-overflow"></i> <?=translate('TC')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//transfar_certificate')?>" target="frame">
                            <i class="uk-icon-stack-exchange"></i> <?php echo translate('Setup TC'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//transfar_certificate_print')?>"   window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-print"></i> <?php echo translate('Print TC'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-slideshare"></i> <?=translate('Human Resource')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//holiday')?>" target="frame">
                            <i class="uk-icon-plane"></i> <?php echo translate('holiday setup'); ?>
                        </a>
                    </li>
					<li>
                        <a href="<?=site_url('accountant//shift_setup')?>" target="frame">
                            <i class="uk-icon-plane"></i> <?php echo translate('shift_setup'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('accountant//stattendancetype_setup')?>" target="frame">
                            <i class="uk-icon-tasks"></i> <?php echo translate('Setup attendance Type'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//leave_type')?>" target="frame">
                            <i class="uk-icon-calendar-o"></i> <?php echo translate('leave_type'); ?>
                        </a>
                    </li>

					<li>
						<a href="<?=site_url('accountant//noticeboard')?>" target="frame">
							<i class="uk-icon-align-left"></i> <?php echo translate('Noticeboard'); ?>
						</a>
					</li>

                </ul>
            </li>

           

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-credit-card"></i> <?=translate('Fees Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//fees_setup')?>" target="frame">
                            <i class="uk-icon-plus-square"></i> <?php echo translate('Add Fees Head'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//fees')?>" target="frame">
                            <i class="uk-icon-check-square"></i> <?php echo translate('Assign Fees'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('accountant//bill_collection')?>" target="frame">
                            <i class="uk-icon-paypal"></i> <?php echo translate('Payment'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('accountant//invoice')?>" target="frame">
                            <i class="uk-icon-ticket"></i> <?php echo translate('Invoice'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('accountant//fees_report')?>" target="frame">
                            <i class="uk-icon-line-chart"></i> <?php echo translate('Fees Report'); ?>
                        </a>
                    </li>

                     <li>
                        <a href="<?=site_url('accountant//due_report')?>" target="frame">
                            <i class="uk-icon-pie-chart"></i> <?php echo translate('Due Fees Report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-dollar"></i> <?=translate('Income Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//income')?>" target="frame">
                            <i class="uk-icon-money"></i> <?php echo translate('Add income'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//income_report')?>" target="frame">
                            <i class="uk-icon-sliders"></i> <?php echo translate('Income report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-credit-card"></i> <?=translate('Expense Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//expense')?>" target="frame">
                            <i class="uk-icon-money"></i> <?php echo translate('Add Expense'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//expense_report')?>" target="frame">
                            <i class="uk-icon-area-chart"></i> <?php echo translate('Expense report'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-bank"></i> <?=translate('Bank Accoutns')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//add_bank_account')?>" target="frame">
                            <i class="uk-icon-key"></i> <?php echo translate('Add Account'); ?>
                        </a>
                    </li>					
									
					<li>
                        <a href="<?=site_url('accountant//bank_deposit')?>" target="frame">
                            <i class="uk-icon-paper-plane"></i> <?php echo translate('Deposit'); ?>
                        </a>
                    </li>
					
					<li>
                        <a href="<?=site_url('accountant//bank_expense')?>" target="frame">
                            <i class="uk-icon-paper-plane"></i> <?php echo translate('withdraw'); ?>
                        </a>
                    </li>

                    <!--<li>
                        <a href="<?=site_url('accountant//check_bank_Balance')?>" target="frame">
                            <i class="uk-icon-check-square-o"></i> <?php echo translate('Check Balance'); ?>
                        </a>
                    </li>-->

                    <li>
                        <a href="<?=site_url('accountant//check_statement')?>" target="frame">
                            <i class="uk-icon-line-chart"></i> <?php echo translate('check_statement'); ?>
                        </a>
                    </li>
                </ul>
            </li>
			<li>
                <a href="<?=site_url('accountant//balance_sheet')?>" target="frame">
                    <i class="uk-icon-check-square-o"></i> <?php echo translate('balance_sheet'); ?>
                </a>
             </li>
            <li class="uk-parent">
                <a href="#"><i class="uk-icon-ils"></i> <?=translate('Salary')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('accountant//salary_setup')?>" target="frame">
                            <i class="uk-icon-cubes"></i> <?php echo translate('Payroll Setup'); ?>
                        </a>
                    </li>
                   
                    <li>
                        <a href="<?=site_url('accountant//salary_genarate')?>" target="frame">
                            <i class="uk-icon-outdent"></i> <?php echo translate('Genarate Salary'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//salary_status')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-file-o"></i> <?php echo translate('Salary Sheet'); ?>
                        </a>
                    </li>

                    <!--<li>
                        <a href="<?=site_url('accountant//payslip')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-list-alt"></i> <?php echo translate('Pay Slip'); ?>
                        </a>
                    </li>-->
					
					<li>
                        <a href="<?=site_url('accountant//provident_payment')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-money"></i> <?php echo translate('Pay provident Fund'); ?>
                        </a>
                    </li>
					
					 <li>
                        <a href="<?=site_url('accountant//provident_report')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-newspaper-o"></i> <?php echo translate('provident Fund Report'); ?>
                        </a>
                    </li>

                    <li>
                        <a href="<?=site_url('accountant//salaryreport')?>" window="new" win_height="800px" win_width="1200px">
                            <i class="uk-icon-bars"></i> <?php echo translate('Salary Report'); ?>
                        </a>
                    </li>
                </ul>
            </li>
		</ul>
	</div>
</div>