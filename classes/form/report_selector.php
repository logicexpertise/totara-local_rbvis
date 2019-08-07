<?php

/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_rbvis\form;

require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');

use reportbuilder;

class report_selector extends \totara_form\form {

    protected function definition() {
        
        $this->get_form_controller();
        $reports = get_my_reports_list();

        $options = [];

        foreach ($reports as $report) {
            $options[$report->id] = $report->fullname;
        }

        $choices = [0 => get_string('choosedots')] + $options;
        
        $select = $this->model->add(new \totara_form\form\element\select('report', get_string('choosereport', 'local_rbvis'), $choices));
        $select->set_attribute('required', true);
        
    }

}
