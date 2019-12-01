<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocalEventoRepository")
 */
class LocalEvento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome_local;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacidade;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evento", mappedBy="id_local_evento")
     */
    private $id_evento;

    public function __construct()
    {
        $this->id_evento = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeLocal(): ?string
    {
        return $this->nome_local;
    }

    public function setNomeLocal(string $nome_local): self
    {
        $this->nome_local = $nome_local;

        return $this;
    }

    public function getCapacidade(): ?int
    {
        return $this->capacidade;
    }

    public function setCapacidade(int $capacidade): self
    {
        $this->capacidade = $capacidade;

        return $this;
    }

    /**
     * @return Collection|Evento[]
     */
    public function getIdEvento(): Collection
    {
        return $this->id_evento;
    }

    public function addIdEvento(Evento $idEvento): self
    {
        if (!$this->id_evento->contains($idEvento)) {
            $this->id_evento[] = $idEvento;
            $idEvento->setIdLocalEvento($this);
        }

        return $this;
    }

    public function removeIdEvento(Evento $idEvento): self
    {
        if ($this->id_evento->contains($idEvento)) {
            $this->id_evento->removeElement($idEvento);
            // set the owning side to null (unless already changed)
            if ($idEvento->getIdLocalEvento() === $this) {
                $idEvento->setIdLocalEvento(null);
            }
        }

        return $this;
    }
}
