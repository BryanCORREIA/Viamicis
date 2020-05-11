<?php

namespace App\Domain\Api\Trip;

use App\Entity\User;

class GetAllTripAction
{
    /**
     * @var User
     */
    public $user;

    public static function build(User $user) {
        $action = new self();

        $action->user = $user;

        return $action;
    }
}
