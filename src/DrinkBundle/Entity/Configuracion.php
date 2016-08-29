<?php

namespace DrinkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as assert;

/**
 * Configuracion
 *
 * @ORM\Table(name="configuracion")
 * @ORM\Entity(repositoryClass="DrinkBundle\Repository\ConfiguracionRepository")
 */
class Configuracion
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
     * @var bool
     *
     * @ORM\Column(name="estaAbierto", type="boolean")
     */
    private $estaAbierto;


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
     * Set estaAbierto
     *
     * @param boolean $estaAbierto
     *
     * @return Configuracion
     */
    public function setEstaAbierto($estaAbierto)
    {
        $this->estaAbierto = $estaAbierto;

        return $this;
    }

    /**
     * Get estaAbierto
     *
     * @return bool
     */
    public function getEstaAbierto()
    {
        return $this->estaAbierto;
    }
}

