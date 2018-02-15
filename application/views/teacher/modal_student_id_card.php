<?php
$student_info = $this->crud_model->get_student_info($current_student_id);
foreach ($student_info as $row):
    ?>
    <style>
        body {
            background-color: #fff !important;
        }
        .id-body {
            width: 330px;
            height: 495px;
            margin: 0 auto;
            background-color: #f4ffe6;
            display: block;
            overflow: hidden;
            border-bottom: 10px solid #7fb742;
        }
        .id-wrap {
            padding: 20px;
        }
        .id-card-photo {
            border: 3px solid #7fb742;
            width: 141px;
            height: 177px;
            margin: auto;
            text-align: center;	
            margin-top: 40px;
        }
        .id-card-photo img {
            width: 141px;
            height: 177px;
        }
        .id-wrap table {
            margin-top:30px;
            font-size: 16px;
            line-height: 26px;
        }
    </style>
    <div class="id-body">
        <div class="id-wrap">
            <!--ID Card Logo-->
            <div>
                <img src="<?php echo base_url(); ?>uploads/id_card_img/logo.png" width="269" height="63">
            </div>
            <!--ID Card Logo-->

            <!--ID Card Photo-->
            <div class="id-card-photo">
                <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" alt="<?php echo $row['name']; ?>" title="<?php echo $row['name']; ?>">
            </div><!--ID Card Photo-->

            <!--ID Card Information-->
            <div>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="left"><?php echo translate('student_ID'); ?></td>
                        <td align="left">: <?php echo $row['student_id']; ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo translate('student_name'); ?></td>
                        <td align="left">: <?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo translate('class'); ?></td>
                        <td align="left">: <?php echo $this->crud_model->get_class_name($row['class_id']); ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo translate('class_roll'); ?></td>
                        <td align="left">: <?php echo $row['roll']; ?></td>
                    </tr>
                    <tr>
                        <td align="left"><?php echo translate('guardian_name '); ?></td>
                        <td align="left">: <?php echo $row['guardian_name']; ?></td>
                    </tr>
                </table>					    
            </div>
            <!--ID Card Information-->
        </div>
    </div>

<?php endforeach; ?>

<?php /*
$student_info	=	$this->crud_model->get_student_info($current_student_id);
foreach($student_info as $row):?>

	<div style="background-color: #2A3542;text-align: left;color: #fff;font-size: 21px;font-weight: 100;padding-left:20px;margin-top:60px;">
    	<img src="<?php echo base_url();?>uploads/logo.png"  
        	style="max-height:60px; max-width:100px; vertical-align:text-bottom;"/>
				<?php echo $system_name;?>
    </div>
<style>
.idcard_text
{
	padding: 6px;
	font-weight: 100;
	font-size: 13px;
}
</style>
	<table width="100%" border="0" style="background-color:#fff; font-size:13px;">
      <tr>
        <td rowspan="6" width="170" valign="top">
        	<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" 
                 style="max-height:130px;max-width:130px;border-radius: 10%;margin:20px;" />
        </td>
        <td class="idcard_text" width="100" style="padding-top:16px;"><?php echo translate('name');?></td>
        <td class="idcard_text" style="padding-top:16px;"><?php echo $row['name'];?></td>
      </tr>
      <tr>
        <td class="idcard_text"><?php echo translate('class');?></td>
        <td class="idcard_text"><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
      </tr>
      <tr>
        <td class="idcard_text"><?php echo translate('roll');?></td>
        <td class="idcard_text"><?php echo $row['roll'];?></td>
      </tr>
      <tr>
        <td class="idcard_text"><?php echo translate('birthday');?></td>
        <td class="idcard_text"><?php echo $row['birthday'];?></td>
      </tr>
      <tr>
        <td class="idcard_text"><?php echo translate('sex');?></td>
        <td class="idcard_text"><?php echo $row['sex'];?></td>
      </tr>
      <tr>
        <td class="idcard_text"><?php echo translate('blood_group');?></td>
        <td class="idcard_text"><?php echo $row['blood_group'];?></td>
      </tr>
      <tr>
        <td colspan="3" style="background-color:#D9E6E9;font-size:10px; text-align:right;padding:8px;">&copy; 2013</td>
      </tr>
    </table>

<?php endforeach;?>