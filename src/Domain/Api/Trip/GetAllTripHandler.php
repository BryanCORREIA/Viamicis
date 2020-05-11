<?php

namespace App\Domain\Api\Trip;

use App\Repository\TripRepository;

class GetAllTripHandler
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

    public function handle(GetAllTripAction $action) {
        $trips = $this->repository->findBy(['enabled' => true], ['createdAt' => 'DESC']);
        $allTrips = [];

        foreach ($trips as $trip) {
            $allTrips[] = GetAllTripView::build($trip, $action->user);
        }

        return $allTrips;
    }
}
