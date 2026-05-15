<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Open BigBlueButton dashboard page.
 *
 * @package     local_bbb
 * @author      MohammadReza PourMohammad <onbirdev@gmail.com>
 * @copyright   2026 MohammadReza PourMohammad
 * @link        https://onbir.dev
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_bbb\local\utils\url_utils;

require_once('../../../config.php');
global $CFG, $DB, $USER;

require_login();
$system_context = context_system::instance();
require_capability('local/bbb:view_dashboard', $system_context);

$record_id = required_param('rid', PARAM_INT);

$recording = $DB->get_record('bigbluebuttonbn_recordings', ['id' => $record_id], '*', MUST_EXIST);

$bbb_url = url_utils::get_base_url((string) get_config('core', 'bigbluebuttonbn_server_url'));

$url = $bbb_url . '/bbb/dashboard.php?meeting=' . $recording->recordingid;
redirect($url);
