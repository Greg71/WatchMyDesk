<?php

namespace Wmd\WatchMyDeskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Wmd\WatchMyDeskBundle\Entity\Desk;
use Wmd\WatchMyDeskBundle\Entity\DeskComment;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
	/**
	 * @Route("/test/", name="test")
	 * @Template()
	 */
	public function testAction()
	{		
//		$desk = new Desk();
//		$desk->setTitle("Test desk");
//		$desk->setSummary("Test desk");
//		$desk->setDescription("Test desk");
//		$desk->setIsEnabled(true);
//		
//		$em = $this->getDoctrine()->getEntityManager();
//		$em->persist($desk);
//		$em->flush();
//		
//		$id = 1; // ID du bureau de test que l'on a enregistré précédemment
//		 
//		$desk = $this->getDoctrine()->getRepository('WmdWatchMyDeskBundle:Desk')->find($id);
//		echo "Le bureau récupéré porte l'ID: ".$desk->getId()." et le titre: ".$desk->getTitle();
//		 
//		$comment = new DeskComment();
//		$comment->setDescription("Mon premier commentaire: Joli bureau !");
//		$comment->setSubmissionIp($this->getRequest()->server->get('REMOTE_ADDR'));
//		$comment->setDesk($desk); // On lie le commentaire à notre bureau d'ID 1
//		 
//		$em->persist($comment); // On persist le commentaire 1
//		 
//		$comment2 = new DeskComment();
//		$comment2->setDescription("Mon deuxième commentaire: J'adore le bureau ! Bravo !");
//		$comment2->setSubmissionIp($this->getRequest()->server->get('REMOTE_ADDR'));
//		$comment2->setDesk($desk); // On lie le commentaire à notre bureau d'ID 1
//		 
//		$em->persist($comment2); // On persist le commentaire 2
//		 
//		$em->flush(); // On sauvegarde en BDD les deux commentaires
//
//		exit;

		$id = 1; // ID du bureau de test que l'on a enregistré précédemment
 
		$desk = $this->getDoctrine()->getRepository('WmdWatchMyDeskBundle:Desk')->find($id);
 
		return array('desk' => $desk);
	}
}
