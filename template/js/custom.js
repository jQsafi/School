$(document).ready(function()
{


$(".country").change(function()
{
var id=$(this).val();
var dataString = 'id='+ id;

$.ajax
({
type: "POST",
url: "ajax_city.php",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
}
});

});

});


function manageattendance(baseurl)
{
var classid=$("#classid").val();
var subjectid=$("#subjectid").val();
var dataString = 'classid='+ classid+'subjectid='+ subjectid;
$.ajax
({
type: "POST",
url: baseurl+"index.php?admin/attendance/",
data: dataString,
cache: false,
success: function(html)
{
alert("hi");
},
error:function(html)
{
alert("error");
}
});

}