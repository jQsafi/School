<?php
echo $current_student_id=$this->session->userdata('student_id');
?>
<div id="offcanvas" class="uk-offcanvas uk-active">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-show">
		<ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav="{ multiple: false }">
			<li>
				<a href="<?=site_url('student/dashboard')?>"  target="frame">
					<i class="uk-icon-desktop"></i> <?php echo translate('dashboard'); ?>
				</a>
			</li>

			<li>
				<a href="<?=site_url('student/teacher')?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('Teacher & stuff'); ?>
				</a>
			</li>
			<li>
				<a href="<?=site_url('modal/popup/student_profile/'.$current_student_id)?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('my_profile'); ?>
				</a>
			</li>
			<li>
				<a href="<?=site_url('student/class_routine/'.$current_student_id)?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('class_routine'); ?>
				</a>
			</li>
			<li>
				<a href="<?=site_url('student/result/')?>" target="frame">
					<i class="uk-icon-user"></i> <?php echo translate('result'); ?>
				</a>
			</li>
		</ul>
	</div>
</div>