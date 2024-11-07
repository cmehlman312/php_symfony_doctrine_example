<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 255)]
    private ?string $make = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $model = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $transmission = null;

    #[ORM\ManyToOne(inversedBy: 'carid')]
    private ?Driver $driverid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDriverid(): ?Driver
    {
        return $this->driverid;
    }

    public function setDriverid(?Driver $driverid): static
    {
        $this->driverid = $driverid;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }
}
