<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WishRepository")
 */
class Wish
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="wishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trip", inversedBy="wishes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trip;

    /**
     * @ORM\Column(type="datetime")
     */
    private $askedAt;

    /**
     * @ORM\Column(type="smallint")
     */
    private $accepted;

    public function __construct()
    {
        $this->askedAt = new \DateTime();
        $this->accepted = -1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTrip(): ?Trip
    {
        return $this->trip;
    }

    public function setTrip(?Trip $trip): self
    {
        $this->trip = $trip;

        return $this;
    }

    public function getAskedAt(): ?\DateTimeInterface
    {
        return $this->askedAt;
    }

    public function setAskedAt(\DateTimeInterface $askedAt): self
    {
        $this->askedAt = $askedAt;

        return $this;
    }

    public function getAccepted(): ?int
    {
        return $this->accepted;
    }

    public function setAccepted($accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }
}
