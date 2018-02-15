		<link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css" />
        <link href="<?php echo base_url();?>template/css/schoolsoft.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/bootstrap-combobox.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url();?>template/js/ekattor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>template/js/jquery.base64.js" type="text/javascript"></script>
		<link href="<?php echo base_url();?>template/css/uikit.gradient.css" media="screen" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>template/css/bootstrap-combobox.css" rel="stylesheet" type="text/css"/>
		<script src="<?php echo base_url();?>template/js/bootstrap-combobox.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo base_url();?>template/js/jquery.tablesorter.js"></script> 
		<script src="<?php echo base_url();?>template/js/corner.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/context.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/sp8.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/sp-8-form-validation.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>template/js/TableBarChart.js" type="text/javascript"></script>
     	<link href="<?php echo base_url();?>template/css/TableBarChart.css" media="screen" rel="stylesheet" type="text/css" />
        <?php
		//////////LOADING SYSTEM SETTINGS FOR ALL PAGES AND ACCOUNTS/////////
		
		$system_name	=	get_single_value('system_name','settings');
		$system_title	=	get_single_value('system_title','settings');
		
		                
                ////////////search for array
              /*  function search($array, $key, $value)
                                {
                        $results = array();

                        if (is_array($array)) {
                            if (isset($array[$key]) && $array[$key] == $value) {
                                $results[] = $array;
                            }

                            foreach ($array as $subarray) {
                                $results = array_merge($results, search($subarray, $key, $value));
                            }
                        }

                        return $results;
                }*/