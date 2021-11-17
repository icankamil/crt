<?php
// src/Product.php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $username): void
    {
        $this->id = $username;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $passwordHash): void
    {
        $this->name = $passwordHash;
    }
}
