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
 * Library.
 *
 * @package     local_bbb
 * @author      MohammadReza PourMohammad <onbirdev@gmail.com>
 * @copyright   2026 MohammadReza PourMohammad
 * @link        https://onbir.dev
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extends the global navigation by adding functionality specific to BigBlueButton.
 *
 * @param global_navigation $navigation The global navigation object to extend.
 * @return void
 */
function local_bbb_extend_navigation(global_navigation $navigation): void {
    global $PAGE;

    if ($PAGE->url->compare(new moodle_url('/mod/bigbluebuttonbn/view.php'), URL_MATCH_BASE)) {
        $PAGE->requires->strings_for_js(['open_dashboard'], 'local_bbb');
        $PAGE->requires->js_call_amd('local_bbb/recordings', 'init');
    }
}
