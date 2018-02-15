$(function()
{
	
	context.init({preventDoubleContext: false});
	
	
	context.settings({compress: true});
	
	context.attach('body', [
		{
			header: 'Shortcuts'
		},
		{
			text: '<i class="uk-icon-home"></i> Home', href: '#'
		},
		{divider: true},
		{
			text: 'Reload', href: '#'
		},
		{divider: true},
		{
			text:"Save As",
			subMenu: 
			[
				{
					header:"Save As"
				},
				{
					text:"PDF",href:"#"
				}
			]
		}
	]);
});