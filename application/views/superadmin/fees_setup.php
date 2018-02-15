<div class="box box-border">
    <div class="box-header">

        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">            
            <!--<li class="active">
                <a href="#fees_setup_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('fees_setup_list'); ?>
                </a>
            </li>-->
            <!--<li>
                <a href="#fees_setup" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo translate('fees_setup'); ?>
                </a>
            </li>-->
            <li class="active">
                <a href="#fees_name_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo translate('fees_name_list'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo translate('add_new_fees'); ?>
                </a>
            </li>

        </ul>
        <!------CONTROL TABS END------->

        <style type="text/css">
            #fees_setup_list table {
                border: 1px solid #ddd;
            }
            #fees_setup_list .BG-WHITE {
                background: #fff;
            }
            #fees_setup_list .BG-GRAY {
                background-color: #ddd !important;
            }
        </style>

        <?php
        $count = 1;
        $fees_name = $this->crud_model->get_fees_name();
        ?>

    </div>
    <div class="box-content padded">
        <div class="tab-content">
            <!----FEE NAME LIST STARTS--->
            <div class="tab-pane box" id="fees_setup_list" style="padding: 5px">
                <div class="box-content">
                    <div class="padded">
                        <table cellpadding="0" cellspacing="0" border="0" class="table responsive">
                            <thead>
                                <tr>
                                    <th width="250px"><strong>S.I No</strong></th>
                                    <th><strong>Class</strong></th>
                                    <th><strong>Fees Name</strong></th>
                                    <th><strong>Fee Amount</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>                           
                            <tbody>
                                <?php
                                $this->db->order_by("class_id", "asc");
                                $fees_setup_data = $this->db->get('fees_setup')->result_array();
                                foreach ($fees_setup_data as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $this->crud_model->get_class_name($row['class_id']); ?></td>
                                        <td>
                                            <?php
                                            $fee_name = $this->crud_model->get_fees_name_by_id($row['fees_name_id']);
                                            echo get_phrase($fee_name[0]['fee_name']);
                                            ?>
                                        </td>
                                        <td><?php echo $row['fees_amount']; ?></td>
                                        <td>
                                            <a data-toggle="modal" href="#modal-form" onclick="modal('edit_fees_setup',<?php echo $row['class_id']; ?>)" class="btn btn-gray btn-small">
                                                <i class="icon-wrench"></i> <?php echo translate('edit'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $count++;
                                endforeach;
                                ?>          
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
            <!----FEE NAME LIST ENDS--->   
            <!----Fees SETUP CREATE STARTS---->
            <div class="tab-pane box" id="fees_setup" style="padding: 5px">
                <div class="box-content">
                    <!-- <form action="http://localhost/school-management-system/index.php?/admin/fees_setup/monthly_fees/do_update" method="post" accept-charset="utf-8" class="form-horizontal validatable" target="_top">-->
                    <?php echo form_open('admin/fees_setup/set_fees', array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>    
                    <div class="padded">
                        <p class="error-msg" style="color: #E83338; font-weight: bold; display: none;">Data already exist. Please try another one.</p>
                        <div class="control-group">
                            <label class="control-label">Class</label>
                            <div class="controls">
                                <select class="classID" name="data[<?php echo $count; ?>][class_id]" style="width:350px;" required="">
                                    <option value="">Select class</option>
                                    <?php
                                    $this->db->order_by('class_id', 'asc');
                                    $classes = $this->db->get('class')->result_array();
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id']; ?>">
                                        <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <?php
                        foreach ($fees_name as $fee_name_info):
                            ?>
                            <div class="control-group">
                                <label class="control-label"><?php echo translate($fee_name_info['fee_name']); ?></label>
                                <div class="controls">
                                    <input type="text" class="fee_<?php echo $count; ?>" name="data[<?php echo $count; ?>][fees_amount]" value="" number>
                                    <input type="hidden" class="fee_<?php echo $count; ?>" name="data[<?php echo $count; ?>][fees_name_id]" value="<?php echo $fee_name_info['fees_name_id']; ?>">
                                </div>
                            </div>
                            <?php $count++;
                        endforeach;
                        ?>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo translate('add_fees'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <!----FEES LIST ENDS--->

            <!----FEE NAME LIST STARTS--->
            <div class="tab-pane box active" id="fees_name_list" style="padding: 5px">
                <div class="box-content">
                    <div class="padded">
                        <table class="table-striped table tablesorter">
							<thead>
                            <tr>
                                <th width="250px"><strong>Fees Name</strong></th>
                            </tr>
							</thead>
							<tbody>
                            <?php
                            //$fees_name = $this->crud_model->get_fees_name(); 
                            foreach ($fees_name as $name):
                                ?>
                                <tr>
                                    <td><?php echo $name['fee_full_name']; ?></td>
                                </tr>
                            <?php endforeach; ?>          
							</tbody>
                        </table>                        
                    </div>
                </div>
            </div>
            <!----FEE NAME LIST ENDS--->   

            <!----ADD NEW FEES STARTS--->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/fees_setup/create', array('class' => 'form-horizontal validatable', 'target' => '_top')); ?>    
                    <div class="padded">                        
                        <div class="control-group">
                            <label class="control-label">Fees Name</label>
                            <div class="controls">
                                <input type="text" class="" name="fee_name" value="">
                            </div>
                        </div>                        
						<div class="control-group">
                            <label class="control-label">Montly</label>
                            <div class="controls">
                                <input type="checkbox" class="" name="montly_fee" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-gray"><?php echo translate('add_new_fees'); ?></button>
                    </div>
                   <?php echo form_close(); ?>
                </div>
            </div>
            <!----ADD NEW FEES ENDS--->                

        </div>
    </div>
</div>

<script type="text/javascript">    
    $("select.classID").on("change", function(event) {
        event.preventDefault();        
        var class_id = $('select.classID option:selected').val();
        
        $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>/index.php?admin/fees_setup/set_fees_by_class/"+class_id,
            dataType: "html",
            success: function(data){
                try {
                    if(data == 'not_exist'){
                        $(".form-actions button").show();
                        $('p.error-msg').hide();
						$("input").removeAttr("disabled","true");
                    }else {
                        $(".form-actions button").hide();
                        $('p.error-msg').show();
						$("input").attr("disabled","false");
//                        var obj_data = $.parseJSON(data);                     
//                        var class_id;
//                        $.each(obj_data, function(key, fee_data) {
//                            class_id = fee_data.class_id;
//                        });
//                        alert("Class "+class_id+ "already exist.");
                    }                    
                }catch(e) {
                    alert('Exception while request..');
                }
            },
            error: function(){
                alert('Error while request..');
            }
        });
        return false;
    });
</script>