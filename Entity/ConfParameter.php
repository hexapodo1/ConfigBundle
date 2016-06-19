<?php

namespace Kishron\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfParameter
 *
 * @ORM\Table(name="conf_parameter")
 * @ORM\Entity(repositoryClass="Kishron\ConfigBundle\Repository\ConfParameterRepository")
 */
class ConfParameter
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="ConfCategory", inversedBy="parameters")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfOption", mappedBy="parameter")
     */
    private $options;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfValue", mappedBy="parameter")
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
     * @return ConfParameter
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
     * Set description
     *
     * @param string $description
     * @return ConfParameter
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param \Kishron\ConfigBundle\Entity\ConfCategory $category
     * @return ConfParameter
     */
    public function setCategory(\Kishron\ConfigBundle\Entity\ConfCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Kishron\ConfigBundle\Entity\ConfCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add options
     *
     * @param \Kishron\ConfigBundle\Entity\ConfOption $options
     * @return ConfParameter
     */
    public function addOption(\Kishron\ConfigBundle\Entity\ConfOption $options)
    {
        $this->options[] = $options;

        return $this;
    }

    /**
     * Remove options
     *
     * @param \Kishron\ConfigBundle\Entity\ConfOption $options
     */
    public function removeOption(\Kishron\ConfigBundle\Entity\ConfOption $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    public function __toString() {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add values
     *
     * @param \Kishron\ConfigBundle\Entity\ConfValue $values
     * @return ConfParameter
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
    
    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValue($codeProfile)
    {
        $valueR = null;
        foreach ($this->values as $value) {
            if ($value->getProfile()->getCode() === $codeProfile) {
                $valueR = $value;
            }
        }
        return $valueR;
    }
}
