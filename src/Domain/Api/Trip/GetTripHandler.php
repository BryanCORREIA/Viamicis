<?php

namespace App\Domain\Api\Trip;

use App\Repository\TripRepository;

class GetTripHandler
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

    public function handle($id, $userConnected) {
        $trip = $this->repository->findOneBy(['id' => $id]);

        if ($trip) {
            $trip = TripView::build($trip, $userConnected);
        }

        return $trip;
    }
}
