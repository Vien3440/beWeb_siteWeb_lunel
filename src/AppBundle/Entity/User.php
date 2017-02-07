<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="beweb_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
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
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="adressepostale", type="string", length=500, nullable=true)
     */
    private $adressepostale;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="Type", referencedColumnName="id")
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean")
     */
    private $newsletter;

    /**
     * @var bool
     *
     * @ORM\Column(name="candidat", type="boolean")
     */
    private $candidat;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Promos")
     * @ORM\JoinColumn(name="Promos", referencedColumnName="id")
     */
    private $fkidpromos;
    
    
    
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
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set adressepostale
     *
     * @param string $adressepostale
     *
     * @return User
     */
    public function setAdressepostale($adressepostale)
    {
        $this->adressepostale = $adressepostale;

        return $this;
    }

    /**
     * Get adressepostale
     *
     * @return string
     */
    public function getAdressepostale()
    {
        return $this->adressepostale;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * Set candidat
     *
     * @param boolean $candidat
     *
     * @return User
     */
    public function setCandidat($candidat)
    {
        $this->candidat = $candidat;

        return $this;
    }

    /**
     * Get candidat
     *
     * @return bool
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    
    /**
     * Set fkidpromos
     *
     * @param string $fkidpromos
     *
     * @return string
     */
    public function setFkidpromos($fkidpromos)
    {
        $this->fkidpromos = $fkidpromos;

        return $this;
    }

    /**
     * Get fkidpromos
     *
     * @return string
     */
    public function getFkidpromos()
    {
        return $this->fkidpromos;
    }

}
