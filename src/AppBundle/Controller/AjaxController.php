<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\Statut;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller {

    /**
     * /////// Envois candidature 
     * @Route("/candidatureValid ", name="valideCandidat")
     * 
     */
    public function candidatEnvois(Request $request) {


        $em = $this->getDoctrine()->getManager();
//        recup la requet jason 
        $mail = $request->get('mail');
        $nlBlooen = $request->get('newsletter');



        if ($this->tchekErore($mail) == TRUE){
//            echo ($this->tchekErore($mail));
            // Recup la liste de mail correspondent au mail recup  
            $listeuser = $this->getDoctrine()->getRepository(User::class)->findByMail($mail);
            // Si cette liste exsiste ( alors le mail existe ) 
            if (count($listeuser) > 0) {
                //  Alors je cible cette utilsateur 
                $Inscreption2 = $listeuser[0];
                // met a jours cette entity
                $em->merge($Inscreption2);
                // Si cette liste exsiste pas ( alors mail nouveaux ) 
            } else {
                $Inscreption2 = new User();
                $Inscreption2->setMail($mail);
                $em->persist($Inscreption2);
            }
            $Inscreption2->setNewsletter($nlBlooen);
            $Inscreption2->setCandidat(1);
            // on sauvegarde en local
            // et on envoi en base de donnee
            $em->flush();
            $reponseJson = new JsonResponse();
            return $reponseJson;
            
        } else {
            $reponseJson = new JsonResponse();
             return $reponseJson->setData($error = 1);
        }
        
    }

    private function tchekErore($input) {
        // Init flag a faux 
        $flag = FALSE;
        // si linput est vide 
        if ($input == FALSE) {
        // alors le falg devien vrais
            $flag = TRUE;
        //Sinon si le mail n'est pas valide 
        }elseif(!filter_var($input, FILTER_VALIDATE_EMAIL) === TRUE){
        // le flag devien vrais
            $flag = TRUE;
        }
        // enfin je retourne le flag
        return $flag;
    }

    /**
     * /////// Envois Contacte 
     * @Route("/contacteValid", name="valideContacte")
     */
    public function contacteEnvois(Request $request) {
//      Mail de lutilisateur de l'admin 
        $mailAdmin = "leboloc@gmail.com";
//      Recup la requet jason 
        $mailConta = $request->get('mailConta');
        $objConta = $request->get('objConta');
        $messConta = $request->get('messConta');
        /////Creation de l'User 
        $this->checkUser($mailConta);
        /////Creation de l'entity message (Svg message)
        $this->saveMail($mailConta, $objConta, $messConta);
        /////Creation et envoi de mail 
        $this->envoiMail($mailConta, $objConta, $messConta, $mailAdmin);

        return new JsonResponse();
    }

    private function checkUser($mailConta) {

        $emUser = $this->getDoctrine()->getManager();
        $listeuser = $this->getDoctrine()->getRepository(User::class)->findByMail($mailConta);
        // Si cette liste exsiste ( alors le mail existe ) 
        if (count($listeuser) > 0) {
            //  Alors je cible cette utilsateur 
            $initUser = $listeuser[0];
            // met a jours cette entity
            $emUser->merge($initUser);
            // Si cette liste exsiste pas ( alors mail nouveaux ) 
        } else {
            $initUser = new User();
            $initUser->setMail($mailConta);
            $emUser->persist($initUser);
        }
        $initUser->setNewsletter(1);
        $initUser->setCandidat(0);

        $emUser->flush();
    }

    private function saveMail($mailConta, $objConta, $messConta) {

        $emMessage = $this->getDoctrine()->getManager();

        $initMessage = new Message();

        $initMessage->setMail($mailConta);
        $initMessage->setObjet($objConta);
        $initMessage->setMessage($messConta);
        $initMessage->setSujet("Contact");
        $initMessage->setStatut($emMessage->find(Statut::class, 0));


        $emMessage->persist($initMessage);

        $emMessage->flush();
    }

    private function envoiMail($mailConta, $objConta, $messConta, $mailAdmin) {
        // Envoi du mail de contact
        $message = Swift_Message::newInstance()
                ->setFrom($mailConta)
                ->setTo($mailAdmin)
                ->setSubject("De  " . $mailConta . " : " . $objConta)
                ->setBody($messConta);
        $this->get('mailer')->send($message);

        // Envoi du mail de confirmation
        $messageConfirm = Swift_Message::newInstance()
                ->setFrom($mailAdmin)
                ->setTo($mailConta)
                ->setSubject("Comfirmation envoi mail")
                ->setBody("Bonjours nous vous confirmons l'envoie de votre mail");

        $this->get('mailer')->send($messageConfirm);
    }

}
