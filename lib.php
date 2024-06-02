<?php

function quizspa_add_instance($quizspa, $mform = null) {
    global $DB;

    $quizspa->timecreated = time();
    $quizspa->timemodified = $quizspa->timecreated;

    return $DB->insert_record('quizspa', $quizspa);
}

/**
 * Updates an instance of the quizspa.
 *
 * @param stdClass $quizspa
 * @param quizspa_mod_form $mform
 * @return bool
 */
function quizspa_update_instance($quizspa, $mform = null) {
    global $DB;

    $quizspa->timemodified = time();
    $quizspa->id = $quizspa->instance;

    return $DB->update_record('quizspa', $quizspa);
}

/**
 * Deletes an instance of the quizspa.
 *
 * @param int $id
 * @return bool
 */
function quizspa_delete_instance($id) {
    global $DB;

    if (!$quizspa = $DB->get_record('quizspa_', array('id' => $id))) {
        return false;
    }

    // // Delete related questions and answers
    // $DB->delete_records('quizspa_question', array('quiz_id' => $id));
    // $DB->delete_records('quizspa_answer', array('que_id' => $id));

    // Delete the quiz itself
    $DB->delete_records('quizspa', array('id' => $id));

    return true;
}

/**
 * Returns the list of supported features.
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if feature is supported, null if unknown
 */
function quizspa_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_MOD_INTRO:               return true;
        case FEATURE_BACKUP_MOODLE2:          return true;
        default:                              return null;
    }
}

