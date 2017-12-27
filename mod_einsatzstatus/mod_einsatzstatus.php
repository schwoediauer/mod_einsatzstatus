<?php
/**
 * @author     Juergen Schwoediauer
 * @copyright  Copyright (C) Juergen Schwoediauer.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

//$tester='Einsatz Status';
//Modul Parameter ermitteln
$xmlurl = $params->get('xmlurl');

// Einsaetze aus xml ermitteln
$Einsatz = modeinsatzstatus::getEinsatzStatus($params);
    
    
require JModuleHelper::getLayoutPath('mod_einsatzstatus');




    
