<?php

namespace App\Entity;

use App\Repository\DriverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DriverRepository::class)]
class Driver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $yearsdriving = null;

    #[ORM\Column]
    private ?bool $drivemanual = null;

    /**
     * @var Collection<int, Car>
     */
    #[ORM\OneToMany(targetEntity: Car::class, mappedBy: 'driverid')]
    private Collection $carid;

    public function __construct()
    {
        $this->carid = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYearsdriving(): ?int
    {
        return $this->yearsdriving;
    }

    public function setYearsdriving(int $yearsdriving): static
    {
        $this->yearsdriving = $yearsdriving;

        return $this;
    }

    public function isDrivemanual(): ?bool
    {
        return $this->drivemanual;
    }

    public function setDrivemanual(bool $drivemanual): static
    {
        $this->drivemanual = $drivemanual;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCarid(): Collection
    {
        return $this->carid;
    }

    public function addCarid(Car $carid): static
    {
        if (!$this->carid->contains($carid)) {
            $this->carid->add($carid);
            $carid->setDriverid($this);
        }

        return $this;
    }

    public function removeCarid(Car $carid): static
    {
        if ($this->carid->removeElement($carid)) {
            // set the owning side to null (unless already changed)
            if ($carid->getDriverid() === $this) {
                $carid->setDriverid(null);
            }
        }

        return $this;
    }
}
