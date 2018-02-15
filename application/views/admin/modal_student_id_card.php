<?php
$student_info = $this->crud_model->get_student_info($current_student_id);
foreach ($student_info as $row):
    ?>
    <style>
        body {
            background-color: #000 !important;
        }
        .id-body {
            width: 330px;
            height: 495px;
            margin: 0 auto;
            display: block;
            overflow: hidden;      
			font-family: sans-serif;
			background: url(template/images/id_card/card_design12/design12-bg.svg) no-repeat;
        }
        .id-wrap {
            padding: 20px;
        }
        .id-card-photo {
            border: 3px solid #F05A28;
			width: 141px;
			height: 177px;
			margin: 42px 75px auto;
			text-align: center;
			border-radius: 20px;
			overflow: hidden;
			background-color:#fff;
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
		.logo {
			margin: 15px 0px 0px 9px;
		}
		
    </style>
    <div class="id-body">
        <div class="id-wrap">
            <!--ID Card Logo-->
            <div class="logo">
                <img src="<?php echo base_url(); ?>template/images/id_card/card_design6/school-logo.png" width="269" height="63">
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