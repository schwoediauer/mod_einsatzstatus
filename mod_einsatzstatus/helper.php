<?php
/**
 * @author     Juergen Schwoediauer
 * @copyright  Copyright (C) Juergen Schwoediauer.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die();

class modeinsatzstatus
{
    public static function getEinsatzStatus(&$params)
    {
        
        //Modul Parameter lesen
        $xmlurl = $params->get('xmlurl');
        $bereittext = $params->get('einsatzbereit');
        $einsatztext = $params->get('ausgerueckt');
        
        
        // XML ELISFahrzeugStatus laden
        $xml = @simplexml_load_file( $xmlurl);
        
        // prüfe ob Datei gelesen werden kann
        if($xml)
        {
            
            // check ob überhaupt ein Einsatz vorliegt
            if(empty($xml->Einsatzdaten->WCFEinsatzdaten->Einsatzgrund))
            {
               $returnstring = $bereittext;
            
            }
            
            //es liegt ein Einsatz vor
            else {
            	
                //Initialisierung
                $returnstring=$einsatztext."<br>";
                
                //Anzahl der Einsaetze ermitteln
                $nEinsatzCount = count($xml->Einsatzdaten->WCFEinsatzdaten);
                
                for ( $nCount=0; $nCount < $nEinsatzCount; $nCount++) {
                    
                    foreach ($xml->Einsatzdaten->WCFEinsatzdaten[$nCount]->Adresse as $Adresse ) {
                        foreach ($xml->Einsatzdaten->WCFEinsatzdaten[$nCount]->Einsatzgrund as $Einsatzgrund){
                            
                            //String zusammenbauen
                            $returnstring1 = $Einsatzgrund."<br>".$Adresse."<br>";
                            
                        }
                    }
                    
                    // Einsaetze aneinanderfuegen
                    $returnstring = $returnstring."<br>".$returnstring1;
                }
                
            }
            
            return $returnstring;
                
        }
        else
        {
            return 'Keine Verbindung zu ELIS!';
        }
      
    }
    
}
?>


