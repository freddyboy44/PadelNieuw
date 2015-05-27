<?php

namespace MagicT\PadelUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagicT\PadelUserBundle\Entity\PadelUser;
use Symfony\Component\HttpFoundation\Response;

    
class DefaultController extends Controller
{
    /**
     * @Route("/test")
     * 
     */
    public function indexAction()
    {
        $product = $this->getDoctrine()
        ->getRepository('PadelUserBundle:PadelUser')
        ->find(6);
        dump($product);
        die();
    }

    
    
    
    /**
     * @Route("/ajax_users", name="ajax_users")
     * 
     */
    public function getAjaxUsers(){
        $users = $this->getDoctrine()->getRepository('PadelUserBundle:PadelUser')->findAllActieveLeden();
        //$users
        //dump($users);
        //die();
    }

    /**
     * @Route("/paslidmaatschappenaan",name="paslidmaatschapaan")
     * 
     */
    public function pasLidmaatschappenaanAction(){
        $users = $this->getDoctrine()->getRepository('PadelUserBundle:PadelUser')->findAll();
        $em = $this->getDoctrine()->getManager();
        foreach($users as $user){
            $datumtot = $user->getDatumLidTot();
            if(!is_null($datumtot)){
                $user->setLidTot($datumtot);
                $em->persist($user);
                $em->flush();    
            }
        }
         return new Response('Datums zijn aangepast!');
    }
}

