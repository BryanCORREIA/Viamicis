<?php

namespace App\Entity\Embedded;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Identity
{
    /**
     * @ORM\Column(type="date")
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $lastname;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $city;

    /**
     * @var @ORM\Column(type="string", length=10)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=180, nullable=true)
     */
    private $complement;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $country;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp): void
    {
        $this->cp = $cp;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getComplement()
    {
        return $this->complement;
    }

    /**
     * @param mixed $complement
     */
    public function setComplement($complement): void
    {
        $this->complement = $complement;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    public function getFullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param mixed $birth
     */
    public function setBirth($birth): void
    {
        $this->birth = $birth;
    }
}
