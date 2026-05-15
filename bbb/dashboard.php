<?php

/**
 * Handles the BBB learning dashboard redirect.
 *
 * @package     local_bbb
 * @author      MohammadReza PourMohammad <onbirdev@gmail.com>
 * @copyright   2026 MohammadReza PourMohammad
 * @link        https://onbir.dev
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get meeting ID from query.
$meeting_id = $_GET['meeting'] ?? null;

if (!$meeting_id) {
    http_response_code(400);
    exit('Missing meeting id');
}

// Base path of BBB learning dashboard data.
$base_path = '/var/bigbluebutton/learning-dashboard/' . $meeting_id;

// Check if meeting folder exists.
if (!is_dir($base_path)) {
    http_response_code(404);
    exit('Meeting not found');
}

// Scan report folders.
$reports = array_values(array_filter(scandir($base_path), function ($item) {
    return $item !== '.' && $item !== '..';
}));

if (empty($reports)) {
    http_response_code(404);
    exit('No report found');
}

// Find latest report (by modification time).
$latest_report = null;
$latest_time = 0;

foreach ($reports as $report) {
    $path = $base_path . '/' . $report;

    if (is_dir($path)) {
        $time = filemtime($path);

        if ($time > $latest_time) {
            $latest_time = $time;
            $latest_report = $report;
        }
    }
}

if (!$latest_report) {
    http_response_code(404);
    exit('Report token not found');
}

// Build final URL.
$redirect_url = '/learning-analytics-dashboard/'
    . '?meeting=' . urlencode($meeting_id)
    . '&report=' . urlencode($latest_report)
    . '&lang=fa-IR';

// Redirect user.
header('Location: ' . $redirect_url);
exit;
