<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: 'integer')]
    private ?int $anioPublicacion = null;

    #[ORM\Column(type: 'integer')]
    private ?int $paginas = null;

    #[ORM\ManyToOne(targetEntity: Editorial::class, inversedBy: 'libros')]
    private ?Editorial $editorial = null;

    #[ORM\ManyToMany(targetEntity: Autor::class, inversedBy: 'libros')]
    private Collection $autores;

    #[ORM\ManyToOne(targetEntity: Socio::class, inversedBy: 'libros')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Socio $socio;

    #[ORM\Column(type: 'string', unique: true)]
    private ?string $isbn;
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $precioCompra;

    public function __construct()
    {
        $this->autores = new ArrayCollection();
    }

    public function __toString(): string {
        return $this->titulo . ' (' . $this->anioPublicacion . ')';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAnioPublicacion(): ?int
    {
        return $this->anioPublicacion;
    }

    public function setAnioPublicacion(int $anioPublicacion): static
    {
        $this->anioPublicacion = $anioPublicacion;

        return $this;
    }

    public function getPaginas(): ?int
    {
        return $this->paginas;
    }

    public function setPaginas(int $paginas): static
    {
        $this->paginas = $paginas;

        return $this;
    }

    public function getEditorial(): ?Editorial
    {
        return $this->editorial;
    }

    public function setEditorial(?Editorial $editorial): static
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * @return Collection<int, Autor>
     */
    public function getAutores(): Collection
    {
        return $this->autores;
    }

    public function addAutor(Autor $autor): static
    {
        if (!$this->autores->contains($autor)) {
            $this->autores->add($autor);
        }

        return $this;
    }

    public function removeAutor(Autor $autor): static
    {
        $this->autores->removeElement($autor);

        return $this;
    }

    public function getSocio(): ?Socio
    {
        return $this->socio;
    }

    public function setSocio(?Socio $socio): Libro
    {
        $this->socio = $socio;
        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): Libro
    {
        $this->isbn = $isbn;
        return $this;
    }

    public function getPrecioCompra(): ?int
    {
        return $this->precioCompra;
    }

    public function setPrecioCompra(?int $precioCompra): Libro
    {
        $this->precioCompra = $precioCompra;
        return $this;
    }


}
