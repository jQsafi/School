	<div class="container-fluid padded">
		<?php
			$this->load->view('common/student_counter');
		?>
	</div>


<script>
    $(document).ready(function() {

        // page is now ready, initialize the calendar...

        $("#calendar2").fullCalendar({
            header: {
                left: "prev,next",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            editable: 0,
            droppable: 0,
            /*drop: function (e, t) {
              var n, r;
              r = $(this).data("eventObject"), n = $.extend({}, r), n.start = e, n.allDay = t, $("#calendar").fullCalendar("renderEvent", n, !0);
              if ($("#drop-remove").is(":checked")) return $(this).remove()
          },*/
            events: [
                <?php
                    $notices = $this->db->get('noticeboard')->result_array();
                    foreach ($notices as $row):
                        ?>
                        {
                            title: "<?php echo $row['notice_title']; ?>",
                            start: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>),
                            end: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>) 
                        },
                        <?php
                    endforeach
                ?>
            ]
        })

    });
</script>