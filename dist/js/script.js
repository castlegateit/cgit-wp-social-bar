(function ($) {
    var blockClass = 'cgit-wp-social-bar-settings';
    var dot = '.';

    var listClass = blockClass + '__list';
    var itemClass = blockClass + '__item';
    var enabledInputClass = blockClass + '__enabled-input';
    var sortInputClass = blockClass + '__sort-input';

    var listClassEnabled = listClass + '--enabled';
    var listClassSortable = listClass + '--sortable';

    $(function () {
        // Make items sortable with jQuery UI.
        $(dot + listClass).addClass(listClassSortable).sortable({
            connectWith: dot + listClass,
            stop: function () {
                // After sort, update enabled and sort order values.
                $(dot + itemClass).each(function (itemIndex, itemNode) {
                    var item = $(itemNode);
                    var enabledInput = item.find(dot + enabledInputClass);
                    var sortInput = item.find(dot + sortInputClass);

                    enabledInput.prop('checked', item.closest(dot + listClassEnabled).length !== 0);
                    sortInput.val(itemIndex);

                    // Trigger change event as if user had changed values.
                    enabledInput.trigger('change');
                    sortInput.trigger('change');
                });
            }
        });
    });
})(jQuery);

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

//# sourceMappingURL=script.js.map
