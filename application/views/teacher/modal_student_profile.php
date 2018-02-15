<?php
$student_info = $this->crud_model->get_student_info($current_student_id);
foreach ($student_info as $row):
    ?>
    <center>
        <div class="box">
            <div class="">
                <div class="title">
                    <div style="float:left;width:370px;height:147px;text-align:left;position:relative; margin-bottom:20px;">
                        <div class="avatar" style="position:absolute;bottom:0px;left:20px;">
                            <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" 
                                 class="avatar-big" style="max-height:130px;max-width:130px;" />
                        </div>
                        <div  style="position:absolute; bottom:10px;left:150px;">
                            <h3 style=" color:#666;font-weight:100;"><?php echo $row['name']; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <table class="table table-normal ">

                <?php if ($row['admission_form_no'] != ''): ?>
                    <tr>
                        <td><?php echo translate('admission_form_no'); ?></td>
                        <td><b><?php echo $row['admission_form_no']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['registration_no'] != ''): ?>
                    <tr>
                        <td><?php echo translate('registration_no'); ?></td>
                        <td><b><?php echo $row['registration_no']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['student_unique_ID'] != ''): ?>
                    <tr>
                        <td><?php echo translate('student_unique_ID'); ?></td>
                        <td><b><?php echo $row['student_unique_ID']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['class_id'] != ''): ?>
                    <tr>
                        <td>Class</td>
                        <td><b><?php echo $this->crud_model->get_class_name($row['class_id']); ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['roll'] != ''): ?>
                    <tr>
                        <td>Roll</td>
                        <td><b><?php echo $row['roll']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['birthday'] != ''): ?>
                    <tr>
                        <td>Birthday</td>
                        <td><b><?php echo $row['birthday']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['sex'] != ''): ?>
                    <tr>
                        <td>Sex</td>
                        <td><b><?php echo $row['sex']; ?></b></td>
                    </tr>
                <?php endif; ?>


                <?php if ($row['phone'] != ''): ?>
                    <tr>
                        <td>Phone</td>
                        <td><b><?php echo $row['phone']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['email'] != ''): ?>
                    <tr>
                        <td>Email</td>
                        <td><b><?php echo $row['email']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['father_name'] != ''): ?>
                    <tr>
                        <td>Father name</td>
                        <td><b><?php echo $row['father_name']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['mother_name'] != ''): ?>
                    <tr>
                        <td>Mother name</td>
                        <td><b><?php echo $row['mother_name']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['mother_name'] != ''): ?>
                    <tr>
                        <td>Mother name</td>
                        <td><b><?php echo $row['mother_name']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['guardian_name'] != ''): ?>
                    <tr>
                        <td>Guardian name</td>
                        <td><b><?php echo $row['guardian_name']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['guardian_profession'] != ''): ?>
                    <tr>
                        <td>Guardian Profession</td>
                        <td><b><?php echo $row['guardian_profession']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['clearance_no'] != ''): ?>
                    <tr>
                        <td>Clearance No</td>
                        <td><b><?php echo $row['clearance_no']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['section'] != ''): ?>
                    <tr>
                        <td>Section</td>
                        <td><b><?php echo $row['section']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['group'] != ''): ?>
                    <tr>
                        <td>Group</td>
                        <td><b><?php echo $row['group']; ?></b></td>
                    </tr>
                <?php endif; ?>

                <?php if ($row['present_address'] != ''): ?>
                    <tr>
                        <td style="vertical-align:top;">Present Address</td>
                        <td><b><?php echo $row['present_address']; ?></b>
                            <div id="map1" style="width:200px;height:200px;border-radius:50%;"></div>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if ($row['permanent_address'] != ''): ?>
                    <tr>
                        <td style="vertical-align:top;">Permanent Address</td>
                        <td><b><?php echo $row['permanent_address']; ?></b>
                            <div id="map2" style="width:200px;height:200px;border-radius:50%;"></div>
                        </td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>
    </center>
    <!--<iframe class="google_map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $row['address']; ?>&output=embed&iwloc=near"></iframe>-->


    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&extension=.js"></script>
    <script>
        jQuery(document).ready(function () {
            var map;
            var centerPosition = new google.maps.LatLng(40.747688, -74.004142);

            var style = [{
                    "stylers": [{
                            "visibility": "on"
                        }]
                }, {
                    "featureType": "road",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#ffffff"
                        }]
                }, {
                    "featureType": "road.arterial",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#fee379"
                        }]
                }, {
                    "featureType": "road.highway",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#fee379"
                        }]
                }, {
                    "featureType": "landscape",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#f3f4f4"
                        }]
                }, {
                    "featureType": "water",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#7fc8ed"
                        }]
                }, {}, {
                    "featureType": "road",
                    "elementType": "labels",
                    "stylers": [{
                            "visibility": "off"
                        }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{
                            "visibility": "on"
                        }, {
                            "color": "#83cead"
                        }]
                }, {
                    "elementType": "labels",
                    "stylers": [{
                            "visibility": "on"
                        }]
                }, {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry",
                    "stylers": [{
                            "weight": 1
                        }, {
                            "visibility": "off"
                        }]
                }]
                                
            var image = {
                url: 'https://dl.dropboxusercontent.com/u/814783/fiddle/marker.png',
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            };
            var shadow = {
                url: 'https://dl.dropboxusercontent.com/u/814783/fiddle/shadow.png',
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 0)
            };
            var marker = new google.maps.Marker({
                position: centerPosition,
                map: map,
                icon: image,
                shadow: shadow
            });
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 12,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map1 = new google.maps.Map(document.getElementById("map1"), mapOptions);
            map1.setOptions({
                styles: style
            });            
            var present_address = "<?php echo $row['present_address']; ?>";
            geocoder.geocode( { 'present_address': present_address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map1.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map1,
                        position: results[0].geometry.location
                    });
                } else {
                    //alert("Geocode was not successful for the following reason: " + status);
                }
            });
                    
            map2 = new google.maps.Map(document.getElementById("map2"), mapOptions);
            map2.setOptions({
                styles: style
            });                            
                                    
            var permanent_address = "<?php echo $row['permanent_address']; ?>";
            geocoder.geocode( { 'permanent_address': permanent_address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map2.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map2,
                        position: results[0].geometry.location
                    });
                } else {
                    //alert("Geocode was not successful for the following reason: " + status);
                }
            });
                    
        });         
                            
    </script>

<?php endforeach; ?>