<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */

class Producer
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull()
     * @Assert\Length(min="1")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     */
    private $openingHours;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=12)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=12)
     */
    private $longitude;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Producer
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
    public function getOpeningHours()
    {
        return $this->openingHours;
    }

    /**
     * @param mixed $openingHours
     */
    public function setOpeningHours($openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate(\DateTimeInterface$creation_date): void
    {
        $this->creation_date = $creation_date;
    }
}