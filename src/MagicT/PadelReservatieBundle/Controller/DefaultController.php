<?php

namespace MagicT\PadelReservatieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagicT\PadelReservatieBundle\Entity\ReservatieRepository;
use MagicT\PadelReservatieBundle\Entity\ReservatieTypeRepository;
use MagicT\PadelReservatieBundle\Entity\Reservatie;
use JMS\Serializer\SerializationContext;

use MagicT\PadelUserBundle\Entity\PadelUserRepository;

use Symfony\Component\HttpFoundation\Response;


    
class DefaultController extends Controller
{
    
    /**
     * @Route("/laadfictieve")
     */
    public function LaadVeleReservaties()
    {
        set_time_limit(300);
        $userrepo =     $this->getDoctrine()->getRepository('PadelUserBundle:PadelUser');
        $rtyperepo =    $this->getDoctrine()->getRepository('PadelReservatieBundle:ReservatieType');
        $veldrepo =     $this->getDoctrine()->getRepository('PadelReservatieBundle:Veld');
        $em = $this->getDoctrine()->getManager();

        for($teller=1;$teller<20;$teller++){
            $reservatie = new Reservatie();
            $reservatie->setCreatedBy($userrepo->findOneRandom());
            $eerste = $userrepo->findOneRandom();
            $reservatie->addPadelUser($eerste);
            $tweede = $userrepo->findOneRandom();
            while($tweede->getId() == $eerste->getId()){
                $tweede = $userrepo->findOneRandom();
            }
            $reservatie->addPadelUser($tweede);

            $test = $rtyperepo->find(rand(1,4));

            $reservatie->setReservatieType($test);
            $veldje = $veldrepo->findOneRandom();
            
            $reservatie->setVeld($veldje);
            $startuur = $veldje->getStartuur();
            $datum = new \DateTime();

            $tekst = "PT" . rand(0,10) . "H";
            $hoeveel = rand(-3,3);
            $datumtekst = "P" . abs($hoeveel) . "D";
            
            if($hoeveel>0){
                $datum->add(new \DateInterval($datumtekst));
            }else{
                $datum->sub(new \DateInterval($datumtekst));
            }
            
            
            $startuur->add(new \DateInterval($tekst));

            $reservatie->setDatum($datum);
            $reservatie->setStartUur($startuur);

            dump($reservatie);

            $em->persist($reservatie);
            $em->flush();
            
        }
        

        return(new Response("welkom"));
    }

    /**
     * @Route("/{jaar}/{maand}/{dag}", name="reservatie_op_datum", options={"expose"=true})
     * 
     */
    public function indexAction($jaar = null, $maand = null, $dag = null)
    {        
    	$this->controleerDatum();
        $ajax= false;
        $doc = $this->getDoctrine();
        if(is_null($jaar)){
            $datum = new \DateTime();
        }else{
            $datum = new \DateTime('@' . mktime(10,0,0,$maand, $dag, $jaar));
            $ajax= true;
            
            //$datum = \DateTime::createFromFormat('jmY', $datum);
            if(!$datum){
                throw $this->createNotFoundException('Foutieve datum opgegeven, formaat is ddmmjjjj (vb. 16032015)');    
            }
        }
                
        
        

        if($ajax){
            $reservatiesvoordag = $doc->getRepository('PadelReservatieBundle:Reservatie')->findVoorDag($datum);
            //dump($reservatiesvoordag);
            //die();
            $serializedEntity = $this->container->get('serializer')->serialize($reservatiesvoordag, 'json', SerializationContext::create()->enableMaxDepthChecks());
            //dump($serializedEntity);
            //die("hoho");
            $response = new Response($serializedEntity, Response::HTTP_OK);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
            
        }else{
            $vandaag = new \DateTime();
            $startuur = mktime("8","0","0");
            $startuur = date("h:i",$startuur);
            $einduur = new \DateTime();
            $einduur->setTime(23, 00);      
            $velden = $doc->getRepository('PadelReservatieBundle:Veld')->findAll();
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
            $leden = $doc->getRepository('PadelUserBundle:PadelUser')->findAllActieveLeden();
            return $this->render('PadelReservatieBundle::overzicht.html.twig', 
                array(
                    'reservatiesperveld' => $reservatiesperveld,
                    'startuur' => '07:30',
                    'einduur' => $einduur,
                    'velden' => $velden,
                    'datum' => $datum,
                    'leden'=>$leden
                )
            );
        }
    }

    private function controleerDatum(){
        $laatstgecontroleerd = $this->get('settings_manager')->get('laatstgecontroleerd');

        $vandaag = date("d-m-Y");
        if($vandaag>$laatstgecontroleerd){
            $this->redirectToRoute("paslidmaatschapaan");
            $this->get('settings_manager')->set('laatstgecontroleerd',$vandaag);
        }

    }

    private function VindReservatieVoorUur($reservaties,$uur) {

        foreach($reservaties as $index => $reservatie) {
            if($reservatie->getStartuur() == $uur) return ($index+1);

        }
        return false;
    }


}

