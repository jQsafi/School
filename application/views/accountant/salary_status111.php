<div class="box box-border">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#monthly" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo translate('Salary Sheet');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
           <!----monthly report genarate start--->
		
		<div class="tab-pane active" id="monthly">
            <center>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-normal box">                   
                    <tr>
                        <td>
                           <div class="control-group">
                                <label class="control-label"><?php echo translate('Month'); ?></label>
                                <div class="controls">
                                    <select name="month" class="expenseBy" id="monthstatus">
											<option value="">Please select</option>
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
                            </div> 
                        </td>
                        <td>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate('year'); ?></label>
                                <div class="controls">
                                    <select name="year" class="expenseID" id="yearstatus">
                                        <option value="">Please select</option>
                                     <?php
									 $starting_year  = 2014;
									 $ending_year    = date('Y');

									 for($thisYear; $starting_year <= $ending_year; $starting_year++) {
									 
									  print '<option value="'.$starting_year.'">'.$starting_year.'</option>';
									}

							        ?>	
                                    </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="operation" value="selection" />
                            <a data-toggle="modal" href="#modal-form" onclick="modal('month_salary',document.getElementById('monthstatus').value,document.getElementById('yearstatus').value)"
                                                 class="btn btn-default btn-small">
                                                    <i class="icon-user"></i> <?php echo translate('Salary Sheet');?>
                                            </a>
                        </td>
                    </tr>
                </table>
            </center>


            <br /><br />          
        </div>
        <!----monthly report genarate ENDS--->
            
            
		</div>
	</div>
</div>
<script>
	function link_generate(m,v)
	{
		
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
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>