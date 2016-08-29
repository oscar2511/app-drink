<?php

namespace DrinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * DetallePedido
 *
 * @ORM\Table(name="detalle_pedido")
 * @ORM\Entity(repositoryClass="DrinkBundle\Repository\DetallePedidoRepository")
 */
class DetallePedido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Pedido")
     * @assert\NotBlank()
     */
    private $idPedido;

    /**
     * @ORM\ManyToMany(targetEntity="Producto")
     * @assert\NotBlank()
     */
    private $idProducto;

    /**
     * @var int
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="subTotal", type="float")
     */
    private $subTotal;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPedido
     *
     * @param integer $idPedido
     *
     * @return DetallePedido
     */
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get idPedido
     *
     * @return int
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set idProducto
     *
     * @param integer $idProducto
     *
     * @return DetallePedido
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return int
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return DetallePedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return int
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set subTotal
     *
     * @param float $subTotal
     *
     * @return DetallePedido
     */
    public function setSubTotal($subTotal)
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * Get subTotal
     *
     * @return float
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }
}

