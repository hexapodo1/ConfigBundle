<?php

namespace Kishron\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfProfile
 *
 * @ORM\Table(name="conf_profile")
 * @ORM\Entity(repositoryClass="Kishron\ConfigBundle\Repository\ConfProfileRepository")
 */
class ConfProfile
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfValue", mappedBy="profile")
     */
    private $values;


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
     * Set name
     *
     * @param string $name
     * @return ConfProfile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add values
     *
     * @param \Kishron\ConfigBundle\Entity\ConfValue $values
     * @return ConfProfile
     */
    public function addValue(\Kishron\ConfigBundle\Entity\ConfValue $values)
    {
        $this->values[] = $values;

        return $this;
    }

    /**
     * Remove values
     *
     * @param \Kishron\ConfigBundle\Entity\ConfValue $values
     */
    public function removeValue(\Kishron\ConfigBundle\Entity\ConfValue $values)
    {
        $this->values->removeElement($values);
    }

    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValues()
    {
        return $this->values;
    }
}
