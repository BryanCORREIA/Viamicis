<?php

namespace App\Domain\Api\Trip;

use App\Entity\User;

class AddTripAction
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var User
     */
    public $creator;

    /**
     * @var int
     */
    public $nbTravelers;

    /**
     * @var array
     */
    public $budget;

    /**
     * @var string
     */
    public $date;

    /**
     * @var int
     */
    public $days;

    /**
     * @var array
     */
    public $flexibilities;

    /**
     * @var string
     */
    public $country;

    /**
     * @var string
     */
    public $city;

    /**
     * @var array
     */
    public $activities;

    /**
     * @var string
     */
    public $description;
}
