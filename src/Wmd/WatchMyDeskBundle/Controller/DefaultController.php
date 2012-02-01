<?php

namespace Wmd\WatchMyDeskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Wmd\WatchMyDeskBundle\Entity\Desk;

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
	 */
	public function testAction()
	{
	    $id = 1; // ID du bureau de test que l'on a enregistré précédemment
    
	    $desk = $this->getDoctrine()->getRepository('WmdWatchMyDeskBundle:Desk')->find($id);
	    echo "Le bureau récupéré porte l'ID: ".$desk->getId()." et le titre: ".$desk->getTitle();
	    
	    exit;
	}
}
