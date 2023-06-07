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
 * Contain the logic for toggling manual login fields on login page
 *
 * @module theme_rosehill/toggle-manual-login
 * @copyright  2023 Alex Mellor
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import $ from 'jquery';

export const init = () => {

    var $footerLinks = $('.footer-links');
    var $navItem = $('<li class="footer-links__list-item"></li>');
    var $trigger = $('<a href="#" class="footer-links__link-item" id="ls-adm-login">Admin</a>');
    var $admLogin = $('.login-form');
    $trigger.on('click', function(e) {
        e.preventDefault();
        $admLogin.toggleClass('hidden');
    });
    $navItem.append($trigger);
    $footerLinks.append($navItem);

};