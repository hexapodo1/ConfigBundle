<?php

namespace Kishron\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfOption
 *
 * @ORM\Table(name="conf_option")
 * @ORM\Entity(repositoryClass="Kishron\ConfigBundle\Repository\ConfOptionRepository")
 */
class ConfOption
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;
    
    /**
     * @ORM\ManyToOne(targetEntity="ConfParameter", inversedBy="parameters")
     * @ORM\JoinColumn(name="parameter_id", referencedColumnName="id")
     */
    private $parameter;


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
     * Set value
     *
     * @param string $value
     * @return ConfOption
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ConfOption
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set parameter
     *
     * @param \Kishron\ConfigBundle\Entity\ConfParameter $parameter
     * @return ConfOption
     */
    public function setParameter(\Kishron\ConfigBundle\Entity\ConfParameter $parameter = null)
    {
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get parameter
     *
     * @return \Kishron\ConfigBundle\Entity\ConfParameter 
     */
    public function getParameter()
    {
        return $this->parameter;
    }
    
    public function __toString() {
        return $this->value;
    }
}
