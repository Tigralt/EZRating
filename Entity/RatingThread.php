<?php

namespace Tigralt\EZRatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RatingThread
 *
 * @ORM\Table(name="rating_thread")
 * @ORM\Entity(repositoryClass="Tigralt\EZRatingBundle\Repository\RatingThreadRepository")
 */
class RatingThread
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="thread")
     */
    private $ratings;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return RatingThread
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add rating
     *
     * @param Rating $rating
     *
     * @return RatingThread
     */
    public function addRating($rating)
    {
        $this->ratings->add($rating);

        return $this;
    }

    /**
     * Remove rating
     *
     * @param Rating $rating
     *
     * @return RatingThread
     */
    public function removeRating($rating)
    {
        $this->ratings->removeElement($rating);

        return $this;
    }

    /**
     * Get ratings
     *
     * @return ArrayCollection
     */
    public function getRatings()
    {
        return $this->ratings;
    }
}
