<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <a href="#" onclick="save_whatsapp_chat(); return false;" class="btn btn-info">Save Changes</a>
                        <a href="#" onclick="enable_whatsapp_chat(); return false;" class="btn btn-info" <?php if (get_option('whatsapp_chat') == 'enable') echo 'disabled';?>>Enable WhatsApp Chat Support</a>
                        <a href="#" onclick="disable_whatsapp_chat(); return false;" class="btn btn-info"<?php if (get_option('whatsapp_chat') == 'disable') echo 'disabled';?>>Disable WhatsApp Chat Support</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_clients_and_admin_area">Chat code for both Admin & Clients area (frontend & backend) <i class="fa fa-question-circle" data-toggle="tooltip" data-title="If you paste your code here, your whatsapp chat service will load in Admin area and Customers area aswell."></i></label>
                            <textarea name="whatsapp_chat_clients_and_admin_area" id="whatsapp_chat_clients_and_admin_area" rows="10" class="form-control"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_clients_and_admin_area')); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_admin_area">Chat code for Admin area only (backend) <i class="fa fa-question-circle" data-toggle="tooltip" data-title="If you paste your code here, your whatsapp chat service will load in Admin area only."></i></label>
                            <textarea name="whatsapp_chat_admin_area" id="whatsapp_chat_admin_area" rows="10" class="form-control"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_admin_area')); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_clients_area">Chat code for Clients area only (frontend) <i class="fa fa-question-circle" data-toggle="tooltip" data-title="If you paste your code here, your whatsapp chat service will load in Customers area only."></i></label>
                            <textarea name="whatsapp_chat_clients_area" id="whatsapp_chat_clients_area" rows="10" class="form-control"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_clients_area')); ?></textarea>
                        </div>
                        <br>
                        <br>
                        <span style="color:rgba(0, 0, 0, 0.5);"><i>Thank you for using our module!
                        <br>
                        If you face any issues, our team is always ready to help you.
                        <br>
                        <br>
                        Rating our module with your honest feedback is appreciated in advance and will help us.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

<script>
   $(function() {
   });

   function save_whatsapp_chat() {
       $.post(admin_url + 'whatsapp_chat/save', {
            admin_area: $('#whatsapp_chat_admin_area').val(),
            clients_area: $('#whatsapp_chat_clients_area').val(),
            clients_and_admin: $('#whatsapp_chat_clients_and_admin_area').val(),
       }).done(function(response) {
            window.location = admin_url+'whatsapp_chat';
       });
   }
   
   function enable_whatsapp_chat() {
       $.post(admin_url + 'whatsapp_chat/enable', {
       }).done(function() {
            window.location = admin_url+'whatsapp_chat';
       });
   }
   
   function disable_whatsapp_chat() {
       $.post(admin_url + 'whatsapp_chat/disable', {
       }).done(function() {
            window.location = admin_url+'whatsapp_chat';
       });
   }
</script>

</body>
</html>
