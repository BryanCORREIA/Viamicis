<?php

namespace App\Domain\Api\Trip;

use App\Entity\Trip;
use App\Exception\AddTripException;
use App\Repository\TripRepository;

class AddTripHandler
{
    /**
     * @var TripRepository
     */
    private $repository;

    public function __construct(
        TripRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function handle(AddTripAction $action) {
        $trip = Trip::build($action);

            $this->repository->add($trip);
    }
}
