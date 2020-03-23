<?php

namespace App\Entity\Embedded;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Parameters
{
    /**
     * @ORM\Column(type="string", length=7, options={"default" : "#C6452A"})
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=7, options={"default" : "fade"})
     */
    private $transition;

    public function __construct()
    {
        $this->color   = "#C6452A";
        $this->transition = "fade";
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getTransition(): string
    {
        return $this->transition;
    }

    /**
     * @param string $transition
     */
    public function setTransition(string $transition): void
    {
        $this->transition = $transition;
    }
}
