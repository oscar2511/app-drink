<?php

namespace DrinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Producto
 *
 * @ORM\Table(name="producto")
 * @ORM\Entity(repositoryClass="DrinkBundle\Repository\ProductoRepository")
 */
class Producto
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
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @assert\NotBlank()
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="stock", type="string", length=255)
     */
    private $stock;

    /**
     * @var string
     *
     * @ORM\Column(name="urlImagen", type="string", length=255)
     */
    private $urlImagen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaUpdate", type="datetime")
     */
    private $fechaUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


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
     * Set ctegoria
     *
     * @param integer $categoria
     *
     * @return Producto
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return int
     */
    public function getcategoria()
    {
        return $this->categoria;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set stock
     *
     * @param string $stock
     *
     * @return Producto
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set urlImagen
     *
     * @param string $urlImagen
     *
     * @return Producto
     */
    public function setUrlImagen($urlImagen)
    {
        $this->urlImagen = $urlImagen;

        return $this;
    }

    /**
     * Get urlImagen
     *
     * @return string
     */
    public function getUrlImagen()
    {
        return $this->urlImagen;
    }

    /**
     * Set fechaUpdate
     *
     * @param \DateTime $fechaUpdate
     *
     * @return Producto
     */
    public function setFechaUpdate($fechaUpdate)
    {
        $this->fechaUpdate = $fechaUpdate;

        return $this;
    }

    /**
     * Get fechaUpdate
     *
     * @return \DateTime
     */
    public function getFechaUpdate()
    {
        return $this->fechaUpdate;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Producto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return bool
     */
    public function getEstado()
    {
        return $this->estado;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}

