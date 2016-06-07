<?php

namespace Kishron\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfValue
 *
 * @ORM\Table(name="conf_value")
 * @ORM\Entity(repositoryClass="Kishron\ConfigBundle\Repository\ConfValueRepository")
 */
class ConfValue
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
     * @ORM\ManyToOne(targetEntity="ConfParameter", inversedBy="values")
     * @ORM\JoinColumn(name="parameter_id", referencedColumnName="id")
     */
    private $parameter;
    
    /**
     * @ORM\ManyToOne(targetEntity="ConfProfile", inversedBy="values")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    private $profile;
    
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
     * @return ConfValue
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
     * Set parameter
     *
     * @param \Kishron\ConfigBundle\Entity\ConfParameter $parameter
     * @return ConfValue
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

    /**
     * Set profile
     *
     * @param \Kishron\ConfigBundle\Entity\ConfProfile $profile
     * @return ConfValue
     */
    public function setProfile(\Kishron\ConfigBundle\Entity\ConfProfile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Kishron\ConfigBundle\Entity\ConfProfile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
