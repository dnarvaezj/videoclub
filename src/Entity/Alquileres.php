<?php

namespace App\Entity;

use App\Repository\AlquileresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlquileresRepository::class)]
class Alquileres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $valorTotal = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaFin = null;

    #[ORM\Column]
    private ?int $diasAlquiler = null;

    #[ORM\ManyToMany(targetEntity: Peliculas::class, inversedBy: 'alquileres')]
    private Collection $peliculas;

    #[ORM\ManyToOne(inversedBy: 'alquileres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user;

    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValorTotal(): ?int
    {
        return $this->valorTotal;
    }

    public function setValorTotal(int $valorTotal): self
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getDiasAlquiler(): ?int
    {
        return $this->diasAlquiler;
    }

    public function setDiasAlquiler(int $diasAlquiler): self
    {
        $this->diasAlquiler = $diasAlquiler;

        return $this;
    }

    /**
     * @return Collection<int, Peliculas>
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Peliculas $pelicula): self
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas->add($pelicula);
        }

        return $this;
    }

    public function removePelicula(Peliculas $pelicula): self
    {
        $this->peliculas->removeElement($pelicula);

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
