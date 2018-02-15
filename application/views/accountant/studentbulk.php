

    <div class="box box-border">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <li class="active">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                        <?php echo translate('student_bulk'); ?>
                    </a>
                </li>  
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----TABLE LISTING STARTS--->
                <?if($error):?>
     <!--  <div id="error_message" class="  alert alert-info  " style="width:300px;">
                                <i class="icon-info-sign"></i> <?php echo $error; ?>
                            </div>  -->
                                             <script>
                                $(document).ready(function() {
                                                                                                                                                        						  	
                                    function shake()
                                    {
                                    Growl.info({title:"<?php echo $error; ?>",text:" "});    
                                    }
                                    setTimeout(shake, 500);
                                });
                            </script>
                <?endif?>

        <?php echo form_open('accountant/createxlsx/'); ?>
                         
                <div class="tab-pane  active" id="list">
                    <center>
                        <br />
                               <select name="class_id" onchange="setclassvalue(this.value)" >
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
                        
                </div>
                         <div align="center">
              <button id="send_btn" type="submit" class="btn btn-gray"><?php echo translate('download excel'); ?></button>
                  
                         </div><p></p>
                 <?php echo form_close();  ?>
                
            <?php echo form_open('accountant/upxlsandimport/', array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data')); ?>
                         <input type="hidden" name="Stclassid" id="Stclassid" value="">
                         <div align="center">
                            <span  class="btn btn-default btn-file">
                                Browse <input type="file" class="" name="xlfile" id="xlfile" />
                            </span>
                         </div><p></p>
                                             <div align="center">
                        <button id="send_btn" type="submit" class="btn btn-gray"><?php echo translate('Upload and Import excel'); ?></button>
                                             </div>
                <?php echo form_close();  ?>
                <!----TABLE LISTING ENDS--->
 
            </div>
        </div>
    </div>

<script>
    function setclassvalue(classid){
        document.getElementById("Stclassid").value=classid;
    }
</script>