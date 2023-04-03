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

/**
 * Lib data for the theme_rosehill plugin.
 *
 * @package   theme_rosehill
 * @copyright 2023, Falmouth University Digital, Development & Support <dds@falmouth.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

function theme_rosehill_get_main_scss_content($theme) {
	global $CFG;

	$scss = '';
	$filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
	$fs = get_file_storage();

	$context = context_system::instance();
	if ($filename == 'default.scss') {
		// We still load the default preset files directly from the boost theme. No sense in duplicating them.
		$scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
	} else if ($filename == 'plain.scss') {
		// We still load the default preset files directly from the boost theme. No sense in duplicating them.
		$scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');

	} else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_rosehill', 'preset', 0, '/', $filename))) {
		// This preset file was fetched from the file area for theme_rosehill and not theme_boost (see the line above).
		$scss .= $presetfile->get_content();
	} else {
		// Safety fallback - maybe new installs etc.
		$scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
	}

	// Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.
	$pre = file_get_contents($CFG->dirroot . '/theme/rosehill/scss/pre.scss');
	// Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
	$post = file_get_contents($CFG->dirroot . '/theme/rosehill/scss/post.scss');

	// Combine them together.
	return $pre . "\n" . $scss . "\n" . $post;
}

// function theme_rosehill_get_extra_scss($theme) {
// 	$content = '';
// 	$imageurl = $theme->setting_file_url('backgroundimage', 'backgroundimage');
//
// 	// Sets the background image, and its settings.
// 	if (!empty($imageurl)) {
// 		$content .= '@media (min-width: 768px) {';
// 		$content .= 'body { ';
// 		$content .= "background-image: url('$imageurl'); background-size: cover;";
// 		$content .= ' } }';
// 	}
//
// 	// Sets the login background image.
// 	$loginbackgroundimageurl = $theme->setting_file_url('loginbackgroundimage', 'loginbackgroundimage');
// 	if (!empty($loginbackgroundimageurl)) {
// 		$content .= 'body.pagelayout-login #page { ';
// 		$content .= "background-image: url('$loginbackgroundimageurl'); background-size: cover;";
// 		$content .= ' }';
// 	}
//
// 	// Always return the background image with the scss when we have it.
// 	return !empty($theme->settings->scss) ? $theme->settings->scss . ' ' . $content : $content;
// }

// @src: https://www.dgmyspace.dumgal.ac.uk/eportfolio/rumbler/2023/02/02/moodle-theming-4-1-login-background-image/
function theme_rosehill_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
	if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'logo' || $filearea === 'backgroundimage' || $filearea === 'loginbackgroundimage')) {
		$theme = theme_config::load('rosehill');
		// By default, theme files must be cache-able by both browsers and proxies.
		if (!array_key_exists('cacheability', $options)) {
			$options['cacheability'] = 'public';
		}
		return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
	} else {
		send_file_not_found();
	}
}