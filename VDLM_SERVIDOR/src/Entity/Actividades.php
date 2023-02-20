<?php

namespace App\Entity;

use App\Repository\ActividadesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActividadesRepository::class)]
#[ORM\Table(name: "ACTIVIDADES")]
class Actividades
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(name: 'ES_FORMACION', type: Types::BOOLEAN)]
    private ?bool $esFormacion = null;

    #[ORM\Column(name: 'NOMBRE', type: Types::STRING, length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(name: 'FECHA_INICIO', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(name: 'HORA_INICIO', type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $horaInicio = null;

    #[ORM\Column(name: 'UBICACION', type: Types::STRING, length: 255)]
    private ?string $ubicacion = null;

    #[ORM\Column(name: 'ENTIDAD_ORGANIZADORA', type: Types::STRING, length: 255)]
    private ?string $entidadOrganizadora = null;

    #[ORM\Column(name: 'NUM_EMBARCACIONES', type: Types::INTEGER)]
    private ?int $numEmbarcaciones = null;

    #[ORM\Column(name: 'NUM_MOTOS', type: Types::INTEGER)]
    private ?int $numMotos = null;

    #[ORM\Column(name: 'NUM_PATRONES', type: Types::INTEGER)]
    private ?int $numPatrones = null;

    #[ORM\Column(name: 'NUM_TRIPULANTES', type: Types::INTEGER)]
    private ?int $numTripulantes = null;

    #[ORM\Column(name: 'NUM_SOCORRISTAS', type: Types::INTEGER)]
    private ?int $numSocorristas = null;

    #[ORM\Column(name: 'OBSERVACIONES', type: Types::STRING, length: 500, nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(name: 'VOLUNTARIOS', type: Types::INTEGER)]
    private ?int $voluntarios = null;

    #[ORM\Column(name: 'MAX_VOLUNTARIOS', type: Types::INTEGER)]
    private ?int $maxVoluntarios = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'actividades')]
    private Collection $userId;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEsFormacion(): ?bool
    {
        return $this->esFormacion;
    }

    public function setEsFormacion(bool $esFormacion): self
    {
        $this->esFormacion = $esFormacion;

        return $this;
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getEntidadOrganizadora(): ?string
    {
        return $this->entidadOrganizadora;
    }

    public function setEntidadOrganizadora(string $entidadOrganizadora): self
    {
        $this->entidadOrganizadora = $entidadOrganizadora;

        return $this;
    }

    public function getNumEmbarcaciones(): ?int
    {
        return $this->numEmbarcaciones;
    }

    public function setNumEmbarcaciones(int $numEmbarcaciones): self
    {
        $this->numEmbarcaciones = $numEmbarcaciones;

        return $this;
    }

    public function getNumMotos(): ?int
    {
        return $this->numMotos;
    }

    public function setNumMotos(int $numMotos): self
    {
        $this->numMotos = $numMotos;

        return $this;
    }

    public function getNumPatrones(): ?int
    {
        return $this->numPatrones;
    }

    public function setNumPatrones(int $numPatrones): self
    {
        $this->numPatrones = $numPatrones;

        return $this;
    }

    public function getNumTripulantes(): ?int
    {
        return $this->numTripulantes;
    }

    public function setNumTripulantes(int $numTripulantes): self
    {
        $this->numTripulantes = $numTripulantes;

        return $this;
    }

    public function getNumSocorristas(): ?int
    {
        return $this->numSocorristas;
    }

    public function setNumSocorristas(int $numSocorristas): self
    {
        $this->numSocorristas = $numSocorristas;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    public function getVoluntarios(): ?int
    {
        return $this->voluntarios;
    }

    public function setVoluntarios(int $voluntarios): self
    {
        $this->voluntarios = $voluntarios;

        return $this;
    }

    public function getMaxVoluntarios(): ?int
    {
        return $this->maxVoluntarios;
    }

    public function setMaxVoluntarios(int $maxVoluntarios): self
    {
        $this->maxVoluntarios = $maxVoluntarios;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(User $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId->add($userId);
        }

        return $this;
    }

    public function removeUserId(User $userId): self
    {
        $this->userId->removeElement($userId);

        return $this;
    }

}

