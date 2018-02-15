<div id="offcanvas" class="uk-offcanvas uk-active">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-show">
		<ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{ multiple: false }">
			<li>
				<a href="<?=site_url('superadmin/dashboard')?>"  target="frame">
					<i class="uk-icon-desktop"></i> <?php echo translate('dashboard'); ?>
				</a>
			</li>
			<li>
				<a href="<?=site_url('superadmin/control_setup')?>"  target="frame">
					<i class="uk-icon-legal"></i> <?php echo translate('control_setup'); ?>
				</a>
			</li>
			<li>
				<a href="<?=site_url('superadmin/teacher')?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('Teacher & stuff'); ?>
				</a>
			</li>
			
			<li class="uk-parent">
				<a href="#"><i class="uk-icon-graduation-cap"></i>Manage Student</a>
                <ul class="uk-nav-sub">
                     <li>
                        <a href="<?=site_url('superadmin/student_add')?>"  target="frame">
                            <i class="uk-icon-user-plus"></i> <?php echo translate('Student admission'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('superadmin/student_control')?>" target="frame">
                            <i class="uk-icon-user-secret"></i> <?php echo translate('student_control'); ?>
                        </a>
                    </li>  

					<li>
						<a href="<?=site_url('superadmin/student_info_sheet')?>" target="frame">
							<i class="uk-icon-file-excel-o"></i> <?php echo translate('Export/Import'); ?>
						</a>
					</li>
				</ul>
			</li>

            <li class="uk-parent">
                <a href="#"><i class="uk-icon-gears"></i> <?=translate('Settings')?></a>
                <ul class="uk-nav-sub">
                    <li>
                        <a href="<?=site_url('superadmin/system_settings')?>" target="frame">
                            <i class="uk-icon-wrench"></i> <?php echo translate('System Settings'); ?>
                        </a>
                    </li>
					<li>
                        <a href="<?=site_url('language')?>" target="frame">
                            <i class="uk-icon-wrench"></i> <?php echo translate('manage_language'); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?=site_url('superadmin/manage_profile')?>" target="frame">
                            <i class="uk-icon-user"></i> <?php echo translate('Manage profile'); ?>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="<?=site_url('superadmin/backup_restore')?>" target="frame">
                    <i class="uk-icon-database"></i> <?php echo translate('Backup & restore'); ?>
                </a>
            </li>
			<li>
                <a href="<?=site_url('superadmin/update_setup')?>" target="frame">
                    <i class="uk-icon-database"></i> <?php echo translate('update_setup'); ?>
                </a>
            </li>
			<li>
                <a href="<?=site_url('superadmin/check_update')?>" target="frame">
                    <i class="uk-icon-database"></i> <?php echo translate('check_update'); ?>
                </a>
            </li>
		</ul>
	</div>
</div>