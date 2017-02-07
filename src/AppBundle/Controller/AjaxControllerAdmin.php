<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;



class AjaxControllerAdmin extends Controller {
    
    /**
     * @Route("/admin/message/supr/{id}")
     */
    function SuprMessage ($id){
  
        $em = $this->getDoctrine()->getManager();
        $recupId = $em->find("AppBundle:Message", $id);
        $em->remove($recupId);
        $em->flush();
        
  
$reponseJson = new JsonResponse();         
         return $reponseJson->setData($id);
    }
}
