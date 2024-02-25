<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
#[ORM\Table(name: 'socio')]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'string', unique: true)]
    private ?string $dni;
    #[ORM\Column(type: 'string')]
    private ?string $apellidos;
    #[ORM\Column(type: 'string')]
    private ?string $nombre;
    #[ORM\Column(type: 'boolean')]
    private ?bool $esDocente;
    #[ORM\Column(type: 'boolean')]
    private ?bool $esEstudiante;
    #[ORM\OneToMany(targetEntity: Libro::class, mappedBy: 'socio')]
    private Collection $libros;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): Socio
    {
        $this->dni = $dni;
        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): Socio
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): Socio
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getEsDocente(): ?bool
    {
        return $this->esDocente;
    }

    public function setEsDocente(?bool $esDocente): Socio
    {
        $this->esDocente = $esDocente;
        return $this;
    }

    public function getEsEstudiante(): ?bool
    {
        return $this->esEstudiante;
    }

    public function setEsEstudiante(?bool $esEstudiante): Socio
    {
        $this->esEstudiante = $esEstudiante;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }

    public function addLibro(Libro $libro): static
    {
        if (!$this->libros->contains($libro)){
            $this->libros->add($libro);
        }
        return $this;
    }

    public function removeLibro(Libro $libro): static{
        $this->libros->removeElement($libro);
        return $this;
    }
}