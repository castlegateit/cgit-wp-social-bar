(function ($) {
    var blockClass = 'cgit-wp-social-bar-settings';
    var dot = '.';

    $(function () {
        var block = $(dot + blockClass);
        var unsaved = false;
        var form = null;
        var inputs = null;

        if (block.length === 0) {
            return;
        }

        form = block.find('form');
        inputs = block.find('input');

        inputs.on('change', function () {
            unsaved = true;
        });

        form.on('submit', function () {
            unsaved = false;
        });

        $(window).on('beforeunload', function () {
            if (unsaved) {
                return 'Your changes have not been saved.';
            }
        })
    });
})(jQuery);
