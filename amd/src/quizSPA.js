define([
    'jquery',
    'core/ajax',
    'core/str',
    'core/modal_factory',
    'core/modal_events',
    'core/notification'
], function($,
             Ajax,
             str,
             ModalFactory,
             ModalEvents,
             Notification) {

    $('.attempt-btn').on('click', function() {
        let elementId = $(this).attr('courseid');
        let arr = elementId.split("-");
        let courseid= arr[arr.length - 1];
        // eslint-disable-next-line promise/catch-or-return
        ModalFactory.create({
            type: ModalFactory.types.SAVE_CANCEL,
            title: str.get_string('attempttitle', 'local_saas_manager', '', ''),
            body: str.get_string('modalmessage', 'local_saas_manager', '', '')
            // eslint-disable-next-line promise/always-return
        }).then(function(modal) {
            modal.setSaveButtonText(str.get_string('attempt', 'local_saas_manager', '', ''));
            let root = modal.getRoot();
            root.on(ModalEvents.save, function() {
                let wsfunction = 'local_saas_manager_attempt_record_by_courseid';
                let params = {
                    'courseid': courseid,
                };
                let request = {
                    methodname: wsfunction,
                    args: params
                };
                Ajax.call([request])[0].done(function() {
                    window.location.href = $(location).attr('href');
                }).fail(Notification.exception);
            });
            modal.show();
        });
    });
});