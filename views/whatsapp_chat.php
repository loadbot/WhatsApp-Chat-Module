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
                        <h4>WhatsApp Chat Configuration</h4>
                        <h5>Please use your mobile phone in international format and no spaced, i.e: +336941636578</h6>
                        <br>
                        <br>
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_clients_and_admin_area">Mobile phone for both Admin & Clients area chat: <i class="fa fa-question-circle" data-toggle="tooltip" data-title="Enter a mobile phone here if you want WhatsApp Chat to be loaded in both frontend and backend of Perfex CRM. Leave this field blank and chat code will not load in both areas."></i></label>
                            <br><textarea name="whatsapp_chat_clients_and_admin_area" id="whatsapp_chat_clients_and_admin_area" class="form-control" rows="1"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_clients_and_admin_area')); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_admin_area">Mobile phone for Admin area chat: <i class="fa fa-question-circle" data-toggle="tooltip" data-title="Enter a mobile phone here if you want WhatsApp Chat to be loaded the backend of Perfex CRM. Leave this field blank and chat code will not load in the backend."></i></label>
                            <textarea name="whatsapp_chat_admin_area" id="whatsapp_chat_admin_area" class="form-control" rows="1"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_admin_area')); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="bold" for="whatsapp_chat_clients_area">Mobile phone for Customers area chat: <i class="fa fa-question-circle" data-toggle="tooltip" data-title="Enter a mobile phone here if you want WhatsApp Chat to be loaded the backend of Perfex CRM. Leave this field blank and chat code will not load in the frontend."></i></label>
                            <textarea name="whatsapp_chat_clients_area" id="whatsapp_chat_clients_area" class="form-control" rows="1"><?php echo clear_textarea_breaks(get_option('whatsapp_chat_clients_area')); ?></textarea>
                        </div>
                        <br>
                        <br>
                        <span style="color:rgba(0, 0, 0, 0.5);"><i>Thank you for using our module!</i></span>
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