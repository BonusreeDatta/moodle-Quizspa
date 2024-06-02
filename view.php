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
 $templatecontext = (object) [
    'cmid'=>$cm->id,
    'courseid'=>$course->id,
    'addquestionurl'=>new moodle_url('/question/edit.php'),
    'attempturl'=>new moodle_url('/mod/quizspa/get_questions.php'),
    'backcourse'=>new moodle_url('/course/view.php', array('id' => $course->id)),

 ];
 echo $OUTPUT->render_from_template('mod_quizspa/view', $templatecontext);

echo $OUTPUT->footer();
?>
