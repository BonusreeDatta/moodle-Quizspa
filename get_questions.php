<?php
require_once('../../config.php');
require_once('lib.php');

$courseid = required_param('courseid', PARAM_INT);

require_login($course, true, $cm);


$PAGE->set_url('/mod/quizspa/attempt.php', array('id' => $courseid));
$PAGE->set_title(format_string($quizspa->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->add_body_class('limitedwidth');
 echo $OUTPUT->header();

$templatecontext = (object) [

    'courseid'=>$course->id,
    'addquestionurl'=>new moodle_url('/question/edit.php'),
    'attempturl'=>new moodle_url('/mod/quizspa/get_questions.php'),
    'backcourse'=>new moodle_url('/course/attempt.php', array('id' => $courseid)),

 ];
 echo $OUTPUT->render_from_template('mod_quizspa/attempt', $templatecontext);
 echo $OUTPUT->footer();
// try {
//     $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
//     require_login($course);

//     $questions = get_mcq_questions();
//     $response = [];

//     foreach ($questions as $question) {
//         $options = get_mcq_options($question->id);
//         $response[] = [
//             'questiontext' => format_string($question->questiontext),
//             'options' => array_map(function($option) {
//                 return format_string($option->answer);
//             }, $options)
//         ];
//         var_dump(($response));
//     }

//     echo json_encode($response);

// } catch (Exception $e) {
//     echo json_encode(['error' => $e->getMessage()]);
// }

// function get_mcq_questions() {
//     global $DB;
//     $sql = "SELECT * FROM {question} WHERE qtype = 'multichoice'";
//     return $DB->get_records_sql($sql);
// }

// function get_mcq_options($questionid) {
//     global $DB;
//     $sql = "SELECT * FROM {question_answers} WHERE question = ?";
//     return $DB->get_records_sql($sql, array($questionid));
// }
?>
