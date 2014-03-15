<?php

namespace KrakDevs\WebBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomepageController
{
    /**
     * @Route("/")
     * @Template("KrakDevsWebBundle:Homepage:homepage.html.twig")
     */
    public function displayAction()
    {
        return array();
    }
}
