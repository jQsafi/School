<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
      <?php include 'application/views/includes.php';?>
        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    </head>
<body>
                         <?php if($print_all=="yes"){ 
    
                foreach($all_testimonial as $testimonialid){
                    
             
                    
            $testimonialinfo=$this->db->get_where('testimonial', array('testimonial_id' => $testimonialid))->result_array();        
                    ?>
<?php foreach($testimonialinfo as $testimonials){ ?>

      
 <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $testimonials['student_id']))->result_array();
   
 foreach($studentinfo as $students ){ 
   
   ?> 
   <div  class="a4-landscape">
     <table>
     <tr>
    <?php    
 $string=$testimonials['testimonial_info']; 

 $html = <<< EOH
 $string


EOH;

                $html = preg_replace_callback("/<info>(.+?)<\/info>/", function($matches)use($students) {
                    $altered=$students["$matches[1]"];
                   return str_replace($matches[1], $altered, $matches[0]);
               }, $html);

            echo strip_tags($html);    
                   
                   ?>
         </tr>
         
         
         
     </table>
</div>
   <?php } } ?>
                
    
                <?php  } ?>
    
                         <?php }else{ ?>
                

                
<?php foreach($testimonialinfo as $testimonials ){ ?>
     

   <?php  $studentinfo=$this->db->get_where('student', array('student_id' => $testimonials['student_id']))->result_array();
   
 foreach($studentinfo as $students ){ 
   
   ?> 
   <div  class="a4-landscape">
     <table>
         <tr>
		 <td>
    <?php  
 $string=$testimonials['testimonial_info'];   
 $html = <<< EOH
 $string


EOH;

                $html = preg_replace_callback("/<info>(.+?)<\/info>/", function($matches)use($students) {

                    $altered=$students["$matches[1]"];
                   return str_replace($matches[1], $altered, $matches[0]);
               }, $html);
               echo strip_tags($html); 
                   
                   ?>
				 </td>
         </tr>
         
     </table>
   </div>
<?php }  } ?>
                
                         <?php } ?>
</body>
</html>





