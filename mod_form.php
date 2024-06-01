<?php

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/quizspa/lib.php'); 
class mod_quizspa_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;
        
        
        $mform->addElement('text', 'name', get_string('name'), array('size' => '64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        
       
        $this->add_intro_editor();
        
        $this->standard_coursemodule_elements();


        $this->add_action_buttons();
    }
}
