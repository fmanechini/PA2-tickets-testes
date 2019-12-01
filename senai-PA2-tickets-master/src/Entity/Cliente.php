<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome_cliente;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    /**
     * @ORM\Column(type="string", length=150)
     */
    private $email;


    /**
     * @ORM\Column(type="string", length=30)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $telefone;

    /**
     * @ORM\Column(type="string")
     */
    private $senha;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ingresso", mappedBy="id_cliente")
     */
    private $id_ingresso;

    public function __construct()
    {
        $this->id_ingresso = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNomeCliente(): ?string
    {
        return $this->nome_cliente;
    }

    public function setNomeCliente(string $nome_cliente): self
    {
        $this->nome_cliente = $nome_cliente;

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

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * @return Collection|Ingresso[]
     */
    public function getIdIngresso(): Collection
    {
        return $this->id_ingresso;
    }

    public function addIdIngresso(Ingresso $idIngresso): self
    {
        if (!$this->id_ingresso->contains($idIngresso)) {
            $this->id_ingresso[] = $idIngresso;
            $idIngresso->setIdCliente($this);
        }

        return $this;
    }

    public function removeIdIngresso(Ingresso $idIngresso): self
    {
        if ($this->id_ingresso->contains($idIngresso)) {
            $this->id_ingresso->removeElement($idIngresso);
            // set the owning side to null (unless already changed)
            if ($idIngresso->getIdCliente() === $this) {
                $idIngresso->setIdCliente(null);
            }
        }

        return $this;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->senha;
    }

    public function setPassword(string $password): self
    {
        $this->senha = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
