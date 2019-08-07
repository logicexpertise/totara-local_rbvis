/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['jquery', 'jqueryui', 'local_rbvis/plotly', 'local_rbvis/plotly_renderers', 'local_rbvis/pivot'], function ($) {

    var container = $("#dashboard");

    var spinner = $('#spinner');
    $(document).ajaxStart(function () {
        spinner.css("display", "flex");
        spinner.show();
    }).ajaxStop(function () {
        spinner.hide();
        spinner.css("display", "none");
    });

    var RenderDashboard = function (result) {
        var renderers = $.extend(
                $.pivotUtilities.renderers,
                $.pivotUtilities.plotly_renderers
                );

        var rendereroptions = {
            plotly: {
                autosize: true
            },
            plotlyConfig: {
                scrollZoom: true,
                editable: true,
                displayModeBar: true,
                responsive: true
            }
        };

        container.pivotUI(result, {
            unusedAttrsVertical: false,
            autoSortUnusedAttrs: true,
            renderers: renderers,
            rendererOptions: rendereroptions
        });
    };

    return {
        init: function () {
            var ajax_url = M.cfg.wwwroot + '/local/rbvis/ajax.php';
            var selector = $("#tfiid_report_local_rbvis_form_report_selector");
            selector.change(function () {
                if (selector.val() <= 0) {
                    container.html('');
                } else {
                    $.post(ajax_url, {
                        id: selector.val()
                    }).done(RenderDashboard);
                }
            });
        }
    };
});