<?php

namespace App\Entity;

use App\Repository\SocioRepository;
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

}