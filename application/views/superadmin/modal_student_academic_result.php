<style type="text/css">
    .print-marksheet-container {
        margin-left:auto;
        margin-right:auto;
        text-align:center;
        max-width:1000px;
        height:auto;
        border: 1px #bbb solid;
        padding:20px;
        font-family:Tahoma, Geneva, sans-serif;
        background-color:#fffcf2;
    }
    .print-marksheet-container h1{
        padding:0;
        margin:0;
        /*        line-height:18px;
                font-size:40px;*/
    }

    .subheader {
        font-size:20px;
        font-weight:400;
    }


    .left-text {
        text-align:left;
    }

    table > tr > td {
        text-align:left !important;
    }

    table {
        width:100%;
        border-spacing: 0;
        border-collapse: collapse;
    }
    td, th {
        padding: 4px 4px;
        border: 1px #000 solid;
    }

    th {
        background-color:#e4e4e4;
    }

    .td-bg-color {
        background-color:#faf7ef !important;
    }

    .student-info {
        margin-bottom:10px;
    }

    .student-info td {
        border:none;
        text-align:left;
    }

    .signature-table td{
        border:none;
        padding:0;
        padding-top:80px;
    }
    @media print {
        .print-marksheet-container h1{
            height: 18px;
            line-height:18px;
        }
        .accordion-heading,
        .print-marksheet-container {
            display: none;
        }
        .accordion-body.collapse.in .print-marksheet-container {
            border: none;
            padding:0;
            margin-top:20px;
            display: block !important;
        }
    }


</style>
<?php
$student_info = $this->crud_model->get_student_info($current_student_id);
foreach ($student_info as $row1):

    ?>

    <?php
	$student_id=$row1['student_id'];
	$class_id=$row1['class_id'];
    /////SEMESTER WISE RESULT, RESULTSHEET FOR EACH SEMESTER SEPERATELY
    $toggle = true;
    $exams = $this->crud_model->get_exams();
    foreach ($exams as $row0):
        $orginal_total_mark_all=0;
        $total_grade_point = 0;
        $total_marks_all_sub = 0;
        $total_marks = 0;
        $total = 0;
        $total_subjects = 0;
        $total_attendance = 0;
        $total_classday = 0;
        ?>
        <center>
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
							<a class="accordion-toggle" href="<?php echo base_url();?>index.php?/progress_card/details/details/<?php echo $student_id.'/'.$row0['exam_id'].'/'.$class_id; ?>"  window="new" win_height="816px" win_width="1400px">
                            <i class="icon-rss icon-1x"></i> <?php echo $row0['name']; ?>
                        </a>
                    </div>
                </div>
        </center>
    <?php endforeach; ?>

    </div>
    </center>
<?php endforeach; ?>