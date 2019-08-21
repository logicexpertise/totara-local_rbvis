<?php

/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

function xmldb_local_rbvis_uninstall() {
    global $DB;

    if ($record = $DB->get_record('totara_navigation', array('classname' => '\local_rbvis\menu\rbvis'))) {
        $trans = $DB->start_delegated_transaction();

        $DB->delete_records('totara_navigation_settings', array('itemid' => $record->id));
        $DB->delete_records('totara_navigation', array('id' => $record->id));
        $trans->allow_commit();

        // Add to log.
        \totara_core\event\menuitem_deleted::create_from_item($record->id)->trigger();
    }
    return true;
}
