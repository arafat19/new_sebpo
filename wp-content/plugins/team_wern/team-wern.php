<?php
/**
 *
 * @package   team_wern
 * @author    Mohammed Mohasin <mohasinctg@gmail.com>
 * @copyright 2016 Mohammed Mohasin
 *
 * @wordpress-plugin
 * Plugin Name:			Team Wern
 * Plugin URI:			https://www.sebpo.com
 * Description:       	Team Wern plugin for warn Project. Display anywhere at your site using shortcode like [team_wern] and for header image [team_wern_header] .
 * Version:           	0.1.0
 * Author:       		Creative Team
 * Author URI:       	https://www.sebpo.com
 * Text Domain:
 * License:
 * License URI:
 */



//--------- CPT Logo ----------------------- 
require_once dirname(__FILE__) . '/includes/team-wern-cpt.php';


//--------- CPT's MetaBox ------------------ 
require_once dirname(__FILE__) . '/includes/team-wern-metabox.php';


//--------- CPT's Shortcode ---------------- 
require_once dirname(__FILE__) . '/includes/team-wern-shortcode.php';







