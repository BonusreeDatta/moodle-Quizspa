<?php
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading('mod_quizspa_settings', '',
        get_string('pluginname_desc', 'mod_quizspa')));
}



