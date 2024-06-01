<?php
require_once('../../config.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT); 

$cm = get_coursemodule_from_id('quizspa', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$quizspa = $DB->get_record('quizspa', array('id' => $cm->instance), '*', MUST_EXIST);

require_login($course, true, $cm);



$context = context_module::instance($cm->id);
$PAGE->set_url('/mod/quizspa/addquestion.php', array('id' => $cm->id));
$PAGE->set_title(format_string($quizspa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->add_body_class('limitedwidth');
echo $OUTPUT->header();

$questions = get_mcq_questions();
$i = 1;
$optionLetters = range('a', 'z'); 

foreach ($questions as $question) {
    echo html_writer::tag('h4', $i . '. ' . format_string($question->questiontext));
    
    $options = get_mcq_options($question->id);
    echo html_writer::start_tag('ul');
    $optionIndex = 0;
    foreach ($options as $option) {
        echo html_writer::tag('li', $optionLetters[$optionIndex] . '. ' . format_string($option->answer));
        $optionIndex++;
    }
    echo html_writer::end_tag('ul');
    $i++;
}

echo $OUTPUT->footer();

function get_mcq_questions() {
    global $DB;
    $sql = "SELECT * FROM {question} WHERE qtype = 'multichoice'";
    return $DB->get_records_sql($sql);
}

function get_mcq_options($questionid) {
    global $DB;
    $sql = "SELECT * FROM {question_answers} WHERE question = ?";
    return $DB->get_records_sql($sql, array($questionid));
}

