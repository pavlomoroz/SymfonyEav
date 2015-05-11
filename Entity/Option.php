<?php

namespace Enviroment\EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute_option")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Definition", inversedBy="options")
     * @ORM\JoinColumn(name="definition_id", referencedColumnName="id")
     */
    protected $definition;

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
     * @param  string $name
     * @return Option
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
     * Set definition
     *
     * @param  \Enviroment\EavBundle\Entity\Definition $definition
     * @return Option
     */
    public function setDefinition(\Enviroment\EavBundle\Entity\Definition $definition = null)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return \Enviroment\EavBundle\Entity\Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
