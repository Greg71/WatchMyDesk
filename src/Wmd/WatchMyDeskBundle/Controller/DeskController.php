<?php

namespace Wmd\WatchMyDeskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Wmd\WatchMyDeskBundle\Form\Type\DeskType;
use Wmd\WatchMyDeskBundle\Entity\Desk;

/**
 * @Route("/desk")
 */
class DeskController extends Controller
{
    /**
     * @Route("/show/{desk_id}", name="desk_show")
     * @Template()
     */
    public function showAction($desk_id)
    {
	    if (!$desk = $this->get('wmd.desk_manager')->loadDesk($desk_id))
	    {
	        throw new NotFoundHttpException($this->get('translator')->trans('This desk does not exist.'));
	    }
	    
	    return array('desk' => $desk);
    }
    
	/**
	 * @Route("/add", name="desk_add")
	 * @Template()
	 */
	public function addAction()
	{
	    $request = $this->get('request'); // On récupère l'objet request via le service container
	    $desk = new Desk(); // On créé notre objet Desk vierge
	    
	    $form = $this->get('form.factory')->create(new DeskType(), $desk); // On bind l'objet Desk à notre formulaire DeskType
	    
	    // Si on a posté le formulaire
	    if ('POST' == $request->getMethod()) 
	    {
	        $form->bindRequest($request); // On bind les données du form
	        
	        // Si le formulaire est valide
	        if ($form->isValid())
	        {   
	            $this->get('wmd.desk_manager')->saveDesk($desk); // On utilise notre Manager pour gérer la sauvegarde de l'objet
	            
	            // On envoi une 'flash' pour indiquer à l'utilisateur que le bureau est ajouté
	            $this->get('session')->setFlash('notice', 
	                $this->get('translator')->trans('Desk added')
	            );
	            
	            // On redirige vers la page de modification du bureau
	            return new RedirectResponse($this->generateUrl('desk_edit', array(
	                'deskId' => $desk->getId()
	            )));
	        }
	    }
	
	    return array(
	    	'form' => $form->createView(),
	    	'desk' => $desk
	    ); // On passe à Twig l'objet form et notre objet desk
	}
	
	/**
     * @Route("/edit/{deskId}", name="desk_edit")
     */
    public function editAction($deskId)
    {
        $request = $this->get('request');
        
        // On vérifie que l'ID du bureau existe
        if (!$desk = $this->get('wmd.desk_manager')->loadDesk($deskId))
        {
            throw new NotFoundHttpException(
                $this->get('translator')->trans('This desk does not exist.')
            );
        }
        
        // On bind le bureau récupéré depuis la BDD au formulaire pour modification
        $form = $this->get('form.factory')->create(new DeskType(), $desk);
        
        // Si l'utilisateur soumet le formulaire
        if ('POST' == $request->getMethod())
        {
            $form->bindRequest($request);
            if ($form->isValid()) {
                
                $this->get('wmd.desk_manager')->saveDesk($desk);
                
                $this->get('session')->setFlash('notice',
                    $this->get('translator')->trans('Desk updated.')
                );
                
                return new RedirectResponse($this->generateUrl('desk_edit', array(
                    'deskId' => $desk->getId()
                )));
            }
        }

        return $this->render('WmdWatchMyDeskBundle:Desk:add.html.twig',
        	array(
        		'form' => $form->createView(),
        		'desk' => $desk
        	)
        ); // On change le template par défaut et on réutilise celui de add qui est le même
    }
}