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
 * Adds a responsive wrapper to Panopto videos
 *
 * @module theme_rosehill/pantopto-fix
 * @copyright 2024, Falmouth University, Digital Development & Support <dds@falmouth.ac.uk>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


export const init = () => {

    const allPanoptoVideos = document.querySelectorAll('iframe[src*="panopto"]');
    if (allPanoptoVideos.length) {
        const panoptoVideoArr = Array.from(allPanoptoVideos);
        panoptoVideoArr.forEach( (el) => {
            if ( !el.parentElement.classList.contains("responsive-video") ) {
                var responsiveVideoContainer = document.createElement("div");
                responsiveVideoContainer.classList.add("responsive-video");
                el.before(responsiveVideoContainer);
                responsiveVideoContainer.appendChild(el);
            }
        });
    }

};
