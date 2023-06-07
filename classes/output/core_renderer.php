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
class core_renderer extends \theme_boost\output\core_renderer { 

    /**
     * Renders the footer links.
     *
     * @return string the HTML for the footer links.
     */
    public function rosehillfooterlinks() {
        
        $footeritems = [
            '<a href="http://www.falmouth.ac.uk/" class="footer-links__link-item">&copy; ' . date('Y') . ' Falmouth University</a>',
            '<a href="http://dl.falmouth.ac.uk" class="footer-links__link-item">Digital Learning</a>',
            '<a href="https://falmouthac.sharepoint.com/ict/info/Shared%20Documents/Forms/AllItems.aspx?id=%2Fict%2Finfo%2FShared%20Documents%2FMoodle%20Copyright%20%26%20Data%20Protection%20Statement%2Epdf&parent=%2Fict%2Finfo%2FShared%20Documents&p=true&slrid=7e9f7d9e-50c7-6000-1297-403eb05f7bff" class="footer-links__link-item">Copyright compliance</a>',
            '<a href="https://www.falmouth.ac.uk/data-privacy-learning-space-users" class="footer-links__link-item">Privacy</a>',
            '<a href="https://student.falmouth.ac.uk" class="footer-links__link-item">Student portal</a>',
            '<a href="https://www.falmouth.ac.uk/falmouth-learning-space-accessibility-statement" class="footer-links__link-item">Accessibility</a>'
        ];
        

        
        $templatedata = [
            'footeritems' => $footeritems
        ];

        
        // return 'this is a test';
        return $this->render_from_template('theme_rosehill/footer-links', $templatedata);

    }

}