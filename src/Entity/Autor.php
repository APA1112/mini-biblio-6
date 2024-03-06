<?php

namespace App\Entity;

use App\Repository\AutorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: AutorRepository::class)]
class Autor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    #[Assert\Regex(pattern: '^[^\d]+$')]
    private ?string $nombre = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2)]
    #[Assert\Regex(pattern: '^[^\d]+\s[^\d]+$')]
    private ?string $apellidos = null;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Assert\LessThan('today')]
    private ?\DateTimeInterface $fechaNacimiento = null;

    #[ORM\ManyToMany(targetEntity: Libro::class, mappedBy: 'autores')]
    private Collection $libros;

    public function __construct()
    {
        $this->libros = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getNombre() . ' ' . $this->getApellidos();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): static
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * @return Collection<int, Libro>
     */
    public function getLibros(): Collection
    {
        return $this->libros;
    }

    public function addLibro(Libro $libro): static
    {
        if (!$this->libros->contains($libro)) {
            $this->libros->add($libro);
            $libro->addAutor($this);
        }

        return $this;
    }

    public function removeLibro(Libro $libro): static
    {
        if ($this->libros->removeElement($libro)) {
            $libro->removeAutor($this);
        }

        return $this;
    }
}
