<?php

namespace KrakDevs\WebBundle\Controller;

use KrakDevs\WebBundle\Doctrine\Repository\Event as EventRepository;
use KrakDevs\WebBundle\Entity\Event as EventEntity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EventController
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @ParamConverter("event", options={"mapping": {"slug": "slug"}})
     * @Template("KrakDevsWebBundle:Event:display.html.twig")
     */
    public function displayAction(EventEntity $event)
    {
        return array(
            'event' => $event
        );
    }
}
