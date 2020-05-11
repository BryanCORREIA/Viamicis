<?php

namespace App\Domain\Api\Trip;

use App\Entity\Trip;
use App\Entity\User;

class TripView
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @var string
     */
    public $title;

    /**
     * @var boolean
     */
    public $isCreator;

    /**
     * @var string
     */
    public $creator;

    /**
     * @var string
     */
    public $creatorPic;

    /**
     * @var array
     */
    public $registrant;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $days;

    /**
     * @var int
     */
    public $travelers;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $description;

    public static function build(Trip $trip, User $userConnected)
    {
        $view = new self();

        $view->id           = $trip->getId();
        $view->createdAt    = $trip->getCreatedAt()->format('j / m / Y');
        $view->title        = $trip->getTitle();
        $view->isCreator    = ($userConnected == $trip->getCreator());
        $view->creator      = $trip->getCreator()->getIdentity()->getFullName();
        $view->creatorPic   = $trip->getCreator()->getIdentity()->getPicture();
        $view->registrant   = 0;
        $view->date         = $trip->getBeginAt()->format('j / m / Y');
        $view->days         = $trip->getDays();
        $view->travelers    = $trip->getTravelers();
        $view->country      = $trip->getCountry();
        $view->description   = $trip->getDescription();

        return $view;
    }

}
