<?php

require_once('../../config.php');
require_once($CFG->dirroot.'/mod/quizspa/lib.php');

$id = required_param('id', PARAM_INT); 

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

require_course_login($course);

$context = context_course::instance($course->id);
$PAGE->set_url('/mod/quizspa/index.php', array('id' => $id));
$PAGE->set_title(get_string('modulenameplural', 'quizspa'));
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('modulenameplural', 'quizspa'));


$instances = get_all_instances_in_course('quizspa', $course);

foreach ($instances as $instance) {
    $url = new moodle_url('/mod/quizspa/view.php', array('id' => $instance->coursemodule));
    echo html_writer::link($url, format_string($instance->name));
    echo html_writer::empty_tag('br');
}

echo $OUTPUT->footer();
