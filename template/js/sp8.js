$(function()
{
	$("[window]").click(function(e)
	{
		e.preventDefault();
		$this=$(this);
		var goto=$this.attr('href');
		var height=$this.attr("win_height");
		var width=$this.attr("win_width");
		var width=$this.attr("win_width");
		var win = window.open(goto,'','width='+width+',height='+height+',menubar=yes,status=no,directories=no,scrollbars=yes,resizable=yes,toolbar=no');
		win.focus();
		return true;
	});
	$(".tablesorter").tablesorter({"sortMultisortKey":"shiftKey"});
	/*document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);*/
$('.check_all').change(function(event) 
{
    if(this.checked) {
          $(".check").each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.check').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }   
        
   });
   $("[print]").click(function(e)
   {
   		e.preventDefault();
		var elem=$(this).attr('print');
		var content=$(elem).parent().html();
		var height=$(elem).height()+"px";
		var width=$(elem).width()+"px";
	   var mywindow = window.open('', 'Print','width='+width+',height='+height+',menubar=yes,status=yes,directories=no,scrollbars=yes,resizable=no,toolbar=no');
        mywindow.document.write('<html><head><meta name="viewport" content="width=device-width, target-densitydpi=device-dpi"><meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"><title>Print</title>');
		mywindow.document.write('<link rel="stylesheet" href="'+base_url+'template/css/font.css" type="text/css">');
        mywindow.document.write('<link rel="stylesheet" href="'+base_url+'template/css/schoolsoft.css" type="text/css">');
        mywindow.document.write('</head><body style="padding:0;margin:0;">');
        mywindow.document.write(content);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
		mywindow.close();
        return true;
   });
   $("[target='frame']").click(function()
   {
   		$("#loading").show();
   });
	$("#frame").load( function()
	{
   		$("#loading").hide();
	});
	$('.combobox').combobox();
	$(".round").corner();
	$(".bevel").corner("bevel");
	$(".notch").corner("notch");
	$(".bite").corner("bite");
	$(".cool").corner("cool");
	$(".sharp").corner("sharp");
	$(".slide").corner("slide");
	$(".jut").corner("jut");
	$(".curl").corner("curl");
	$(".tear").corner("tear");
	$(".fray").corner("fray");
	$(".wicked").corner("wicked");
	$(".sculpt").corner("sculpt");
	$(".long").corner("long");
	$(".dog").corner("dog");
	$(".dog2").corner("dog2");
	$(".dog3").corner("dog3");
	$(".dogfold").corner("dogfold");
	$(".bevelfold").corner("bevelfold");
	$(".steep").corner("steep");
	$(".invsteep").corner("invsteep");
});