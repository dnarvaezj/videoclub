<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $fullName = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Alquileres::class)]
    private Collection $alquileres;

    public function __construct()
    {
        $this->alquileres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Alquileres>
     */
    public function getAlquileres(): Collection
    {
        return $this->alquileres;
    }

    public function addAlquilere(Alquileres $alquilere): self
    {
        if (!$this->alquileres->contains($alquilere)) {
            $this->alquileres->add($alquilere);
            $alquilere->setUser($this);
        }

        return $this;
    }

    public function removeAlquilere(Alquileres $alquilere): self
    {
        if ($this->alquileres->removeElement($alquilere)) {
            // set the owning side to null (unless already changed)
            if ($alquilere->getUser() === $this) {
                $alquilere->setUser(null);
            }
        }

        return $this;
    }
}
