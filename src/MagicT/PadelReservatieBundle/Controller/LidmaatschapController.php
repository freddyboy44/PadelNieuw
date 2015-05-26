<?php

namespace MagicT\PadelReservatieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagicT\PadelReservatieBundle\Entity\LidmaatschapRepository;
use MagicT\PadelReservatieBundle\Entity\Lidmaatschap;

    
class LidmaatschapController extends Controller
{
    /**
     * 
     */
    public function indexAction(\DateTime $datum = null, $ajax = false)
    {
        
    	if(is_null($datum)){
            $datum = new \DateTime();
        }
		$vandaag = new \DateTime();
    	$startuur = mktime("8","0","0");

        $doc = $this->getDoctrine();
    	$velden = $doc->getRepository('PadelReservatieBundle:Veld')->findAll();
        $einduur = new \DateTime();
        $einduur->setTime(23, 00);    	

    	$reservatiesperveld = array();
    	foreach ($velden as $veld) {

            $startuurveld = $veld->getStartuur();
            $startuurveldkort = $startuurveld->getTimestamp();

            $reservatiesvoorveld = $doc->getRepository('PadelReservatieBundle:Reservatie')->findVoorVeldDag($veld,$datum);
            
            if($startuurveldkort<$startuur){
                $startuur = $startuurveldkort;
            }
            array_push($reservatiesperveld, $reservatiesvoorveld);
    	}
        
        $startuur = date("h:i",$startuur);
        
        if($ajax){

        }else{
            return $this->render('PadelReservatieBundle::overzicht.html.twig', 
                array(
                    'reservatiesperveld' => $reservatiesperveld,
                    'startuur' => $startuur,
                    'einduur' => $einduur,
                    'velden' => $velden,
                    'datum' => $datum
                )
            );
        }
    }

    

    private function VindReservatieVoorUur($reservaties,$uur) {

        foreach($reservaties as $index => $reservatie) {
            if($reservatie->getStartuur() == $uur) return ($index+1);

        }
        return false;
    }
}
