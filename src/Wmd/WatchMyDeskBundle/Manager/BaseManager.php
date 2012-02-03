<?php

namespace Wmd\WatchMyDeskBundle\Manager;

use Doctrine\ORM\EntityManager;

abstract class BaseManager
{
	protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
	
    protected function persistAndFlush($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }
}