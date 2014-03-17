<?php

namespace KrakDevs\WebBundle\Controller;

use KrakDevs\WebBundle\Doctrine\Repository\Event;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomepageController
{
    /**
     * @var Event
     */
    private $eventRepository;

    /**
     * @param Event $eventRepository
     */
    public function __construct(Event $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @Template("KrakDevsWebBundle:Homepage:homepage.html.twig")
     */
    public function displayAction()
    {
        return array(
            'upcomingEvent' => $this->eventRepository->getUpcomingEvent(),
            'previousEvents' => $this->eventRepository->getPreviousEvents()
        );
    }

    /**
     * @Template("KrakDevsWebBundle:Homepage:event.html.twig")
     */
    public function eventAction($slug)
    {
        return array(
            'event' => $this->eventRepository->getEventBySlug($slug)
        );
    }
}
