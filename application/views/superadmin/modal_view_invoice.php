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
    $count=1;
    $total_deposit = 0;
    //foreach ($edit_data as $row):
	$deposit=0;
	$total_fees=0;
    for($i=0; $i < count($edit_data); $i++) 
	{
	$info=$this->db->get_where('student', array('student_id' => $edit_data[$i]['student_id']))->row();
	$student_id=$edit_data[$i]['student_id'];
?>

<div class="invoice-container" id="<?php echo "print_section".$count; ?>">
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
                    <td style="text-align: left;"><strong><?php echo translate('Invoice Number'); ?>: </strong><?php echo $edit_data[$i]['invoice_number']; ?></td>
                    <td style="text-align: center;"><strong><?php echo translate('Status'); ?>: </strong><?php echo strtoupper($edit_data[$i]['payment_status']); ?></td>
                    <td style="text-align: right;"><strong><?php echo translate('Date'); ?>: </strong><?php echo $edit_data[$i]['payment_date']; ?></td>
                </tr>
                <tr>
                    <td><p><strong><?php echo translate('Name'); ?>: </strong><?php echo $info->name;?></p></td>
                     <td>
                         <strong><?php echo translate('class'); ?>: </strong>
                        <?php
                            $class_id = $this->db->get_where('student', array('student_id' => $edit_data[$i]['student_id']))->row()->class_id;
                            echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                        ?>, 
                        <strong><?php echo translate('Roll'); ?>: </strong>
                        <?php echo $info->roll; ?>, 
                        <strong><?php echo translate('Section'); ?>: </strong> <?php echo $info->section; ?>
                     </td>
					 <?php if($info->group):?>
                    <td align="right"><strong><?php echo translate('Group'); ?>: </strong> <?php echo  get_single_value('group_name','group',array('group_id'=>$info->group)); ?>
					</td>
					<?php 
					endif;?>
					<?php
						$paymen_month=str_ireplace(",",", ",$edit_data[0]['payment_month']);
					?>
                </tr>
				<tr>
					<td align="left" colspan="3">
					<p class="invoice-name">Payment For: <?=$paymen_month?> - <?=$edit_data[0]['payment_year']?><?php if($edit_data[0]['invoice_name'])
					{ 
					?>, Payment Name: <?php echo $edit_data[0]['invoice_name']; 
					}
					?>
					</p>
					</td>
				</tr>
            </table>
        </div>
        <div class="fees-details">
            <table width="100%">
			<?php
			$invoice_id=$edit_data[0]['invoice_id'];
			$total_collection=get_single_value('total_collection','invoice',array('invoice_id'=>$invoice_id));
			if($total_collection)
			{
				?>
                <tr>
                    <th>
                        <?php echo translate('Fees Title'); ?>
                    </th>
                    <th>
                        <?php echo translate('fees_pay'); ?>
                    </th>
                </tr>
				<?php
				$this->db->where('student_id',$info->student_id);
                $query_result = $this->db->from('fees')->get();
				foreach ($query_result->result() as $item )
				{
					$count++;
					$fees_name_id=$item->fees_id;
					$fee_full_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fees_name_id));
					$collection_amount=get_single_value('collection_amount','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					if($collection_amount and $collection_amount	!='-')
					{
						?>
							<tr>
			                    <td><?php echo $fee_full_name; ?></td>
			                    <td><?php echo $collection_amount; ?></td>
			                </tr>
						<?php
					}
				}
				?>
                <tr class="total-calculation">
                    <td>Total</td>
                    <td><?php echo $total_collection; ?></td>
                </tr>
				<?php
				}
				$total_fine=get_single_value('total_fine','invoice',array('invoice_id'=>$invoice_id));
				if($total_fine)
				{
					?>
				<tr>
					<th>
						<?php
						if(!$total_collection)
						 echo translate('Fees Title'); 
						?>
					</th>
                    <th>
                        <?php echo translate('fine'); ?>
                    </th>
                </tr>
				<?php
				$invoice_id=$edit_data[0]['invoice_id'];
				$this->db->where('student_id',$info->student_id);
                $query_result = $this->db->from('fees')->get();
				foreach ($query_result->result() as $item )
				{
					$count++;
					$fees_name_id=$item->fees_id;
					$fee_full_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fees_name_id));
					$collection_amount=get_single_value('collection_amount','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					$weaver=get_single_value('weaver','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					$fine=get_single_value('fine','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					if($fine and $fine!='-')
					{
						?>
							<tr>
			                    <td><?php echo $fee_full_name; ?></td>
								<td><?php echo $fine; ?></td>
			                </tr>
						<?php
					}
				}
				?>
                <tr>
                    <td>Total Fine</td>
					<td><?php echo $total_fine; ?></td>
                </tr>
				<?php
				}
				if($total_collection and $total_fine)
				{
				?>
				<tr>
                    <td>Grand Total</td>
					<td><?php echo $total_fine+$total_collection; ?></td>
                </tr>
				<?php
				}
				$total_weaver=get_single_value('total_weaver','invoice',array('invoice_id'=>$invoice_id));
				if($total_weaver){
				?>
				<tr>
                    <th>
                        <?php
						if(!$total_collection and !$total_fine)
						 echo translate('Fees Title'); 
						?>
                    </th>
                    <th>
                        <?php echo translate('weaver'); ?>
                    </th>
                </tr>
				<?php
				$this->db->where('student_id',$info->student_id);
                $query_result = $this->db->from('fees')->get();
				foreach ($query_result->result() as $item )
				{
					$count++;
					$fees_name_id=$item->fees_id;
					$fee_full_name=get_single_value('fee_full_name','fees_name',array('fees_name_id'=>$fees_name_id));
					$collection_amount=get_single_value('collection_amount','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					$weaver=get_single_value('weaver','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					$fine=get_single_value('fine','invoice_details',array('invoice_id'=>$invoice_id,'fees_id'=>$fees_name_id));
					if($weaver and $weaver!='-')
					{
						?>
							<tr>
			                    <td><?php echo $fee_full_name; ?></td>
								<td><?php echo $weaver; ?></td>
			                </tr>
						<?php
					}
				}
				?>
                <tr class="total-calculation">
                    <td>Total Weaver</td>
					<td><?php echo $total_weaver; ?></td>
                </tr>
				<?php
				}
				}
				?>
            </table>
        </div>
        <div class="footer">
            <div class="wemax-footer">
                <p><img src="<?php echo base_url(); ?>/images/prime-logo.png"></p>
                Powerd By: Wemax Software Ltd. | Hotline: 01620555777, 01620888555
            </div>
        </div>
        <!--<p class="pull-right print_btn_wrapper">
            <button class="btn btn-gray" onclick="PrintElem('<?php echo "#print_section".$count;?>')">Print</button>
        </p>-->
    </div>
</div>

<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', ' ', 'height=400,width=600');
        mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>