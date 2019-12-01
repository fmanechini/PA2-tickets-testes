<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngressoRepository")
 */
class Ingresso
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="id_ingresso")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_cliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evento", inversedBy="id_ingresso")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_evento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getIdCliente(): ?Cliente
    {
        return $this->id_cliente;
    }

    public function setIdCliente(?Cliente $id_cliente): self
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    public function getIdEvento(): ?Evento
    {
        return $this->id_evento;
    }

    public function setIdEvento(?Evento $id_evento): self
    {
        $this->id_evento = $id_evento;

        return $this;
    }
}
