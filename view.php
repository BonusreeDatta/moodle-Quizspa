<?php
require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); // Course module ID

$cm = get_coursemodule_from_id('quizspa', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$quizspa = $DB->get_record('quizspa', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
$PAGE->set_url('/mod/quizspa/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($quizspa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->add_body_class('limitedwidth');
echo $OUTPUT->header();


// Add the "Question Bank" button
echo html_writer::link(
    new moodle_url('/question/edit.php', array('cmid' => $cm->id)),
    get_string('questionbank', 'mod_quizspa'),
    array('class' => 'btn btn-outline-primary')
);

// Add the "Add Question" button
echo html_writer::link(
    new moodle_url('/mod/quizspa/addquestion.php', array('id' => $cm->id)),
    get_string('addquestion', 'mod_quizspa'),
    array('class' => 'btn btn-primary ml-3')
);
echo html_writer::empty_tag('br');


//back to the course 
echo '<div class="row justify-content-center">';
echo '<div class="col-auto">';
echo html_writer::link(
    new moodle_url('/course/view.php', array('id' => $course->id)),
    get_string('backcourse', 'mod_quizspa'),
    array('class' => 'btn btn-lg btn-secondary mt-6 ')
);
echo '</div>'; // close col-auto
echo '</div>'; // close row

echo $OUTPUT->footer();


