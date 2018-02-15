<?php if ($teacher_id != ""): ?>
    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                
                <?php if ($this->session->userdata('user_role') != 'accountant') { ?>
                    <li>
                        <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                            <?php echo translate('salary_genarate'); ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <div class="tab-pane  active" id="list">
                    <center>
                        <br />
                        <select name="teacher_id" onchange="window.location='<?php echo base_url(); ?>index.php?admin/salary_genarate/salary_info/'+this.value">
                            <option value=""><?php echo translate('Select a Teacher and Stuff'); ?></option>
                            <?php
                            $classes = $this->db->get('teacher')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['teacher_id']; ?>"
                                        <?php if ($teacher_id == $row['teacher_id']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <br /><br />
                        <?php if ($teacher_id == ''): ?>
                            <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                                <i class="icon-info-sign"></i> Select a Teacher & Stuff For Salary Adjustments.
                            </div>
                            <script>
                                $(document).ready(function() {
                                                                                                                                                        						  	
                                    function shake()
                                    {
                                        $( "#ask_class" ).effect( "shake" );
                                    }
                                    setTimeout(shake, 500);
                                });
                            </script>
                            <br /><br />
                        <?php endif; ?>
                        <?php if ($teacher_id != ''): ?>
                        </center>
                        <div class="box">
                            <div class="box-content">
                                <div class="box-content">
                	<?php echo form_open('admin/salary_genarate/create' , array('class' => 'form-horizontal validatable','target'=>'_self', 'enctype' => 'multipart/form-data'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?admin/salary_genarate/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
						
						 <div class="control-group">
									<input type="hidden" name="eid" value="<?php echo $teacher_id;?>" />
                            </div>
						<div class="control-group">
									<input type="hidden" name="employeeID" value="<?php echo $employeeID;?>"  />
                            </div>
							
						    <div class="control-group">
                                <label class="control-label"><?php echo translate('employee Name');?></label>
									<input type="text" name="ename" value="<?php echo $Ename;?>" DISABLED />
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Designation');?></label>
									<input type="text" name="dname" value="<?php echo $designation;?>" DISABLED />
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('month');?></label>
									<select name="month" class="uniform" style="width:100%;">
                                            <option value="">- Select month -</option>    
											<?php
											$currentmonth=date("n");
                                            $months = $this->db->get('month')->result_array();
											foreach ($months as $row3):
											?>
											 <?php if ($row3['id']<=$currentmonth): ?>
											<option value="<?php echo $row3['id']; ?>"><?php echo $row3['name']; ?></option>
											<?php endif; ?>
											<?php
											endforeach;
											?>
                                        </select>
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('year');?></label>
								<select name="year" class="uniform" style="width:100%;">
								<?php
									 $starting_year  = 2014;
									 $ending_year    = date('Y');

									 for($thisYear; $starting_year <= $ending_year; $starting_year++) {
									 
									  print '<option value="'.$starting_year.'">'.$starting_year.'</option>';
									}

							?>							
							</select>
                            </div>
							<?php
							foreach($basicsalary as $row):
							?>
						  <div class="control-group">
                                <label class="control-label"><?php echo translate('Basic');?></label>
                                    <input type="text" name="Basic" value="<?php echo $row['Basic'];?>" readonly="" />TK.
                            </div>
							
							
						
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('Medical_Allowance');?></label>
									<input type="text" name="MedicalAllowance" readonly placeholder="amount in Taka" value="<?php echo $row['MedicalAllowance'];?>" />TK.
                            </div>
                            
                            
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('House_Rent');?></label>
									<input type="text" name="HouseRent" readonly placeholder="amount in Taka" value="<?php echo $row['HouseRent'];?>" />TK.
                                </div>
                            
                            
                              
                             <div class="control-group">
                                <label class="control-label"><?php echo translate('Convince');?></label>
									<input type="text" name="Convince" readonly placeholder="amount in Taka" value="<?php echo $row['Convince'];?>" />TK.
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Others');?></label>
									<input type="text" name="Others"  placeholder="amount in Taka" value="<?php echo $row['Others'];?>" DISABLED />TK.
                            </div>
                            
							<div class="control-group">
                                    <label class="control-label"><?php echo translate('Working_Day'); ?></label>
                                        <input type="text" name="WorkingHour" value="<?php echo $row['WorkingHour'];?>" />
                            </div>
							<div class="control-group">
                                    <label class="control-label">Present Day</label>
                                        <input type="text" name="present_day" value="<?php echo $row['present_day'];?>" />
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Tax');?></label>
									<input type="text" name="Tax"  placeholder="amount in Taka" value="<?php echo $row['Tax'];?>" DISABLED />TK.
                            </div>

							<div class="control-group">
                                <label class="control-label"><?php echo translate('Advance');?></label>
									<input type="text" name="Advance" placeholder="amount in Taka" value="<?php echo $row['Advance'];?>" />TK.
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('Deduction');?></label>
									<input type="text" name="Deduction"  placeholder="amount in Taka" value="<?php echo $row['Deduction'];?>" />TK.
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('bonus');?></label>
									<input type="text" name="bonus" placeholder="amount in Taka"  />TK.
                            </div>
							
							<div class="control-group">
                                <label class="control-label"><?php echo translate('loan');?></label>
									<input type="text" name="loan" placeholder="amount in Taka"  />TK.
                            </div>
							<div class="control-group">
                                <label class="control-label"><?php echo translate('pf','upper_case');?></label>
									<input type="text" name="pf" value="<?=$row['pf']?>" readonly=""/>TK.
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('notes');?></label>
                                    <input type="text"  name="notes" value="<?php echo $row['Note'];?>" />
                            </div>
                          <?php
                            endforeach;
                            ?>   
							
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo translate('genarate_salary');?></button>
                        </div>
                    </form>  

					
                </div>    
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!----TABLE LISTING ENDS--->


                <!----CREATION FORM STARTS---->
                <div class="tab-pane box add-student-container" id="add" style="padding: 5px"> 
                                     
                </div>
                <!----CREATION FORM ENDS--->  
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($teacher_id == ""): ?>
    <center>
        <div class="span5" style="float:none !important;">
            <div class="box box-border">
                <div class="box-header">
                    <span class="title"> <i class="icon-info-sign"></i> Select a Teacher & Stuff For Salary Adjustments.</span>
                </div>
                <div class="box-content padded">
                    <br />
                    <select name="teacher_id" onchange="window.location='<?php echo base_url(); ?>index.php?admin/salary_genarate/salary_info/'+this.value">
                        <option value=""><?php echo translate('select_a_staff'); ?></option>
                        <?php
                        $classes = $this->db->get('teacher')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <option value="<?php echo $row['teacher_id']; ?>"
                                    <?php if ($teacher_id == $row['teacher_id']) echo 'selected'; ?>>
                                <?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <hr />
                    <script>
                        $(document).ready(function() {
                            function ask()
                            {
                                Growl.info({title:"Select a Teacher & Stuff For Salary Adjustments",text:" "});
                            }
                            setTimeout(ask, 500);
                        });
                    </script>
                </div>
            </div>
        </div>
    </center>
<?php endif; ?>
<script>

jQuery(function($) {

    $('form').bind('submit', function() {
        $(this).find(':input').removeAttr('disabled');
    });

});

$(document).ready(function () {
	   $("input[name='groups']").change(function () {
	      var maxAllowed = 2;
	      var cnt = $("input[name='groups']:checked").length;
	      if (cnt > maxAllowed)
	      {
	         $(this).prop("checked", "");
	         alert('Select maximum ' + maxAllowed + ' Subjects!');
	     }
  });
  });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }            
            reader.readAsDataURL(input.files[0]);
        }
    }
	  
	
	  
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>

<script>

function designationfn(teacherid)
{
var baseurl=$("#baseurl").val();
alert(teacherid+baseurl);

$.ajax
({
type: "POST",
url: baseurl+"index.php?admin/teacherid/"+teacherid,

cache: false,
success: function(html)
{
alert(html);
},
error:function(html)
{
alert("error");
}
});

}
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
	function changevalue1(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#MedicalAllowance").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue2(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#HouseRent").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	
	function changevalue3(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Convince").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue4(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Tax").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue5(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Others").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue6(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Advance").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	function changevalue7(percentage){
	var basic=$("#Basic").val();
	if(basic)
	{
	var changeamount=(basic*percentage)/100;
	$("#Deduction").val(changeamount);
	}
	else
	alert("Please Give Basic Salary amount.");
	}
	
	
	
	
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>