<?php

namespace Wmd\WatchMyDeskBundle\Manager;

use Doctrine\ORM\EntityManager;
use Wmd\WatchMyDeskBundle\Manager\BaseManager;
use Wmd\WatchMyDeskBundle\Entity\Desk;

class DeskManager extends BaseManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
	public function getRepository()
    {
        return $this->em->getRepository('WmdWatchMyDeskBundle:Desk');
    }

    public function loadDesk($deskId) {
        return $this->getRepository()
				->findOneBy(array('id' => $deskId));
    }

    /**
    * Save Desk entity
    *
    * @param Desk $desk 
    */
    public function saveDesk(Desk $desk)
    {
        $this->persistAndFlush($desk);
    }

    public function getPreviousDesk($deskId) {
        return $this->getRepository()
                ->getAdjacentDesk($deskId, false)
                ->getQuery()
                ->setMaxResults(1)
                ->getOneOrNullResult();
    }

    public function getNextDesk($deskId) {
        return $this->getRepository()
                ->getAdjacentDesk($deskId, true)
                ->getQuery()
                ->setMaxResults(1)
                ->getOneOrNullResult();
    }

    public function isAuthorized(Desk $desk, $memberId)
    {
        return ($desk->getMember()->getId() == $memberId) ? true : false;
    }

    public function getPreviousAndNextDesk($desk)
    {
        return array(
            'prev' 	=> $this->getPreviousDesk($desk->getId()),
            'desk' 	=> $desk,
            'next' 	=> $this->getNextDesk($desk->getId()),
            'voted'	=> false
        );
    }
}