
<!-----------HIDDEN MODAL FORM - COMMON IN ALL PAGES ------>
<div id="modal-form" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div id="modal-tablesLabel" style="color:#fff; font-size:16px;">&nbsp; </div>
    </div>
    <div class="modal-body" id="modal-body">loading data..</div>
    <div class="modal-footer">
        <button class="btn btn-gray" onclick="custom_print('frame1')">Print</button>
        <button class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
<!-----------HIDDEN MODAL DELETE CONFIRMATION - COMMON IN ALL PAGES ------>
<div id="modal-delete" class="modal hide fade" style="height:140px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 id="modal-tablesLabel"> <i class="icon-info-sign"></i></h6>
    </div>
    <div class="modal-delete-body" id="modal-body-delete">Delete data ?</div>
    <div class="modal-footer">
        <a href="" id="delete_link" class="btn btn-red" >Confirm</a>
        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
    </div>
</div>
<?php
			$login_type=$this->session->userdata('login_type');
			if($login_type=='parent')
			$login_type='parents';
			?>
<div id="modal-confirm" class="modal hide fade" style="height:140px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 id="modal-tablesLabel"> <i class="icon-info-sign"></i> <?=translate('backup_your_file')?></h6>
    </div>
    <div class="modal-delete-body" id="modal-body-delete"><?=translate('Do you have a backup of your data? If Not Please backup your data and go home.')?></div>
    <div class="modal-footer">
        <a href="" id="confirm_link" class="btn btn-red" ><?=translate('logout')?></a>
        <a  href="<?=site_url($login_type."/backup_restore")?>"class="btn btn-default" target="frame"><?=translate('Take_Backup')?></a>
    </div>
</div>
<script>
    function modal(param1 ,param2 ,param3)
    {

        document.getElementById('modal-body').innerHTML =
            '<iframe id="frame1" src="<?php echo base_url(); ?>index.php?modal/popup/'+param1+'/'+param2+'/'+param3+'" width="100%" height="400" frameborder="0"></iframe>';

        document.getElementById('modal-tablesLabel').innerHTML = param1.replace("_"," ");
    }

    function modal_delete(param1)
    {

        document.getElementById('delete_link').href = param1;
    }
	function modal_confirm(param1)
    {

        document.getElementById('confirm_link').href = param1;
    }
    /////////////PRINT A DIV FUNCTION////////////////

    function custom_print(div_id)
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write(document.getElementById(div_id).contentWindow.document.body.innerHTML);
        mywindow.print();
        mywindow.close();
        return true;
    }

</script>
