<?php

namespace App\Domain\User;

use App\Entity\User;

class UserAction
{
    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var string
     */
    public $username;

    /**
     * @var array
     */
    public $roles;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $city;

    /**
     * @var \DateTime
     */
    public $birth;

    /**
     * @var string
     */
    public $cp;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $color;

    /**
     * @var string
     */
    public $transition;

    /**
     * Construit le DTO
     *
     * @param User $_user
     * @return UserAction
     */
    public static function build(User $_user) {
        $user = new self();

        $user->firstname    = $_user->getIdentity()->getFirstname();
        $user->lastname     = $_user->getIdentity()->getLastname();
        $user->username     = $_user->getUsername();
        $user->roles        = $_user->getRoles();
        $user->address      = $_user->getIdentity()->getAddress();
        $user->city         = $_user->getIdentity()->getCity();
        $user->birth        = $_user->getIdentity()->getBirth();
        $user->cp           = $_user->getIdentity()->getCp();
        $user->phone        = $_user->getIdentity()->getPhone();
        $user->country      = $_user->getIdentity()->getCountry();
        $user->color        = $_user->getParameters()->getColor();
        $user->transition   = $_user->getParameters()->getTransition();

        return $user;
    }
}
