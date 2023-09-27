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

use moodle_url;
use html_writer;
use get_string;

defined('MOODLE_INTERNAL') || die;

/**
 * Renderers for Rosehill theme
 *
 * @package    theme_rosehill
 * @copyright  2023 Falmouth University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Overrides for the standard implementation of the core_renderer interface.
 * Original classes located in lib/outputrenders.php and in boost/classes/output/core_renderer.php
 */
class core_renderer extends \theme_boost\output\core_renderer {

    /**
	 * Renders the footer links.
	 *
	 * @return string the HTML for the footer links.
	 */
    public function getFooterLinks() {

        // Get all footer link fields from theme settings
        $footeritems = [
            'footerLink1' => [
                get_config('theme_rosehill', 'footerlinktext1'),
                get_config('theme_rosehill', 'footerlinkurl1')
            ],
            'footerLink2' => [
                get_config('theme_rosehill', 'footerlinktext2'),
                get_config('theme_rosehill', 'footerlinkurl2')
            ],
            'footerLink3' => [
                get_config('theme_rosehill', 'footerlinktext3'),
                get_config('theme_rosehill', 'footerlinkurl3')
            ],
            'footerLink4' => [
                get_config('theme_rosehill', 'footerlinktext4'),
                get_config('theme_rosehill', 'footerlinkurl4')
            ],
            'footerLink5' => [
                get_config('theme_rosehill', 'footerlinktext5'),
                get_config('theme_rosehill', 'footerlinkurl5')
            ],
            'footerLink6' => [
                get_config('theme_rosehill', 'footerlinktext6'),
                get_config('theme_rosehill', 'footerlinkurl6')
            ]
        ];

        // Temporary array for building template data
        // - included copyright info by default
        $tmp = [ 
            [
                'text'=>'&copy; ' . date('Y') . ' Falmouth University',
                'url' => 'https://www.falmouth.ac.uk/'
            ]
        ];
        
        // loop through, trim whitespace and only render if both text and url are filled out
        foreach ($footeritems as $key => $value) {
            if (strlen(trim($value[0])) > 0) {
                if (strlen(trim($value[1])) > 0) {
                    array_push($tmp, array('text'=>$value[0], 'url'=>$value[1]));
                }
            }
        }

        // Setup for use in template
        $items = [
            'items' => $tmp
        ];

        return $this->render_from_template('theme_rosehill/footer-links', $items);
    }

	/**
	 * change colour of default course background overview to be uniform
	 */
	public function get_generated_color_for_id($id) {

	  // $color = '#f6ce4c'; // primary-yellow
	  $color = '#116a6c'; // primary-green

	  return $color;
	}

}