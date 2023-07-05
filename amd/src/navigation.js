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

/**
 * logic for manipulating navigation on all pages
 *
 * @module theme_rosehill/navigation
 * @copyright 2023, Falmouth University Digital, Development & Support <dds@falmouth.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import $ from 'jquery';

export const init = () => {

    /* desktop navigation elements */
    $('.navbar-expand .navbar-nav .nav-link').hideNavLinks();

    /* mobile navigation elements */
    $('.drawercontent .list-group .list-group-item').hideNavLinks();

};

/**
 * work around for filtercodes plugin limitation
 * hide navigation hyperlinks containing only whitespace
 * hide duplicate /course/ entry
 */
$.fn.hideNavLinks = function() {

    var courseUrlCount = 0;
    $(this).each(function(i, el) {

        var courseUrl = false;
        if(typeof el.href === 'string' && el.href.indexOf('/course/') >= 0 && el.text !== null && $.trim(el.text) !== '') {
            courseUrl = true;
        }
        if(el.text === null || $.trim(el.text) === '' || (courseUrl && courseUrlCount > 0)) {
            $(el).hide();
        }
        if(courseUrl) {
            courseUrlCount = 1;
        }
    });
};