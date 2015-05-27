<?php

namespace MagicT\PadelUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MagicT\PadelUserBundle\Entity\PadelUser;
use Symfony\Component\HttpFoundation\Response;


class PadelUserRestController extends Controller
{
  public function getUserAction($username){
    $user = $this->getDoctrine()->getRepository('PadelUserBundle:PadelUser')->findOneByUsername($username);
    if(!is_object($user)){
      throw $this->createNotFoundException();
    }
    return $user;
  }

  public function getActiveMembersAction(){
    $users = $this->getDoctrine()->getRepository('PadelUserBundle:PadelUser')->findAllActieveLeden();

    /*if(!is_object($users)){

      throw $this->createNotFoundException();
    }*/

    return $users;
  }
}