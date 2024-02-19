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
 * @package   theme_rosehill
 * @copyright 2023, Falmouth University Digital, Development & Support <dds@falmouth.ac.uk>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {

	$settings = new theme_boost_admin_settingspage_tabs('themesettingrosehill', get_string('configtitle', 'theme_rosehill'));
	
    

    // ///////////////////////////////////////////////
    // 
    // GENERAL SETTINGS
    //
    // ///////////////////////////////////////////////

    $page = new admin_settingpage('theme_rosehill_general', get_string('generalsettings', 'theme_rosehill'));

	// Unaddable blocks.
	// Blocks to be excluded when this theme is enabled in the "Add a block" list: Administration, Navigation, Courses and
	// Section links.
	$default = 'navigation,settings,course_list,section_links';
	$setting = new admin_setting_configtext('theme_rosehill/unaddableblocks',
		get_string('unaddableblocks', 'theme_rosehill'), get_string('unaddableblocks_desc', 'theme_rosehill'), $default, PARAM_TEXT);
	$page->add($setting);

	// Preset.
	$name = 'theme_rosehill/preset';
	$title = get_string('preset', 'theme_rosehill');
	$description = get_string('preset_desc', 'theme_rosehill');
	$default = 'default.scss';

	$context = context_system::instance();
	$fs = get_file_storage();
	$files = $fs->get_area_files($context->id, 'theme_rosehill', 'preset', 0, 'itemid, filepath, filename', false);

	$choices = [];
	foreach ($files as $file) {
		$choices[$file->get_filename()] = $file->get_filename();
	}
	// These are the built in presets.
	$choices['default.scss'] = 'default.scss';
	$choices['plain.scss'] = 'plain.scss';

	$setting = new admin_setting_configthemepreset($name, $title, $description, $default, $choices, 'rosehill');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	// Preset files setting.
	$name = 'theme_rosehill/presetfiles';
	$title = get_string('presetfiles','theme_rosehill');
	$description = get_string('presetfiles_desc', 'theme_rosehill');

	$setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
		array('maxfiles' => 20, 'accepted_types' => array('.scss')));
	$page->add($setting);

	// Background image setting.
	// $name = 'theme_rosehill/backgroundimage';
	// $title = get_string('backgroundimage', 'theme_rosehill');
	// $description = get_string('backgroundimage_desc', 'theme_rosehill');
	// $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
	// $setting->set_updatedcallback('theme_reset_all_caches');
	// $page->add($setting);

	// Login Background image setting.
	$name = 'theme_rosehill/loginbackgroundimage';
	$title = get_string('loginbackgroundimage', 'theme_rosehill');
	$description = get_string('loginbackgroundimage_desc', 'theme_rosehill');
	$setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbackgroundimage');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	// Variable $body-color.
	// We use an empty default value because the default colour should come from the preset.
	$name = 'theme_rosehill/brandcolor';
	$title = get_string('brandcolor', 'theme_rosehill');
	$description = get_string('brandcolor_desc', 'theme_rosehill');
	$setting = new admin_setting_configcolourpicker($name, $title, $description, '');
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	// Must add the page after definiting all the settings!
	$settings->add($page);

    

    // ///////////////////////////////////////////////
    // 
    // ADVANCED SETTINGS
    //
    // ///////////////////////////////////////////////

	$page = new admin_settingpage('theme_rosehill_advanced', get_string('advancedsettings', 'theme_rosehill'));

	// Raw SCSS to include before the content.
	$setting = new admin_setting_scsscode('theme_rosehill/scsspre',
		get_string('rawscsspre', 'theme_rosehill'), get_string('rawscsspre_desc', 'theme_rosehill'), '', PARAM_RAW);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	// Raw SCSS to include after the content.
	$setting = new admin_setting_scsscode('theme_rosehill/scss', get_string('rawscss', 'theme_rosehill'),
		get_string('rawscss_desc', 'theme_rosehill'), '', PARAM_RAW);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	$settings->add($page);



    // ///////////////////////////////////////////////
    // 
    // CUSTOM SETTINGS
    //
    // ///////////////////////////////////////////////
	
    $page = new admin_settingpage('theme_rosehill_custom', get_string('customsettings', 'theme_rosehill'));

	$setting = new admin_setting_configcheckbox('theme_rosehill/collapsetopics',
		get_string('collapsetopics', 'theme_rosehill'), get_string('collapsetopics_desc', 'theme_rosehill'), 0, 1, 0);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	$sectionchoices = array();
	$sectionchoices['collapsed'] = 'All Collapsed';
	$sectionchoices['expandcurrent'] = 'Expand Current Section';
	$sectionchoices['expandoverview'] = 'Expand Overview Section';

	$setting = new admin_setting_configselect('theme_rosehill/expandtopicchoice',
		get_string('expandtopicchoice', 'theme_rosehill'), get_string('expandtopicchoice_desc', 'theme_rosehill'), 'collapsed', $sectionchoices);
	$setting->set_updatedcallback('theme_reset_all_caches');
	$page->add($setting);

	$settings->add($page);



    // ///////////////////////////////////////////////
    // 
    // FOOTER LINKS SETTINGS
    //
    // ///////////////////////////////////////////////

    $urldesc = 'Enter a URL for the link text.';
    $linkdesc = 'Enter the link text for the URL.';
    // footersettings str
    $page = new admin_settingpage('theme_rosehill_footer', 'Footer settings', 'theme_rosehill');

    // Link 1
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext1', 'Footer link 1 text', $linkdesc, '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl1', 'Footer link 1 URL', $urldesc, '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Link 2
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext2', 'Footer link 2 text', $linkdesc, '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl2', 'Footer link 2 URL', $urldesc, '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Link 3
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext3', 'Footer link 3 text', $linkdesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl3', 'Footer link 3 URL', $urldesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Link 4
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext4', 'Footer link 4 text', $linkdesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl4', 'Footer link 4 URL', $urldesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Link 5
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext5', 'Footer link 5 text', $linkdesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl5', 'Footer link 5 URL', $urldesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    // Link 6
    $setting = new admin_setting_configtext('theme_rosehill/footerlinktext6', 'Footer link 6 text', $linkdesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtext('theme_rosehill/footerlinkurl6', 'Footer link 6 URL', $urldesc,  '', PARAM_NOTAGS, 50);  
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    $settings->add($page);
    
}