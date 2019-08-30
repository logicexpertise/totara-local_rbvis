<?php

/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(__DIR__ . '/../../config.php');

use local_rbvis\form\report_selector;

require_login();

$PAGE->set_context(context_user::instance($USER->id));
$PAGE->set_url('/local/rbvis/dashboard.php');
$PAGE->set_pagelayout('noblocks');
$PAGE->set_totara_menu_selected('\local_rbvis\totara\menu\rbvis');
$PAGE->set_title(get_string('dashboardvis', 'local_rbvis'));
$PAGE->requires->js_call_amd('local_rbvis/dashboard', 'init');
$PAGE->requires->js('/local/rbvis/ext/jquery_ui_touch_punch/jquery.ui.touch-punch.min.js');
$PAGE->requires->css('/local/rbvis/ext/pivottable/dist/pivot.css');

$mform = new report_selector();

echo $OUTPUT->header();

echo $mform->render();

echo \html_writer::div(html_writer::img(new moodle_url('/local/rbvis/pix/ajax-loader.gif'), get_string('loadingwait', 'local_rbvis')), 'ajax-loader', ['id' => 'spinner']);

echo \html_writer::start_div('dashboard-container');
echo \html_writer::div('', '', ['id' => 'dashboard']);
echo \html_writer::end_div();

echo $OUTPUT->footer();
