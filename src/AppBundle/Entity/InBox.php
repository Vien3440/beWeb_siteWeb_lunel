<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InBox
 *
 * @ORM\Table(name="beweb_in_box")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InBoxRepository")
 */
class InBox
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="User", referencedColumnName="id")
     */
    private $fkiduser;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=500)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Statut")
     * @ORM\JoinColumn(name="Statut", referencedColumnName="id")
     */
    private $fkidstatut;


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
     * Set fkiduser
     *
     * @param string $fkiduser
     *
     * @return InBox
     */
    public function setFkiduser($fkiduser)
    {
        $this->fkiduser = $fkiduser;

        return $this;
    }

    /**
     * Get fkiduser
     *
     * @return string
     */
    public function getFkiduser()
    {
        return $this->fkiduser;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return InBox
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return InBox
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set fkidstatut
     *
     * @param string $fkidstatut
     *
     * @return InBox
     */
    public function setFkidstatut($fkidstatut)
    {
        $this->fkidstatut = $fkidstatut;

        return $this;
    }

    /**
     * Get fkidstatut
     *
     * @return string
     */
    public function getFkidstatut()
    {
        return $this->fkidstatut;
    }
}
