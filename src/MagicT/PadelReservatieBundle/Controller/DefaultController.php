<?php

namespace MagicT\PadelReservatieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use MagicT\PadelReservatieBundle\Entity\ReservatieRepository;
use MagicT\PadelReservatieBundle\Entity\ReservatieTypeRepository;
use MagicT\PadelReservatieBundle\Entity\Reservatie;
use MagicT\PadelReservatieBundle\Entity\ReservatieType;
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

            //
            //dump($reservatie);

            $em->persist($reservatie);
            $em->flush();
            
        }
        

        return(new Response("welkom"));
    }

    /**
     * Ajax call om reservatie op te slaan
     *
     * @Route("/slaop", name="saveajaxreservatie", options={"expose"=true})
     * @Method("POST")
     */
    public function saveajaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();


        if(is_null($user)){
            return new Response("Geen gebruiker ingelogd");
        }
        
        $allemaal = $request->query->all();
        $users = $request->get('users');
        $veld = $request->get('nummerveld');
        $datum = new \DateTime($request->get('datum'));
        $startuur = new \DateTime($request->get('startuur'));
        $reservatietype = $request->get('reservatietype');

        
        //dump($this->get('security.token_storage')->getToken()->getUser());
        //die();
        $reservatie = new Reservatie();
        $reservatie->setCreatedBy($this->get('security.token_storage')->getToken()->getUser());
        $reservatie->setDatum($datum);
        $reservatie->setStartuur($startuur);
        $reservatie->setVeld($em->getRepository('PadelReservatieBundle:Veld')->find($veld));
        $reservatie->setReservatieType($em->getRepository('PadelReservatieBundle:ReservatieType')->find($reservatietype));
        $reservatie->setDatum($datum);
        $users = explode(",", join($users));
        //dump($reservatie);

        foreach($users as $speler){
            $padelspeler = $em->getRepository('PadelUserBundle:PadelUser')->find($speler);
            $reservatie->addPadelUser($padelspeler);
        }
        //dump($reservatie);
        //die();

        $em->persist($reservatie);
        $em->flush();       
        
        $response = array("code" => 200, "success" => true);
        return new Response(json_encode($response)); 
    }

    /**
     * Ajax call om reservatie op te slaan
     *
     * @Route("/verwijderreservatie", name="verwijderajaxreservatie", options={"expose"=true})
     * @Method("DELETE")
     */
    public function verwijderreservatieAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reservatieid = $request->get('reservatieid');

        $voortdoen = false;
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $voortdoen = true;
        }else{

        }

        if($voortdoen){
            $reservatie = $em->getRepository('PadelReservatieBundle:Reservatie')->find($reservatieid);
            if(!is_null($reservatie)){
                $em->remove($reservatie);
                $em->flush();
                $response = array("code" => 200, "success" => true);
                return new Response(json_encode($response));     
            }else{
                $response = array("code" => 404, "success" => false);
                return new Response(json_encode($response));     
            }
        }else{
            $response = array("code" => 401, "success" => false);
            return new Response(json_encode($response)); 
        }
        
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
                
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $magreserveren = $doc->getRepository('PadelUserBundle:PadelUser')->magReserveren($user);
        
        
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
                    'leden'=>$leden,
                    'magreserveren' => $magreserveren
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

