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
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @assert\NotBlank()
     */
    private $pedido;

    /**
     * @ORM\ManyToOne(targetEntity="Producto")
     * @assert\NotBlank()
     */
    private $producto;

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
     * Set pedido
     *
     * @param integer $pedido
     *
     * @return DetallePedido
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }

    /**
     * Get pedido
     *
     * @return int
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set producto
     *
     * @param integer $producto
     *
     * @return DetallePedido
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return int
     */
    public function getProducto()
    {
        return $this->producto;
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

