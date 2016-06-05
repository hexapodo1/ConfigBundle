<?php

namespace Kishron\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfCategory
 *
 * @ORM\Table(name="conf_category")
 * @ORM\Entity(repositoryClass="Kishron\ConfigBundle\Repository\ConfCategoryRepository")
 */
class ConfCategory
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=100, nullable=true, unique=true)
     */
    private $code;
    
    /**
     * @ORM\ManyToOne(targetEntity="ConfModule", inversedBy="categories")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    private $module;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfParameter", mappedBy="category")
     */
    private $parameters;


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
     * @return ConfCategory
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
     * Set code
     *
     * @param string $code
     * @return ConfCategory
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set module
     *
     * @param \Kishron\ConfigBundle\Entity\ConfModule $module
     * @return ConfCategory
     */
    public function setModule(\Kishron\ConfigBundle\Entity\ConfModule $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Kishron\ConfigBundle\Entity\ConfModule 
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parameters = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parameters
     *
     * @param \Kishron\ConfigBundle\Entity\ConfParameter $parameters
     * @return ConfCategory
     */
    public function addParameter(\Kishron\ConfigBundle\Entity\ConfParameter $parameters)
    {
        $this->parameters[] = $parameters;

        return $this;
    }

    /**
     * Remove parameters
     *
     * @param \Kishron\ConfigBundle\Entity\ConfParameter $parameters
     */
    public function removeParameter(\Kishron\ConfigBundle\Entity\ConfParameter $parameters)
    {
        $this->parameters->removeElement($parameters);
    }

    /**
     * Get parameters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParameters()
    {
        return $this->parameters;
    }
    
    public function __toString() {
        return $this->name;
    }
}
