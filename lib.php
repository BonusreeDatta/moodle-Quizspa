<?php

function quizspa_add_instance($quizspa) {
    global $DB;

    $quizspa->timecreated = time();
    $quizspa->id = $DB->insert_record('quizspa', $quizspa);

    return $quizspa->id;
}

function quizspa_update_instance($quizspa) {
    global $DB;

    $quizspa->timemodified = time();
    $quizspa->id = $quizspa->instance;

    return $DB->update_record('quizspa', $quizspa);
}

function quizspa_delete_instance($id) {
    global $DB;

    if (!$quizspa = $DB->get_record('quizspa', ['id' => $id])) {
        return false;
    }

    $DB->delete_records('quizspa', ['id' => $quizspa->id]);

    return true;
}


