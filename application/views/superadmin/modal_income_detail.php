<style type="text/css" media="all">
    /* Eric Meyer's Reset CSS v2.0 - http://cssreset.com */

    html, body, div, span, h1, h2, h3, h4, h5, h6, p, img, table, tbody, tfoot, thead, tr, th, td, output {
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
        margin: 0;
        padding: 0
    }
    body {
        line-height: 1
    }    
    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    body {
        font-family: sans-serif;
    }    
    hr {
        margin: 10px 0;
        border-top: 1px solid #ccc;
    }

    .invoice-container {
        margin: 5px auto;
        text-align: center;
        background: #fff;
        width: 80%;
        height: auto;
        overflow: hidden;
 /*       width: 10.16cm;
        height: 17.78cm;*/
        border: 1px solid #ddd;
        font-size: 13.333333px;
    }
    .invoice-container p {
        margin-bottom: 5px;
    }
    .invoice-container .wraper {padding: 10px;}
    .invoice-container .title {font-size: 16px;}
    .invoice-container .title-description {font-size: 12px; color: #282828;}
    strong {font-weight: bold;}
    .invoice-description p{text-align: left; margin-top: 3px;line-height: 16px;}
    .invoice-description table{margin-bottom: 5px;}
    .invoice-name {text-align: center !important; font-weight: bold; margin: 0px 0px 5px 0px;}
    .fees-details td{padding: 2px; border-bottom: 1px dotted #CCC}
    .fees-details th {background-color: #E5E5E5; line-height: 20px; font-weight: bold;}
    .fees-details th:first-child, .fees-details td:first-child{text-align: left; padding-left: 10px}
    .fees-details th:last-child, .fees-details td:last-child {text-align: right; padding-right: 10px}
    .footer {font-size: 10px; margin: 30px auto 10px;}
    .footer .wemax-footer{ width: 100%; margin: 0 auto; }
    .total-calculation {background-color: #E5E5E5; font-weight: bold}
    .total-calculation2 {font-weight: bold}    
    
</style>
<style type="text/css" media="print">
/*    #print_section1, #print_section2, #print_section3  {
        display: none !important;
    }*/
    #print_section1, #print_section2, #print_section3  {
        margin-bottom: 190px;
    }
    .print_btn_wrapper {
        display: none;
    }
</style>

<?php
$income_info = $this->crud_model->get_income_info($current_income_id);
foreach ($income_info as $row) :
    ?>
<div class="invoice-container">
    <div class="wraper clearfix">        
        <div class="invoice-header">
            <p><img src="<?php echo base_url(); ?>/images/institute-logo.jpg"></p>
            <p class="title"><?php echo $system_name; ?></p>
            <p class="title-description"><?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description; ?></p>
        </div>
        <hr>        
        <div class="invoice-description">
            <table width="100%">
                <tr>
                    <td style="text-align: left;"><strong><?php echo translate('Income ID'); ?>: </strong><?php echo $row['income_id']; ?></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: right;"><strong><?php echo translate('Issue Date'); ?>: </strong><?php echo date('j F, Y', $row['income_timestamp']); ?></td>
                </tr>
                <tr>
                    <td colspan="3"><p><strong><?php echo translate('Payment From'); ?>: </strong><?php echo $row['payment_from']; ?></p></td>
                </tr>
            </table>
        </div>
        
        <div class="fees-details">
            <table width="100%">
                <tr>
                    <th colspan="2" style="text-align: center;">
                        Invoice title: <?php echo $row['material_name']; ?>
                    </th>
                </tr>
                <?php if($row['income_id'] != '') { ?>
                <tr>
                    <td><?php echo translate('income_id'); ?></td>
                    <td><?php echo $row['income_id']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['income_by'] != '') { ?>
                <tr>
                    <td><?php echo translate('Income by'); ?></td>
                    <td><?php echo $row['income_by']; ?></td>
                </tr>
                <?php } ?>                
                <?php if($row['invoice_id'] != '') { ?>
                <tr>
                    <td><?php echo translate('invoice_id'); ?></td>
                    <td><?php echo $row['invoice_id']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['category'] != '') { ?>
                <tr>
                    <td><?php echo translate('category'); ?></td>
                    <td><?php echo $row['category']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['material_name'] != '') { ?>
                <tr>
                    <td><?php echo translate('material_name'); ?></td>
                    <td><?php echo $row['material_name']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['income_name'] != '') { ?>
                <tr>
                    <td><?php echo translate('income_name'); ?></td>
                    <td><?php echo $row['income_name']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['description'] != '') { ?>
                <tr>
                    <td><?php echo translate('description'); ?></td>
                    <td><?php echo $row['description']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['payment_method'] != '') { ?>
                <tr>
                    <td><?php echo translate('payment_method'); ?></td>
                    <td><?php echo $row['payment_method']; ?></td>
                </tr>
                <?php } ?>
                <?php if($row['income_date'] != '') { ?>
                <tr>
                    <td><?php echo translate('income_date'); ?></td>
                    <td><?php echo date('j F, Y', $row['income_timestamp']); ?></td>
                </tr>
                <?php } ?>
                <?php if($row['amount'] != '') { ?>
                <tr>
                    <td><?php echo translate('amount'); ?></td>
                    <td><?php echo $row['amount']; ?></td>
                </tr>
                <?php } ?>
                
            </table>
        </div>


        <div class="footer">
            <div class="wemax-footer">
                <p><img src="<?php echo base_url(); ?>/images/prime-logo.png"></p>
                Powerd By: Wemax Software Ltd. | Hotline: 01620555777, 01620888555
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>