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

namespace local_bbb\local\utils;

/**
 * Provides utility methods for working with URLs.
 *
 * @package     local_bbb
 * @author      MohammadReza PourMohammad <onbirdev@gmail.com>
 * @copyright   2026 MohammadReza PourMohammad
 * @link        https://onbir.dev
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class url_utils {
    /**
     * Extracts and returns the base URL from a given full URL string.
     *
     * @param string $url The full URL string to extract the base URL from.
     *
     * @return string The base URL consisting of the scheme, host, and optionally the port.
     *                Returns an empty string if the input URL is invalid or missing required components.
     */
    public static function get_base_url(string $url): string {
        $parts = parse_url(trim($url));

        if (!$parts || !isset($parts['scheme'], $parts['host'])) {
            return '';
        }

        $base_url = $parts['scheme'] . '://' . $parts['host'];

        if (isset($parts['port'])) {
            $base_url .= ':' . $parts['port'];
        }

        return rtrim($base_url, '/');
    }
}
