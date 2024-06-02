<?php
// Include necessary files and configurations
require_once('../../config.php');
require_once('lib.php');

// Retrieve any necessary parameters
// For example, if you need to pass a course ID, you can retrieve it from the request
$courseid = required_param('courseid', PARAM_INT);

// Set the appropriate content type for the response
header('Content-Type: application/json');

try {
    // Retrieve the course data if necessary
    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
    
    // Ensure user is logged in
    require_login($course);
    
    // Get the questions data
    $questions = get_questions_from_database($courseid);

    // Format the data as JSON and output it
    echo json_encode($questions);

    // Include JavaScript using js_call_amd function
    $PAGE->requires->js_call_amd('mod_quizspa/addquestion', 'init', [$courseid]);

 

// Function to get questions from the database
function get_questions_from_database($courseid) {
    global $DB;

    // Query the database to retrieve questions data
    $sql = "SELECT * FROM {questions} WHERE courseid = ?";
    $questions = $DB->get_records_sql($sql, array($courseid));

    // Format the data as needed
    $formattedQuestions = array();
    foreach ($questions as $question) {
        // Format each question as an array
        $formattedQuestion = array(
            'id' => $question->id,
            'questiontext' => $question->questiontext,
            // Add any other fields you need
        );
        // Push the formatted question to the array
        $formattedQuestions[] = $formattedQuestion;
    }

    return $formattedQuestions;
}
?>
