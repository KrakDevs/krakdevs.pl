<?php

namespace KrakDevs\WebBundle\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;

class Event extends EntityRepository
{
    public function createListQueryBuilder()
    {
        $qb = $this->createQueryBuilder('e');
        $qb->orderBy('e.date', 'DESC');

        return $qb;
    }

    public function getUpcomingEvent()
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.date > CURRENT_DATE()');
        $qb->orderBy('e.date', 'DESC');
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getPreviousEvents()
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where('e.date < CURRENT_DATE()');
        $qb->orderBy('e.date', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getEventBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }
}