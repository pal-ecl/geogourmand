<?php
/**
 * Created by PhpStorm.
 * User: Wizpaul
 * Date: 02/05/2019
 * Time: 11:30
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Category
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
     * @Assert\Length(min="3")
     */
    private $label;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->label;
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
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return Tag
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}