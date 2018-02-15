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
           <h2 align="center">Teg List</h2>
        <table align="center" border="1">
        <tr>
          <th>Information</th>
          <th>Teglist </th>
            
         </tr>
            
            <?php foreach($teglistinfo as $teglist){  ?>
                
                 <tr>
            
                     <td><?php echo $teglist; ?></td>
                     <td>&lt;info&gt;<?php echo $teglist; ?>&lt;/info&gt;</td>
            
                </tr>
                
            <?php    }   ?>


        </table>        
</body>
</html>





