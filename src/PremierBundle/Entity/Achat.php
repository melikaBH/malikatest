<?php

namespace PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Achat
 *
 * @ORM\Table(name="achat")
 * @ORM\Entity(repositoryClass="PremierBundle\Repository\AchatRepository")
 */
class Achat
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
     * @ORM\ManyToOne(targetEntity="PremierBundle\Entity\Identifiant")
     * @ORM\JoinColumn(name="id", nullable=false)
     * @Assert\Valid()
     */
    private $identifiant;


    /**
     * @ORM\ManyToMany(targetEntity="PremierBundle\Entity\SousProduit", cascade={"persist"})
     */
    private $sousproduits;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function __construct()
    {

        $this->sousproduits = new ArrayCollection();
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addCategory(SousProduit $sousProduit)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->sousproduits[] = $sousProduit;

        return $this;
    }

    public function removeCategory(SousProduit $sousProduit)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->sousproduits->removeElement($sousProduit);
    }
    public function getSousproduits()

    {

        return $this->sousproduits;

    }

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
    }

}
