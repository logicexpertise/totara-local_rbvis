<?php

/**
 *
 * @package
 * @subpackage
 * @copyright   2019 Olumuyiwa Taiwo <muyi.taiwo@logicexpertise.com>
 * @author      Olumuyiwa Taiwo {@link https://moodle.org/user/view.php?id=416594}
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_rbvis\menu;

use \totara_core\totara\menu\menu as totara_core_menu;

class rbvis extends \totara_core\totara\menu\item {
    protected function get_default_title() {
        return get_string('dashboardvis', 'local_rbvis');
    }
    protected function get_default_url() {
        return '/local/rbvis/dashboard.php';
        
    }
    
    protected function get_default_parent() {
        return '\totara_core\totara\menu\myreports';
    }
    
    public function get_default_visibility() {
        return totara_core_menu::SHOW_ALWAYS;
    }
}