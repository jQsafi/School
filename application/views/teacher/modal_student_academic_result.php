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
    /////SEMESTER WISE RESULT, RESULTSHEET FOR EACH SEMESTER SEPERATELY
    $toggle = true;
    $exams = $this->crud_model->get_exams();
    foreach ($exams as $row0):

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
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $row0['exam_id']; ?>">
                            <i class="icon-rss icon-1x"></i> <?php echo $row0['name']; ?>
                        </a>
                    </div>
                    <div id="collapse<?php echo $row0['exam_id']; ?>" class="accordion-body collapse <?php
//                    if ($toggle) {
//                        echo 'in';
//                        $toggle = false;
//                    }
        ?>" >
                        <div class="accordion-inner">
                            <center>

                                <div class="print-marksheet-container">

                                    <div>
                                        <h1> Nazirabad High School</h1>
                                        <p class="subheader"> Post : Churkhai Bazzar, Sadar, Mymensingh <br>
                                            <?php echo $row0['name']; ?> Mark-Sheet <br>
                                            Academic Year : 2014</p>
                                    </div>
                                    <hr>
                                    <div>
                                        <table class="student-info">
                                            <tr>
                                                <td><b>Name :</b> <?php echo $row1['name']; ?></td>
                                                <td><b>Group :</b> <?php echo $row1['group']; ?></td>					
                                            </tr>

                                            <tr>
                                                <td><b>Class :</b> <?php echo $row1['class_id']; ?></td>
                                                <td><b>Total Student :</b>
                                                    <?php
                                                    $total_students = $this->crud_model->get_students_by_class($row1['class_id']);
                                                    echo count($total_students['student_id']);
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><b>Section :</b> "<?php echo $row1['section']; ?>"</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div>
                                        <table class="table table-striped " >

                                            <thead>
                                                <tr>
                                                    <th width="37%" class="left-text">Subject </th>
                                                    <th width="7%">Form: </th>
                                                    <th width="7%">Obje: </th>
                                                    <th width="7%">Prac: </th>
                                                    <th width="7%">Total </th>
                                                    <th width="7%">80% </th>
                                                    <th width="7%">SBA</th>
                                                    <th width="7%">20% </th>
                                                    <th width="7%">Max </th>
                                                    <th width="7%">Grade </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $subjects = $this->crud_model->get_subjects_by_class($row1['class_id']);
                                                foreach ($subjects as $row2):
                                                    $total_subjects++;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row2['name']; ?></td>
                                                        <?php
                                                        //obtained marks
                                                        $verify_data = array('exam_id' => $row0['exam_id'],
                                                            'class_id' => $row1['class_id'],
                                                            'subject_id' => $row2['subject_id'],
                                                            'student_id' => $row1['student_id']);

                                                        $query = $this->db->get_where('mark', $verify_data);
                                                        $marks = $query->result_array();

                                                        foreach ($marks as $row3):
                                                            echo '<td>' . $row3['formation'] . '</td>';
                                                            echo '<td>' . $row3['objective'] . '</td>';
                                                            echo '<td>' . $row3['practical'] . '</td>';
                                                            $total_marks = $row3['formation'] + $row3['objective'] + $row3['practical'];
                                                            echo '<td>' . $total_marks . '</td>';
                                                            $total_marks_all_sub+=$total_marks;
                                                            $verify_data = array('exam_id' => $row0['exam_id'],
                                                                'subject_id' => $row2['subject_id']);
                                                            // $this->db->select_max('mark_obtained' , 'mark_highest');
                                                            $total_attendance+=$row3['attendance'];
                                                            $total_classday+=$row3['classday'];
                                                            $query = $this->db->get_where('mark', $verify_data);
                                                            $marks = $query->result_array();
                                                            /* 	print_r($marks);
                                                              exit; */
                                                            $markstolal = array();
                                                            $i = 0;
                                                            foreach ($marks as $row4):
                                                                $markstolal[$i] = $row4['formation'] + $row4['objective'] + $row4['practical'];
                                                                $i++;
                                                            endforeach;
                                                            /* print_r($markstolal);
                                                              exit; */

                                                            echo '<td>' . $total_marks * .8 . '</td>';
                                                            echo '<td>' . "SBA" . '</td>';


                                                            echo '<td>' . $total_marks * .2 . '</td>';
                                                            echo '<td>' . max($markstolal) . '</td>';
                                                            $grade = $this->crud_model->get_grade($total_marks);
                                                            $total+=$total_marks;
                                                            echo '<td>' . $grade['name'] . '</td>';

                                                            $total_grade_point += $grade['grade_point'];

                                                            $verify_data = array('exam_id' => $row0['exam_id'],
                                                                'subject_id' => $row2['subject_id']);
                                                            $this->db->select_max('practical', 'mark_highest');
                                                            $query = $this->db->get_where('mark', $verify_data);
                                                            $marks = $query->result_array();
                                                        endforeach;
                                                        ?>

                                                        <?php
                                                        $grade = $this->crud_model->get_grade($row3['mark_obtained']);
                                                        echo $grade['name'];
                                                        //$total_grade_point	+=	$grade['grade_point'];
                                                        ?>

                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <div style="float:left; width:90%; text-align:left;">
                                                            <p>Note : Return this card to class teacher with parents Signature & Comment in 5 days.</p>
                                                        </div>
                                                    </td>
                                                    <td colspan="5" style="padding: 0 3px 3px 3px;">
                                                        <table width="100%" style="text-align:right;">
                                                            <tr>
                                                                <td style="border-top:none; width:65%;">Grand Total</td>
                                                                <td style="border-top:none; width:35%;"><?php echo $total_marks_all_sub; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td>GPA</td>
                                                                <td><?php echo $totalgpa = round($total_grade_point / $total_subjects, 2); ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Grade</td>
                                                                <td><?php
                                                                    $gradeinfo = $this->crud_model->get_grade_from_gpa($totalgpa);
                                                                    echo $gradeinfo;
                                                                    ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Class Day</td>
                                                                <td><?php echo $total_classday; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <td>Total Present Day</td>
                                                                <td><?php echo $total_attendance; ?></td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>

                                    <table class="signature-table">
                                        <tr>
                                            <td>Parents <br> (Signature & Comments)</td>
                                            <td width="40%">Parents <br> (Signature & Comments)</td>
                                            <td>Parents <br> (Signature & Comments)</td>
                                        </tr>
                                    </table>

                                    <div style="clear:both;"> &nbsp; </div>
                                </div>
                        </div>
                    </div>
                </div>
        </center>
    <?php endforeach; ?>

    </div>
    </center>
<?php endforeach; ?>