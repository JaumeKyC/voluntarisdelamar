<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "USER")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name: 'USER_ID')]
    private ?int $id = null;

    #[ORM\Column(name: 'EMAIL', length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'NOMBRE', type: Types::STRING, length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(name: 'APELLIDOS', type: Types::STRING, length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(name: 'DNI', type: Types::STRING, length: 9, unique: true)]
    private ?string $dni = null;

    #[ORM\Column(name: 'FECHA_NACIMIENTO', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaNacimiento = null;

    #[ORM\Column(name: 'TELEFONO', type: Types::STRING, length: 9)]
    private ?string $telefono = null;

    #[ORM\Column(name: 'DIRECCION', type: Types::STRING, length: 255, nullable: true)] 
    private ?string $direccion = null;

    #[ORM\Column(name: 'POBLACION', type: Types::STRING, length: 255, nullable: true)]
    private ?string $poblacion = null;

    #[ORM\Column(name: 'COD_POSTAL', type: Types::STRING, length: 50, nullable: true)]
    private ?string $codPostal = null;

    #[ORM\Column(name: 'PROVINCIA', type: Types::STRING, length: 255, nullable: true)]
    private ?string $provincia = null;

    #[ORM\Column(name: 'FECHA_ALTA', type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaAlta = null;

    #[ORM\Column(name: 'CAMISETA', type: Types::STRING, length: 255, nullable: true)]
    private ?string $camiseta = null;

    #[ORM\Column(name: 'FICHA_SEPA', type: Types::BLOB, nullable: true)]
    private $fichaSepa = null;

    #[ORM\Column(name: 'VOLUN_LA_CAIXA', type: Types::STRING, length: 255, nullable: true)]
    private ?string $volunLaCaixa = null;

    #[ORM\Column(name: 'IBAN', type: Types::STRING, length: 40, nullable: true)]
    private ?string $iban = null;

    #[ORM\Column(name: 'TITULACIONES', type: Types::STRING, length: 500, nullable: true)]
    private ?string $titulaciones = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Actividades::class, mappedBy: 'userId')]
    private Collection $actividades;

    public function __construct()
    {
        $this->actividades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFechaNacimiento(): ?DateTime
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(DateTime $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getPoblacion(): ?string
    {
        return $this->poblacion;
    }

    public function setPoblacion(string $poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }
    
    public function getCodPostal(): ?string
    {
        return $this->codPostal;
    }

    public function setCodPostal(string $codPostal): self
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getFechaAlta(): ?DateTime
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(DateTime $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getCamiseta(): ?string
    {
        return $this->camiseta;
    }

    public function setCamiseta(string $camiseta): self
    {
        $this->camiseta = $camiseta;

        return $this;
    }

    public function getFichaSepa()
    {
        return $this->fichaSepa;
    }

    public function setFichaSepa($fichaSepa): self
    {
        $this->fichaSepa = $fichaSepa;

        return $this;
    }

    public function getVolunLaCaixa(): ?string
    {
        return $this->volunLaCaixa;
    }

    public function setVolunLaCaixa(string $volunLaCaixa): self
    {
        $this->volunLaCaixa = $volunLaCaixa;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    
    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of titulaciones
     */ 
    public function getTitulaciones()
    {
        return $this->titulaciones;
    }

    /**
     * Set the value of titulaciones
     *
     * @return  self
     */ 
    public function setTitulaciones($titulaciones)
    {
        $this->titulaciones = $titulaciones;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Actividades>
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividade(Actividades $actividades): self
    {
        if (!$this->actividades->contains($actividades)) {
            $this->actividades->add($actividades);
            $actividades->addUserId($this);
        }

        return $this;
    }

    public function removeActividade(Actividades $actividades): self
    {
        if ($this->actividades->removeElement($actividades)) {
            $actividades->removeUserId($this);
        }

        return $this;
    }
}
