<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

/**
 * Description of ControleurCrud
 *
 * @author  Kimbidima Vivien
 */
class ControleurCrud extends Controller{
    
/**
 * @Route("/", name="home")
 * @Template("default/index.html.twig")
 */
    public function getTextSection(){
      $em = $this->getDoctrine();
      $texts = $em->getRepository("AppBundle:text")->findAll();
      return array ('sectionText' => $texts); 
        
    }
    
}
