<?php

/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
include_once($CFG->dirroot . '/totara/reportbuilder/lib.php');

require_login();

$results = [];
$id = required_param('id', PARAM_INT);
if (!reportbuilder::is_capable($id)) {
    $results[] = [
        get_string('notcapable', 'local_rbvis') => get_string('notcapable_desc', 'local_rbvis'),
    ];
} else {
    try {
        $report = new reportbuilder($id);
        $columns = $report->columns;
        
        $fields = [];
        foreach ($columns as $column) {
            if ($column->display_column()) {
                $name = $report->format_column_heading($column, true);
                $fields[$name] = $name;
            }
        }

        list($query, $params) = $report->build_query();
        if ($records = $DB->get_recordset_sql($query, $params)) {
            $rows = [];
            foreach ($records as $record) {
                $rows[] = $report->src->process_data_row($record, '', $report);
            }
            $records->close();
        }
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $results[] = array_combine($fields, $row);
            }
        } else { // empty report - return column headings only
            $row = [];
            foreach ($fields as $field) {
                $row[] = null;
            }
            $results[] = array_combine($fields, $row);
        }
    } catch (moodle_exception $e) {
        // return error message
        $results[] = [
            get_string('reporterror', 'local_rbvis') => get_string('reporterror_desc', 'local_rbvis'),
        ];
    }
}
$json = json_encode($results);
echo $json;
die();
