<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\NewCaroussel;
use AppBundle\Entity\Partenaire;
use AppBundle\Entity\Promos;
use AppBundle\Form\MessageType;
use AppBundle\Form\NewCarousselType;
use AppBundle\Form\PartenaireType;
use AppBundle\Form\PromosType;
use AppBundle\Form\TexteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ControleurCrudAdmin extends Controller {
    ///// Modification Texte 

    /**
     * @Route("/admin", name ="homeAdmin")
     * @Template("default/pagesAdmin/homeAdmin.html.twig")
     */
    function getAdmin() {
        
    }

    /**
     * Methode retourne formulaire TexteType maper sur son entity grace a son id 
     * 
     * @Route("/admin/modifTexte/{id}",name ="modifTexte" )
     * @Template("default/pagesAdmin/modifTexte.html.twig")
     */
    function modifSection($id) {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->find('AppBundle:Texte', $id);
        $f = $this->createForm(TexteType::class, $annonce);


        return array('formtexte' => $f->createView(), "id" => $id);
    }

    /**
     * Cette methode est appelé quand le formulaire est validé 
     * 
     * @Route("/admin/modifSection/update/{id}", name="updateSection")
     */
    public function updateSection(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        //Cette partie ce fait avent la requet :
        // Je vais cherher sur mon entite encore svg en DB sa classe et la met dans :  $classe_courante
        $idTexte = $em->find('AppBundle:Texte', $id);
        $classe_courante = $idTexte->getClasse();

        // je crees mon nouvaux formulaire 
        $annonce = $em->find('AppBundle:Texte', $id);
        $f = $this->createForm(TexteType::class, $annonce);

        // Cette partie ce fait apres la requet  : 
        if ($request->getMethod() == 'POST') {
            $f->handleRequest($request);


//            Plus tard pour les images :) 
//            $nomDuFichier = md5(uniqid()).".".$annonce->getPhoto()->getClientOriginalExtension();
//            $annonce->getPhoto()->move('uploads/images', $nomDuFichier);
//            $annonce->setPhoto($nomDuFichier);
//            
            // Je (re)donne ma classe  
            $annonce->setClasse($classe_courante);
            // En gros :
            //Je commit j
            $em->merge($annonce);
            //je push
            $em->flush();
            //je retourne vers ... 'name space'
            return $this->redirect($this->generateUrl('home'));
        }
    }

    /////  Gestion Partenaire 
    //// Genere nouvaux Partenaire et appel son formulaire 

    /**
     * @Route("/admin/modifPartenaire/", name="modifParte")
     * @Template("default/pagesAdmin/modifPartenaires.html.twig")
     * @param Request $request
     */
    public function formPartenaire(Request $request) {
        // on creer notre objet Partenaire 
        $parte = new Partenaire();
        // on lie notre formulaire a notre entity
        $f = $this->createForm(PartenaireType::class, $parte);
        // et on retourne le formulaire dans notre vue
        return array("formParte" => $f->createView());
    }

    /**
     * @Route("/admin/modifPartenaire/update", name="updateParte")
     * 
     */
    function updatePartenaire(Request $request) {

        $parte = new Partenaire();
        $f = $this->createForm(PartenaireType::class, $parte);
        // on verifie que la requette est bien de type post
        if ($request->getMethod() == 'POST') {
            $f->handleRequest($request);
            // on recupere le nom du fichier, on genere un nom numerique aleatoire et on creer un dossier uploads/images 
            $nomDuFichier = md5(uniqid()) . "." . $parte->getLogo()->getClientOriginalExtension();
            $parte->getLogo()->move('upload/partenaire', $nomDuFichier);
            $parte->setLogo($nomDuFichier);
            $em = $this->getDoctrine()->getManager();
            // on sauvegarde en local
            $em->persist($parte);
            // et on envoi en base de donnee
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }
    }

    /////  Gestion Promotion 
    //// Genere nouvelle promotion et appel son formulaire 

    /**
     * @Route("/admin/modifPromotion/", name="createPromotion")
     * @Template("default/pagesAdmin/modifPromotion.html.twig")
     * @param Request $request
     */
    public function formPromos(Request $request) {
        // on creer notre objet Promotion 
        $promos = new Promos();
        // on lie notre formulaire a notre entity
        $f = $this->createForm(PromosType::class, $promos);
        // et on retourne le formulaire dans notre vue
        return array("formPromos" => $f->createView());
    }

    /**
     * @Route("/admin/modifPromotion/update", name="updatePromos")
     * 
     */
    function updatePromotion(Request $request) {

        $promos = new Promos();
        $f = $this->createForm(PromosType::class, $promos);
        // on verifie que la requette est bien de type post
        if ($request->getMethod() == 'POST') {
            $f->handleRequest($request);

            $em = $this->getDoctrine()->getManager();
            // on sauvegarde en local
            $em->persist($promos);
            // et on envoi en base de donnee
            $em->flush();

            return $this->redirect($this->generateUrl('homeAdmin'));
        }
    }

    /** //// Affichage listPromotion 
     * @Route("/admin/listpromotion", name="listpromotion")
     * @Template("default/pagesAdmin/listPromotion.html.twig")
     */
    public function getList() {
        $em = $this->getDoctrine();
        $texts = $em->getRepository("AppBundle:Promos")->findAll();
        return array('sectionText' => $texts);
    }

    /** //// Liste Candidat 
     * @Route("/admin/candidat", name="getCandidat")
     * @Template("default/pagesAdmin/listeCandidat.html.twig")
     */
    public function getCandidat() {
        ////// Recuperation des user Candidat 
        $emCandi = $this->getDoctrine();
        $candidats = $emCandi->getRepository("AppBundle:User")->findBycandidat(1);

        return array('candidats' => $candidats);
    }

    /** //// Liste Message 
     * @Route("/admin/message", name="getMessage")
     * @Template("default/pagesAdmin/listeMessage.html.twig")
     */
    public function getMessage() {
        ////// Recuperation des message
        $emMessa = $this->getDoctrine();
        $messages = $emMessa->getRepository("AppBundle:Message")->findAll();



        return array('messages' => $messages);
    }

    /**
     * ///// Voir Detail Message
     * @Route("/admin/message/detail/{id}", name="detailMessage")
     * @Template("default/pagesAdmin/detailMessage.html.twig")
     */
    public function detailMessage($id) {
        $em = $this->getDoctrine();
//        l'entity est selectioné par son id et est mis dans $messages qui est un tableaux
        $messages = $em->getRepository("AppBundle:Message")->findByid($id);


        return array('messages' => $messages);
    }

    /**
     * ///Repondre Message
     * @Route("/admin/message/rep/{mail}", name="repMessage")
     * @Template("default/pagesAdmin/repMessage.html.twig")
     */
    public function repMessage(Request $request, $mail) {
        $reponse = new Message();
        $f = $this->createForm(MessageType::class, $reponse);

        if ($request->getMethod() == 'POST') {
            $f->handleRequest($request);
            $mailBody = $reponse->getMessage();
            $mailObjet = $reponse->getObjet();

            $message = Swift_Message::newInstance()
                    ->setFrom('leboloc@gmail.com')
                    ->setTo($mail)
                    ->setSubject($mailObjet)
                    ->setBody($mailBody);
            $this->get('mailer')->send($message);
        }
        return array("formRep" => $f->createView(), "mail" => $mail);
    }

    /**
     * @Route("/admin/creatNew",name ="formNew")
     * @Template("default/pagesAdmin/formNew.html.twig")
     * @param Request $request
     */
    public function CreateNew(Request $request) {
        $news = new NewCaroussel();
        $f = $this->createForm(NewCarousselType::class, $news);
        return array("formNews" => $f->createView());
    }

    /**
     * @Route("/admin/creatNew/validation",name ="creatNews")
     * @Template("default/pagesAdmin/formNew.html.twig")
     */
    public function ValidCreateNew(Request $request) {
        $new = new NewCaroussel();
        $f = $this->createForm(NewCarousselType::class, $new);
        // on verifie que la requette est bien de type post
        if ($request->getMethod() == 'POST') {
            $f->handleRequest($request);
            // on recupere le nom du fichier, on genere un nom numerique aleatoire et on creer un dossier uploads/images 
            $nomDuFichier = md5(uniqid()) . "." . $new->getImages()->getClientOriginalExtension();
            $new->getImages()->move('upload/news', $nomDuFichier);
            $new->setImages($nomDuFichier);
            $em = $this->getDoctrine()->getManager();
            // on sauvegarde en local
            $em->persist($new);
            // et on envoi en base de donnee
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }
    }

}
