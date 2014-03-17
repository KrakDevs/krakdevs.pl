<?php

namespace KrakDevs\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="KrakDevs\WebBundle\Doctrine\Repository\Event")
 * @ORM\Table(name="krakdevs_event")
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var string
     * @ORM\Column(name="location_url", type="string", length=2048)
     */
    protected $locationUrl;

    /**
     * @var string
     * @ORM\Column(name="location_name", type="string")
     */
    protected $locationName;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="event_master_id", referencedColumnName="id", nullable=true)
     */
    private $eventMaster;

    /**
     * @var string
     * @ORM\Column(name="slug", type="string")
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Gallery")
     * @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=true)
     */
    protected $gallery;

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $locationUrl
     */
    public function setLocationUrl($locationUrl)
    {
        $this->locationUrl = $locationUrl;
    }

    /**
     * @return string
     */
    public function getLocationUrl()
    {
        return $this->locationUrl;
    }

    /**
     * @param string $locationName
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;
    }

    /**
     * @return string
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param User $eventMaster
     */
    public function setEventMaster(User $eventMaster)
    {
        $this->eventMaster = $eventMaster;
    }

    /**
     * @return User
     */
    public function getEventMaster()
    {
        return $this->eventMaster;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Set gallery
     *
     * @param \KrakDevs\WebBundle\Entity\Gallery $gallery
     * @return Event
     */
    public function setGallery(\KrakDevs\WebBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \KrakDevs\WebBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
