<?php

namespace App\Entity;

use App\Domain\Api\Trip\AddTripAction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 */
class Trip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="date")
     */
    private $beginAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $days;

    /**
     * @ORM\Column(type="integer")
     */
    private $travelers;

    /**
     * @ORM\Column(type="integer")
     */
    private $budgetMin;

    /**
     * @ORM\Column(type="integer")
     */
    private $budgetMax;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Wish", mappedBy="trip")
     */
    private $wishes;

    public function __construct()
    {
        $this->createdAt    = new \DateTime();
        $this->enabled      = true;
        $this->wishes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator): void
    {
        $this->creator = $creator;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->beginAt;
    }

    public function setBeginAt(\DateTimeInterface $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): self
    {
        $this->days = $days;

        return $this;
    }

    public function getTravelers(): ?int
    {
        return $this->travelers;
    }

    public function setTravelers(int $travelers): self
    {
        $this->travelers = $travelers;

        return $this;
    }

    public function getBudgetMin(): ?int
    {
        return $this->budgetMin;
    }

    public function setBudgetMin(int $budgetMin): self
    {
        $this->budgetMin = $budgetMin;

        return $this;
    }

    public function getBudgetMax(): ?int
    {
        return $this->budgetMax;
    }

    public function setBudgetMax(int $budgetMax): self
    {
        $this->budgetMax = $budgetMax;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Méthode de build depuis l'action AddTripAction
     *
     * @param AddTripAction $action
     * @return Trip
     */
    public static function build(AddTripAction $action) {
        $trip = new self();

        $trip->title        = $action->title;
        $trip->description  = $action->description;
        $trip->beginAt      = \DateTime::createFromFormat('d / m / Y', $action->date);
        $trip->days         = $action->days;
        $trip->travelers    = $action->nbTravelers;
        $trip->budgetMin    = $action->budget[0];
        $trip->budgetMax    = $action->budget[1];
        $trip->country      = $action->country;
        $trip->city         = $action->city;
        $trip->creator      = $action->creator;

        return $trip;
    }

    /**
     * @return Collection|Wish[]
     */
    public function getWishes(): Collection
    {
        return $this->wishes;
    }

    public function addWish(Wish $wish): self
    {
        if (!$this->wishes->contains($wish)) {
            $this->wishes[] = $wish;
            $wish->setTrip($this);
        }

        return $this;
    }

    public function removeWish(Wish $wish): self
    {
        if ($this->wishes->contains($wish)) {
            $this->wishes->removeElement($wish);
            // set the owning side to null (unless already changed)
            if ($wish->getTrip() === $this) {
                $wish->setTrip(null);
            }
        }

        return $this;
    }
}
