<?php

namespace App\Entity\Embedded;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Parameters
{
    /**
     * @ORM\Column(type="string", length=7, options={"default" : "#941751"})
     */
    private $color = "#45B5B2";

    /**
     * @ORM\Column(type="string", length=100, options={"default" : "fade"})
     */
    private $transition = "fade";

    public function __construct()
    {
        $this->color   = "#941751";
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
