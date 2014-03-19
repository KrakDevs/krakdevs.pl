<?php

namespace KrakDevs\WebBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="eventMaster")
     */
    protected $hostedEvents;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $githubId;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $githubAccessToken;

    public function __construct()
    {
        parent::__construct();
        $this->hostedEvents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s (%s)", $this->username, $this->email);
    }

    /**
     * @param string $githubId
     */
    public function setGithubId($githubId)
    {
        $this->githubId = $githubId;
    }

    /**
     * @return string
     */
    public function getGithubId()
    {
        return $this->githubId;
    }

    /**
     * @param mixed $githubAccessToken
     */
    public function setGithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;
    }

    /**
     * @return mixed
     */
    public function getGithubAccessToken()
    {
        return $this->githubAccessToken;
    }
}