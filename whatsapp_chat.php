<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: WhatsApp Chat
Description: WhatsApp chat module for Perfex CRM
Version: 1.0
Requires at least: 2.3.*
*/

define('whatsapp_chat_MODULE_NAME', 'whatsapp_chat');

$CI = &get_instance();

/**
 * Load the module helper
 */
$CI->load->helper(whatsapp_chat_MODULE_NAME . '/whatsapp_chat');

/**
 * Register activation module hook
 */
register_activation_hook(whatsapp_chat_MODULE_NAME, 'whatsapp_chat_activation_hook');

function whatsapp_chat_activation_hook()
{
    require_once(__DIR__ . '/install.php');
}

/**
 * Register language files, must be registered if the module is using languages
 */
register_language_files(whatsapp_chat_MODULE_NAME, [whatsapp_chat_MODULE_NAME]);

/**
 * Actions for inject the custom styles
 */
hooks()->add_action('app_admin_footer', 'whatsapp_chat_admin_head');
hooks()->add_action('app_customers_footer', 'whatsapp_chat_clients_area_head');
hooks()->add_filter('module_whatsapp_chat_action_links', 'module_whatsapp_chat_action_links');
hooks()->add_action('admin_init', 'whatsapp_chat_init_menu_items');
if (get_option('whatsapp_chat') == 'enable') {
    hooks()->add_action('app_customers_footer', 'whatsapp_chat_assets');
    hooks()->add_action('app_admin_footer', 'whatsapp_chat_assets');
}

/**
 * Chat assets
 * @return stylesheet / script
 */
function whatsapp_chat_assets()
{
    echo '<link href="' . base_url('modules/whatsapp_chat/assets/style.css') . '"  rel="stylesheet" type="text/css" >';
}

/**
 * Add additional settings for this module in the module list area
 * @param  array $actions current actions
 * @return array
 */
function module_whatsapp_chat_action_links($actions)
{
    $actions[] = '<a href="' . admin_url('whatsapp_chat') . '">' . _l('settings') . '</a>';

    return $actions;
}
/**
 * Admin area applied styles
 * @return null
 */
function whatsapp_chat_admin_head()
{
    whatsapp_chat_script('whatsapp_chat_admin_area');
}

/**
 * Clients area theme applied styles
 * @return null
 */
function whatsapp_chat_clients_area_head()
{
    if(is_client_logged_in()) { 
        whatsapp_chat_script('whatsapp_chat_clients_area');
    }
}

/**
 * Detect mobile users and provide a different link URL, related to the app
 * @return null
 */
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

/**
 * Custom CSS
 * @param  string $main_area clients or admin area options
 * @return null
 */
function whatsapp_chat_script($main_area)
{
    
    if(isMobile()){
        $service = 'api.whatsapp.com';
    }
    else {
        $service = 'web.whatsapp.com';
    }


    $clients_or_admin_area = get_option($main_area);
    if (get_option('whatsapp_chat') == 'enable') {
        $whatsapp_chat_admin_and_clients_area = get_option('whatsapp_chat_clients_and_admin_area');
        if (!empty($clients_or_admin_area) || !empty($whatsapp_chat_admin_and_clients_area)) {
            if (!empty($clients_or_admin_area)) {
                $clients_or_admin_area = html_entity_decode(clear_textarea_breaks($clients_or_admin_area));
                $clients_or_admin_area = str_replace("+", "", $clients_or_admin_area);
                echo '<div class="integration">
                <a target="_blank" href="https://' . $service . '/send?phone=' . $clients_or_admin_area . '">
                <div class="whatsapp-message">
                <img class="whatsapp-image" src="' . base_url('modules/whatsapp_chat/assets/chaticon.svg') . '">
                </div>
                </a>
                </div>';
            }
            if (!empty($whatsapp_chat_admin_and_clients_area)) {
                $whatsapp_chat_admin_and_clients_area = html_entity_decode(clear_textarea_breaks($whatsapp_chat_admin_and_clients_area));
                $whatsapp_chat_admin_and_clients_area = str_replace("+", "", $whatsapp_chat_admin_and_clients_area);
                echo '<div class="integration">
                <a target="_blank" href="https://' . $service . '/send?phone=' . $whatsapp_chat_admin_and_clients_area . '">
                <div class="whatsapp-message">
                <img class="whatsapp-image" src="' . base_url('modules/whatsapp_chat/assets/chaticon.svg') . '">
                </div>
                </a>
                </div>';
            }
        }
    }
}

/**
 * Init theme style module menu items in setup in admin_init hook
 * @return null
 */
function whatsapp_chat_init_menu_items()
{
    if (is_admin()) {
        $CI = &get_instance();
        /**
         * If the logged in user is administrator, add custom menu in Setup
         */
        $CI->app_menu->add_setup_menu_item('whatsapp-chat', [
            'href'     => admin_url('whatsapp_chat'),
            'name'     => _l('whatsapp_chat'),
            'position' => 66,
        ]);
    }
}