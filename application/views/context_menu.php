<?php
	$login_type=$this->session->userdata("login_type");
	$system_name	=	get_single_value('system_name','settings');
?>
<script>
$(function()
{
	context.init({preventDoubleContext: true});
	context.settings({compress: true});
	context.attach('html', [
		{
			text: '<h4 style="padding:0;margin:0"><i class="uk-icon-reorder"></i><?=$system_name?></h4>'
		},
		{
			text: '<i class="uk-icon-home"></i><?=translate("dashboard","upper_case")?>', href: "<?=site_url( $login_type.'/dashboard')?>"
		},
		{divider: true},
		{
			text: '<i class="uk-icon-line-chart"></i><?=translate("fees_report","upper_case")?>', href: "<?=site_url( $login_type.'/fees_report')?>"
		},
		{divider: true},
		{
			text: '<i class="uk-icon-pencil"></i><?=translate("mark_input","upper_case")?>', href: "<?=site_url( $login_type.'/marks')?>"
		},
		{divider: true},
		{
			text:'<i class="uk-icon-file-text"></i><?=translate("progress_card","upper_case")?>',
			subMenu: 
			[
				
				{
					text:"<?=translate('details','upper_case')?>",href:"<?=site_url('progress_card/progresscard/details')?>"
				},
				{divider: true},
				{
					text:"<?=translate('sba','upper_case')?>",href:"<?=site_url('progress_card/progresscard/sba')?>"
				},
				{divider: true},
				{
					text:'<?=translate("short","upper_case")?>',href:'<?=site_url("progress_card/progresscard/grsc")?>'
				}
			]
		}
	]);
});
</script>