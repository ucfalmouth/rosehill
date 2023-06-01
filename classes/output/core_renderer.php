<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace theme_rosehill\output;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_rosehill
 * @copyright 2023, Falmouth University Digital, Development & Support <dds@falmouth.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Overrides for the standard implementation of the core_renderer interface.
 * Original classes located in lib/outputrenders.php and in boost/classes/output/core_renderer.php
 */
class core_renderer extends \theme_boost\output\core_renderer {

	/*
	* change colour of default course background overview to be uniform
	*/
	public function get_generated_color_for_id($id) {

		// $color = '#f6ce4c'; // primary-yellow
		$color = '#116a6c'; // primary-green

		return $color;
	}

}