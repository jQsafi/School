
<?php if ($class_id != ""): ?>
    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo translate('student_list'); ?>
                    </a>
                </li>  
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <div class="tab-pane  active" id="list">
                    <center>
                        <br />
                        <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?admin/student/'+this.value">
                            <option value=""><?php echo translate('select_a_class'); ?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>
                                <option value="<?php echo $row['class_id']; ?>"
                                        <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                    Class <?php echo $row['name']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                        <br /><br />
                        <?php if ($class_id == ''): ?>
                            <div id="ask_class" class="  alert alert-info  " style="width:300px;">
                                <i class="icon-info-sign"></i> Please select a class to manage student.
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
                        <?php if ($class_id != ''): ?>

                            <div class="action-nav-normal">
                                <div class=" action-nav-button" style="width:300px;">
                                    <a href="#" title="Users">
                                        <img src="<?php echo base_url(); ?>template/images/icons/user.png" />
                                        <span>Total <?php echo count($students); ?> students</span>
                                    </a>
                                </div>
                            </div>
                        </center>
                        <div class="box">
                            <div class="box-content">
                                <div id="dataTables">
                                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive ">
                                        <thead>
                                        <tr>
										<th><div><?php echo translate('ID'); ?></div></th>
                                        <th><div><?php echo translate('roll'); ?></div></th>
                                        <th><div><?php echo translate('photo'); ?></div></th>
                                        <th><div><?php echo translate('student_name'); ?></div></th>
                                         <th><div><?php echo translate('father_name'); ?></div></th>
                                        <th><div><?php echo translate('present_address'); ?></div></th>
                                        <th><div><?php echo translate('group'); ?></div></th>
                                         <th><div><?php echo translate('section'); ?></div></th>
                                        <th><div><?php echo translate('options'); ?></div></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($students as $row):
                                                ?>
                                                <tr>
													<td align="center"><?php echo $row['student_unique_ID']; ?></td>
                                                    <td align="center"><?php echo $row['roll']; ?></td>
                                                    <td align="center"><div class="avatar"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="avatar-medium" /></div></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                      <td><?php echo $row['father_name']; ?></td>
                                                    <td><?php echo $row['present_address']; ?></td>
                                                    <td><?php $group_name=get_single_value('group_name','group',array('group_id'=>$row['group'])); if($group_name) echo $group_name; ?></td>
                                                     <td><?php echo $row['section']; ?></td>
                                                    <td align="center">
                                                      <div class="btn-group action-dropdown">
                                                       <button class="btn btn-gray btn-normal dropdown-toggle" data-toggle="dropdown">
                                                       Action
                                                        </button>
                                                        
                                                        <ul class="dropdown-menu">
                                                            <li> 
															<a  href="<?php echo site_url('modal/popup/student_profile/'.$row['student_id']);?>" window="new" win_height="816px" win_width="800px">
															<!--onclick="modal('student_profile',<?php echo $row['student_id']; ?>)" class=""-->
                                                            <i class="icon-user"></i> <?php echo translate('profile'); ?>
                                                        </a></li>
                                                        
                                                        <li> <a  data-toggle="modal" href="#modal-form" onclick="modal('student_academic_result',<?php echo $row['student_id']; ?>)" class="">
                                                            <i class="icon-file-alt"></i> <?php echo translate('marksheet'); ?>
                                                        </a></li>
                                                        <li> <a  data-toggle="modal" href="#modal-form" onclick="modal('student_id_card',<?php echo $row['student_id']; ?>)" class="">
                                                            <i class="icon-credit-card"></i> <?php echo translate('id_card'); ?>
                                                        </a></li>
                                                        <li>   <?php 
														if ($this->session->userdata('user_role') != 'accountant') { ?>
                                                            <a href="<?php echo site_url('modal/popup/edit_student/'.$row['student_id']);?>" window="new" win_height="800px" win_width="1000px"><i class="icon-wrench"></i> <?php echo translate('edit'); ?></a>
															</li>
                                                            <li> <a  data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url(); ?>index.php?admin/student/<?php echo $class_id; ?>/delete/<?php echo $row['student_id']; ?>')" class="">
                                                                <i class="icon-trash"></i> <?php echo translate('delete'); ?>
                                                            </a></li>
                                                        </ul>
                                                       
                                                       
                                                       
                                                     
                                                           
                                                        <?php } ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!----TABLE LISTING ENDS--->
 
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if ($class_id == ""): ?>
    <center>
        <div class="span5" style="float:none !important;">
            <div class="box box-border">
                <div class="box-header">
                    <span class="title"> <i class="icon-info-sign"></i> Please select a class to manage student.</span>
                </div>
                <div class="box-content padded">
                    <br />
                    <select name="class_id" onchange="window.location='<?php echo base_url(); ?>index.php?admin/student/'+this.value">
                        <option value=""><?php echo translate('select_a_class'); ?></option>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <option value="<?php echo $row['class_id']; ?>"
                                    <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                Class <?php echo $row['name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                    <hr />
                    <script>
                        $(document).ready(function() {
                            function ask()
                            {
                                Growl.info({title:"Select a class to manage student",text:" "});
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
	  
	function groupselection(value){
	var classid=$("#class_id").val();
	if(classid==11)
	{
	if(value=="science")
		{
		$("#science").css({ "display": "block" }); 
		$("#Business").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value=="commerce")
		{
		$("#Business").css({ "display": "block" });
		$("#science").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value=="humanities")
		{
		$("#Humanities").css({ "display": "block" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });		
		}
	}
	
	}  

	function groupselectionold(value){
	var classid=$("#re_class_id").val();

	if(classid==10||classid==9)
	{
	if(value=="science")
		{
		$("#forthsubjectscience").css({ "display": "block" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		$("#science").css({ "display": "none" }); 
		$("#Business").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value=="commerce")
		{
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "block" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		$("#Business").css({ "display": "none" });
		$("#science").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		}
	if(value=="humanities")
		{
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "block" });
		$("#Humanities").css({ "display": "none" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });		
		}
	}
	else if(classid==11)
	{
	if(value=="science")
		{
		$("#science").css({ "display": "block" }); 
		$("#Business").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		}
	if(value=="commerce")
		{
		$("#Business").css({ "display": "block" });
		$("#science").css({ "display": "none" });
		$("#Humanities").css({ "display": "none" });
		$("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });
		}
	if(value=="humanities")
		{
		$("#Humanities").css({ "display": "block" });
        $("#science").css({ "display": "none" });
        $("#Business").css({ "display": "none" });	
        $("#forthsubjectscience").css({ "display": "none" }); 
		$("#forthsubjectbusiness").css({ "display": "none" });
		$("#forthsubjecthumnaties").css({ "display": "none" });		
		}
	}
	
	
	} 
	  
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>