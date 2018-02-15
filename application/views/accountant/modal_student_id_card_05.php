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
			background: url(template/images/id_card/card_design4/design4-bg.svg) no-repeat;
       }
        .id-wrap {
            padding: 20px;
        }
        .id-card-photo {
            border: 2px solid #436002;
			width: 141px;
			height: 177px;
			margin: 85px auto auto;
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
            line-height: 20px;
			font-size:12px;
			color:black;
			font-weight: bold;
        }
		
		.id-wrap table th{
			color:black;
			width:45%;
        }
		
    </style>
    <div class="id-body">
        <div class="id-wrap">
            <!--ID Card Logo-->
            <div>
                <img src="<?php echo base_url(); ?>template/images/id_card/card_design4/school-logo.png" width="269" height="63">
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
                        <th align="left"><?php echo translate('student_ID'); ?></th>
                        <td align="left">: <?php echo $row['student_id']; ?></td>
                    </tr>
                    <tr>
                        <th align="left"><?php echo translate('student_name'); ?></th>
                        <td align="left">: <?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <th align="left"><?php echo translate('class'); ?></th>
                        <td align="left">: <?php echo $this->crud_model->get_class_name($row['class_id']); ?></td>
                    </tr>
                    <tr>
                        <th align="left"><?php echo translate('class_roll'); ?></th>
                        <td align="left">: <?php echo $row['roll']; ?></td>
                    </tr>
                    <tr>
                        <th align="left"><?php echo translate('guardian_name '); ?></th>
                        <td align="left">: <?php echo $row['guardian_name']; ?></td>
                    </tr>
                </table>					    
            </div>
            <!--ID Card Information-->
        </div>
    </div>

<?php endforeach; ?>