<?php

namespace Biopen\FournisseurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Biopen\FournisseurBundle\Repository\ProduitRepository")
 */
class Produit
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_formate", type="string", length=255, unique=true)
     */
    private $nomFormate;

     /**
     * @var string
     *
     * @ORM\Column(name="nom_short", type="string", length=255, unique=true)
     */
    private $nomShort;

    /**
     * @var string
     *
     * @ORM\Column(name="precisions", type="string", length=255, unique=false, nullable=true)
     */
    private $precision;

    /* Non-Entity attribute. If the product get some supplier on search area */
    private $isLocalyProvided;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->isLocalyProvided = false;
    }

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
     * @return Produit
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNomFormate($nom)
    {
        $this->nomFormate = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNomFormate()
    {
        return $this->nomFormate;
    }

    /**
     * Set precision
     *
     * @param string $precision
     *
     * @return Produit
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    /**
     * Get precision
     *
     * @return string
     */
    public function getPrecision()
    {
        return $this->precision;
    }

       /**
     *
     */
    public function setLocalProvided($bool)
    {
        $this->isLocalyProvided = $bool;

        return $this;
    }

    /**
     * 
     */
    public function isLocalyProvided()
    {
        return $this->isLocalyProvided;
    }

    /**
     * Set nomShort
     *
     * @param string $nomShort
     *
     * @return Produit
     */
    public function setNomShort($nomShort)
    {
        $this->nomShort = $nomShort;

        return $this;
    }

    /**
     * Get nomShort
     *
     * @return string
     */
    public function getNomShort()
    {
        return $this->nomShort;
    }
}