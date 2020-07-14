<?php

namespace App\Domain\Api\Trip;

use App\Entity\Trip;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

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

    /**
     * @var string
     */
    public $creatorAge;

    /**
     * @var string
     */
    public $creatorLoc;

    /**
     * @var string
     */
    public $creatorPhone;

    /**
     * @var array
     */
    public $wishes;

    /**
     * @var array
     */
    public $participants;

    public static function build(Trip $trip, User $userConnected)
    {
        $birth = $trip->getCreator()->getIdentity()->getBirth();
        $diff = $birth->diff(new \DateTime('now'));

        $view = new self();

        $view->id               = $trip->getId();
        $view->createdAt        = $trip->getCreatedAt()->format('j / m / Y');
        $view->title            = $trip->getTitle();
        $view->isCreator        = ($userConnected == $trip->getCreator());
        $view->creator          = $trip->getCreator()->getIdentity()->getFullName();
        $view->creatorPic       = $trip->getCreator()->getIdentity()->getPicture();
        $view->creatorAge       = $diff->format('%y');
        $view->creatorPhone     = $trip->getCreator()->getIdentity()->getPhone();
        $view->creatorLoc       = $trip->getCreator()->getIdentity()->getCity() . ", " . $trip->getCreator()->getIdentity()->getCountry();
        $view->registrant       = 0;
        $view->date             = $trip->getBeginAt()->format('j / m / Y');
        $view->days             = $trip->getDays();
        $view->travelers        = $trip->getTravelers();
        $view->country          = $trip->getCountry();
        $view->description      = $trip->getDescription();
        $view->wishes           = [];
        $view->participants[]   = [
            'userId' => $trip->getCreator()->getId(),
            'userPic' => $trip->getCreator()->getIdentity()->getPicture(),
            'userFull' => $trip->getCreator()->getIdentity()->getFullName()
        ];

        foreach ($trip->getWishes() as $wish) {
            if (-1 == $wish->getAccepted()) {
                $view->wishes[] = [
                    'userId' => $wish->getUser()->getId(),
                    'userPic' => $wish->getUser()->getIdentity()->getPicture(),
                    'userFull' => $wish->getUser()->getIdentity()->getFullName()
                ];
            } elseif (1 == $wish->getAccepted()) {
                $view->participants[] = [
                    'userId' => $wish->getUser()->getId(),
                    'userPic' => $wish->getUser()->getIdentity()->getPicture(),
                    'userFull' => $wish->getUser()->getIdentity()->getFullName()
                ];
                dump($view->participants);
            }
        }

        return $view;
    }

}
