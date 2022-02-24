<?php

defined('BASEPATH') or exit('No direct script access allowed');

class whatsapp_chat extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        if (!is_admin()) {
            access_denied('WhatsApp Chat');
        }
        
        $this->load->helper('/whatsapp_chat');
    }

    public function index()
    {
        $data['title'] = _l('whatsapp_chat');
        $this->load->view('whatsapp_chat', $data);
    }

    public function reset()
    {
        update_option('whatsapp_chat', 'enable');
        redirect(admin_url('whatsapp_chat'));
    }

    public function save()
    {
        hooks()->do_action('before_save_whatsapp_chat');
        
        foreach(['admin_area','clients_area','clients_and_admin'] as $css_area) {
            // Also created the variables
            $$css_area = $this->input->post($css_area, FALSE);
            $$css_area = trim($$css_area);
            $$css_area = nl2br($$css_area);
        }
        
        update_option('whatsapp_chat_admin_area', $admin_area);
        update_option('whatsapp_chat_clients_area', $clients_area);
        update_option('whatsapp_chat_clients_and_admin_area', $clients_and_admin);
    }
    
    public function enable()
    {
        hooks()->do_action('before_save_whatsapp_chat');

        update_option('whatsapp_chat', 'enable');
    }
    
    public function disable()
    {
        hooks()->do_action('before_save_whatsapp_chat');

        update_option('whatsapp_chat', 'disable');
    }
}
