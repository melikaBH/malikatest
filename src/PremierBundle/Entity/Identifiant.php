<?php

namespace PremierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Identifiant
 *
 * @ORM\Table(name="identifiant")
 * @ORM\Entity(repositoryClass="PremierBundle\Repository\IdentifiantRepository")
 */
class Identifiant
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
     * @ORM\Column(name="fname", type="string", length=255)
     */
    private $fName;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=255)
     */
     private $lName;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @param string $fName
     */
    public function setFName($fName)
    {
        $this->fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * @param string $lName
     */
    public function setLName($lName)
    {
        $this->lName = $lName;
    }


}
