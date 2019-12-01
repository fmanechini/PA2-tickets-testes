<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 */
class Evento
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
    private $nome_evento;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $descricao;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $link_imagem;


    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\Column(type="float")
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\LocalEvento", inversedBy="id_evento")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_local_evento;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ingresso", mappedBy="id_evento")
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

    public function getNomeEvento(): ?string
    {
        return $this->nome_evento;
    }

    public function setNomeEvento(string $nome_evento): self
    {
        $this->nome_evento = $nome_evento;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getIdLocalEvento(): ?LocalEvento
    {
        return $this->id_local_evento;
    }

    public function setIdLocalEvento(?LocalEvento $id_local_evento): self
    {
        $this->id_local_evento = $id_local_evento;

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
            $idIngresso->setIdEvento($this);
        }

        return $this;
    }

    public function removeIdIngresso(Ingresso $idIngresso): self
    {
        if ($this->id_ingresso->contains($idIngresso)) {
            $this->id_ingresso->removeElement($idIngresso);
            // set the owning side to null (unless already changed)
            if ($idIngresso->getIdEvento() === $this) {
                $idIngresso->setIdEvento(null);
            }
        }

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getLinkImagem(): ?string
    {
        return $this->link_imagem;
    }

    public function setLinkImagem(string $link_imagem): self
    {
        $this->link_imagem = $link_imagem;

        return $this;
    }

}
