<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <?php include 'includes.php'; ?>
        <title><?php echo translate('login'); ?> | <?php echo $system_title; ?></title>
    </head>
    <body>
        <div id="main_body">
            <?php if ($this->session->flashdata('flash_message') != ""): ?>
                <script>
                    $(document).ready(function() {
                        Growl.info({title:"<?php echo $this->session->flashdata('flash_message'); ?>",text:" "})
                    });
                </script>
            <?php endif; ?>
            <div class="navbar navbar-top navbar-inverse">
                <div class="navbar-inner">
                    <div class="container-fluid">

                        <a class="brand" href="<?php echo base_url(); ?>">
                            <?php echo $system_name; ?>
                        </a>

                        <ul class="nav pull-right">
							<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-wrench"></i>
							<?=translate('change_language')?> <b class="caret"></b></a>
							<!-- Language Selector -->
		                        <ul class="dropdown-menu">
									<li>
										<a href="<?=site_url('multilanguage/language/english')?>">
											<i class="icon-globe"></i><?=translate('english')?>
										</a>
									</li>
									<li>
										<a href="<?=site_url('multilanguage/language/bangla')?>">
											<i class="icon-globe"></i><?=translate('bangla','nochange')?>
										</a>
									</li>
		                        </ul>
		                	<!-- Language Selector -->
							</li>
						</ul>
						<ul class="nav pull-right">
									<li>
									<a href="#"><i class="icon-globe"></i><?=translate('current_language')?>:
									<?php echo translate($this->input->cookie('language'),'uppercase');?></a>
									</li>
						</ul>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="span4 offset4">
                    <div class="padded">
                        <center>
                            <!-- <img src="<?php echo base_url(); ?>uploads/logo.png" style="max-height:100px;margin:20px 0px;" />-->
                        </center>
                        <div class="login box box-border" style="margin-top: 10px;">
                            <div class="box-header">
                                <span class="title"><?php echo translate('login','upper_case'); ?></span>
                            </div>
                            <div class="box-content padded">
                                <script>
                                    function check_account_type() {
                                        var account_type = document.getElementById('account_selector').value;
                                        if (account_type == "") {
                                            Growl.info({title:"<?=translate('Please Select Your Account First')?>",text:" "})
                                            return false;
                                        }
                                        else return true;
                                    }
                                </script>
                                <?php echo form_open('login', array('class' => 'separate-sections', 'target'=>'_top','onsubmit' => 'return check_account_type()')); ?>
                                <center>
                                    <div style="height:100px;">
                                        <div id="avatar" class="avatar">
                                            <img src="<?php echo base_url(); ?>template/images/icons_big/account.png" class="avatar-big shrink"  id="account_img" style=""/>
                                        </div>
                                    </div>

									                                    <img src="<?php echo base_url(); ?>template/images/icons_big/admin.png" style="display:none;"/>
                                    <img src="<?php echo base_url(); ?>template/images/icons_big/admin.png" style="display:none;"/>
                                    <img src="<?php echo base_url(); ?>template/images/icons_big/accountant.png" style="display:none;"/>
                                    <img src="<?php echo base_url(); ?>template/images/icons_big/teacher.png" style="display:none;"/>
                                    <img src="<?php echo base_url(); ?>template/images/icons_big/student.png" style="display:none;"/>
                                    <img src="<?php echo base_url(); ?>template/images/icons_big/parent.png" style="display:none;"/>
                                </center>
                                <div class="">
                                    <select id="account_selector" class="validate[required]" name="login_type" style="width:100%;margin-bottom:0px !important;" >
                                        <option value=""><?php echo translate('select_account_type'); ?></option>
										<option value="superadmin"><?php echo translate('super_admin'); ?></option>
                                        <option value="admin"><?php echo translate('admin'); ?></option>
                                        <option value="accountant"><?php echo translate('accountant'); ?></option>
                                        <option value="teacher"><?php echo translate('teacher'); ?></option>
                                        <option value="student"><?php echo translate('student'); ?></option>
                                        <option value="parent"><?php echo translate('parent'); ?></option>
                                    </select>
                                </div>
                                <style>
                                    .flip_in{
                                        opacity:0;
                                        -moz-transform:rotateY(-90deg);
                                        -webkit-transform:rotateY(-90deg);
                                        transform:rotateY(-90deg);
                                        transition:.2s;
                                    }
                                    .flip_out{
                                        opacity:1;
                                        -moz-transform:rotateY(0deg);
                                        -webkit-transform:rotateY(0deg);
                                        transform:rotateY(0deg);
                                        transition:.2s;
                                    }
                                </style>

                                <script>
                                    $(document).ready(function(){
                                        $("#account_selector").change(function(){

                                            //squeezee in
                                            function rotate_in()
                                            {
                                                $('#avatar').toggleClass('flip_in');
                                            }
                                            setTimeout(rotate_in, 0);

                                            //change img src
                                            function set_img()
                                            {
                                                var img = document.getElementById('account_selector').value;
                                                if(img == "")
                                                    img	=	'account';
                                                $("#account_img").attr("src", "<?php echo base_url(); ?>template/images/icons_big/"+img+".png");
                                            }
                                            setTimeout(set_img, 200);

                                            //expand out
                                            function rotate_out()
                                            {
                                                $('#avatar').toggleClass('flip_out');
                                            }
                                            setTimeout(rotate_out, 200);

                                            //clear css
                                            function reset_class()
                                            {
                                                $("#avatar").attr("class", "avatar");
                                            }
                                            setTimeout(reset_class, 500);
                                        });
                                    });
                                </script>

                                <div class="input-prepend">
                                    <span class="add-on" >
                                        <i class="icon-user"></i>
                                    </span>
                                    <input name="email" type="text" placeholder="<?php echo translate('user_name'); ?>" style="text-transform:lowercase;">
                                </div>
                                <div class="input-prepend">
                                    <span class="add-on" >
                                        <i class="icon-key"></i>
                                    </span>
                                    <input name="password" type="password" placeholder="<?php echo translate('password'); ?>" autocomplete="off">
                                </div>
                                <div class="row-fluid">
                                    <div class="span6">
                                        <a  data-toggle="modal" href="#modal-simple"  class="btn btn-blue btn-block" >
                                            <?php echo translate('forgot_password'); ?> ?
                                        </a>
                                    </div>
                                    <div class="span6">
                                        <input type="submit" class="btn btn-gray btn-block "  value="<?php echo translate('login'); ?>"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <div style="color:#a5a5a5;">
                            <a href="http://primeintl-bd.com/" target="_blank">
                                <center>Copyright &copy; 2016, Prime International</center>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-----------password reset form ------>
        <div id="modal-simple" class="modal hide fade" style="top:30%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h6 id="modal-tablesLabel"><?php echo translate('reset_password'); ?></h6>
            </div>
            <div class="modal-body" style="padding:20px;">
                <?php echo form_open('login/reset_password'); ?>
                <select class="validate[required]" name="account_type"  style="margin-bottom: 0px !important;">
                     <option value=""><?php echo translate('select_account_type'); ?></option>
                    <option value="admin"><?php echo translate('admin'); ?></option>
                    <option value="admin"><?php echo translate('accountant'); ?></option>
                    <option value="teacher"><?php echo translate('teacher'); ?></option>
                    <option value="student"><?php echo translate('student'); ?></option>
                    <option value="parent"><?php echo translate('parent'); ?></option>
                </select>
                <input type="email" name="email"  placeholder="<?php echo translate('email'); ?>"  style="margin-bottom: 0px !important;"/>
                <input type="submit" value="<?php echo translate('reset'); ?>"  class="btn btn-blue btn-medium"/>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"><?=translate('close')?></button>
            </div>
        </div>
        <!-----------password reset form ------>
    </body>
</html>