<?php

namespace DrinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="DrinkBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

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
     * @var \boolean
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Categoria
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
     * Set urlImagen
     *
     * @param string $urlImagen
     *
     * @return Categoria
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
     * @return Categoria
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
     * @return boolean
     */
    public function isEstado()
    {
        return $this->estado;
    }

    /**
     * @param boolean $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }



    public function __toString()
    {
        return $this->getNombre();
    }
}

