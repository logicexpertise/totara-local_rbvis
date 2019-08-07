/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define([], function () {
    window.requirejs.config({
        paths: {
           // Paths to required java-script files
           "plotly": M.cfg.wwwroot + "/local/rbvis/ext/plotly/dist/plotly-basic.min",
           "plotly_renderers": M.cfg.wwwroot + "/local/rbvis/ext/pivottable/dist/plotly_renderers.min",
           "pivot": M.cfg.wwwroot + "/local/rbvis/ext/pivottable/dist/pivot.min"
        },
        shim: {
           // The "names" that will be used to refer to libraries
           'plotly': {exports: 'plotly'},
           'plotly_renderers': {exports: 'plotly_renderers'},
           'pivot': {exports: 'pivot'}
        }
    });
});