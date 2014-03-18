<?php

namespace KrakDevs\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Gallery as BaseGallery;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="gallery")
 */
class Gallery extends BaseGallery
{
    /**
     * @ORM\OneToMany(targetEntity="KrakDevs\WebBundle\Entity\Photo",
     *      mappedBy="gallery", cascade={"persist"}, orphanRemoval=true, indexBy="id")
     * @Assert\Count(min = "1")
     */
    protected $photos;
}