<?php

namespace Tigralt\EZRatingBundle\Services;

use Tigralt\EZRatingBundle\Entity\Rating;
use Tigralt\EZRatingBundle\Entity\RatingThread;
use Doctrine\ORM\EntityManager;

class RatingManager
{
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addRatingThread($name)
    {
        $thread = new RatingThread();
        $thread->setName($name);

        $this->em->persist($thread);
        $this->em->flush();
    }

    public function addRating($thread_id, $user_id, $rating_number, $comment, $meta = array())
    {
        $thread = $this->em->getRepository("EZRatingBundle:RatingThread")->find($thread_id);

        if(!$thread)
            throw new \Exception('Rating thread not found!');

        $rating = new Rating();
        $rating->setThread($thread);
        $rating->setUserId($user_id);
        $rating->setRating($rating_number);
        $rating->setComment($comment);
        $rating->setMeta($meta);

        $this->em->persist($rating);
        $this->em->flush();
    }

    public function getAllRatingThreads()
    {
        return $this->em->getRepository("EZRatingBundle:RatingThread")->findAll();
    }

    public function getAllFromUser($user_id)
    {
        $all = array();
        $threads = $this->getAllRatingThreads();

        foreach($threads as $thread) {
            $ratings = $this->em->getRepository("EZRatingBundle:Rating")->findBy(
                array("thread" => $thread, "userId" => $user_id)
            );

            $max = count($ratings);
            $mean = 0;

            if($max <= 0)
                continue;

            foreach($ratings as $rating)
                $mean += $rating->getRating() / $max;

            $all[] = array(
                "name" => $thread->getName(),
                "mean" => $mean,
                "ratings" => $ratings,
            );
        }

        return $all;
    }
}
