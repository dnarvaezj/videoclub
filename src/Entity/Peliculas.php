<?php

namespace App\Entity;

use App\Repository\PeliculasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeliculasRepository::class)]
class Peliculas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 500)]
    private ?string $sinopsis = null;

    #[ORM\Column]
    private ?int $precio = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tipo = null;

    #[ORM\Column(length: 100)]
    private ?string $genero = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaEstreno = null;

    #[ORM\ManyToMany(targetEntity: Alquileres::class, mappedBy: 'peliculas')]
    private Collection $alquileres;

    public function __construct()
    {
        $this->alquileres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getSinopsis(): ?string
    {
        return $this->sinopsis;
    }

    public function setSinopsis(string $sinopsis): self
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getFechaEstreno(): ?\DateTimeInterface
    {
        return $this->fechaEstreno;
    }

    public function setFechaEstreno(\DateTimeInterface $fechaEstreno): self
    {
        $this->fechaEstreno = $fechaEstreno;

        return $this;
    }

    public function getNombreYPrecio(): ?string {

        return $this->nombre.' | $'.$this->precio.' | '.$this->tipo;
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
            $alquilere->addPelicula($this);
        }

        return $this;
    }

    public function removeAlquilere(Alquileres $alquilere): self
    {
        if ($this->alquileres->removeElement($alquilere)) {
            $alquilere->removePelicula($this);
        }

        return $this;
    }
}
