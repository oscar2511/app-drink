<?php

namespace DrinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Dispositivo
 *
 * @ORM\Table(name="dispositivo")
 * @ORM\Entity(repositoryClass="DrinkBundle\Repository\DispositivoRepository")
 */
class Dispositivo
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
     * @ORM\Column(name="uuid", type="string", length=255)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255)
     */
    private $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="esAdministrador", type="boolean")
     */
    private $esAdministrador;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreate", type="datetime", nullable=true)
     */
    private $fechaCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaUpdate", type="datetime", nullable=true)
     */
    private $fechaUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="estaBloqueado", type="boolean", nullable=true)
     */
    private $estaBloqueado;


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
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Dispositivo
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Dispositivo
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set esAdministrador
     *
     * @param boolean $esAdministrador
     *
     * @return Dispositivo
     */
    public function setEsAdministrador($esAdministrador)
    {
        $this->esAdministrador = $esAdministrador;

        return $this;
    }

    /**
     * Get esAdministrador
     *
     * @return bool
     */
    public function getEsAdministrador()
    {
        return $this->esAdministrador;
    }

    /**
     * Set fechaCreate
     *
     * @param \DateTime $fechaCreate
     *
     * @return Dispositivo
     */
    public function setFechaCreate($fechaCreate)
    {
        $this->fechaCreate = $fechaCreate;

        return $this;
    }

    /**
     * Get fechaCreate
     *
     * @return \DateTime
     */
    public function getFechaCreate()
    {
        return $this->fechaCreate;
    }

    /**
     * Set fechaUpdate
     *
     * @param \DateTime $fechaUpdate
     *
     * @return Dispositivo
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
     * Set estaBloqueado
     *
     * @param boolean $estaBloqueado
     *
     * @return Dispositivo
     */
    public function setEstaBloqueado($estaBloqueado)
    {
        $this->estaBloqueado = $estaBloqueado;

        return $this;
    }

    /**
     * Get estaBloqueado
     *
     * @return bool
     */
    public function getEstaBloqueado()
    {
        return $this->estaBloqueado;
    }

    public function __toString()
    {
        return $this->getUuid();
    }
}

