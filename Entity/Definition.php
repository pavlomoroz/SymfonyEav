<?php

namespace Enviroment\EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute_definition")
 */
class Definition
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $required = FALSE;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var string
     */
    private $orderIndex;

    /**
     * @ORM\ManyToOne(targetEntity="Schema", inversedBy="definitions")
     * @ORM\JoinColumn(name="schema_id", referencedColumnName="id")
     * @var Schema
     */
    private $schema;

    /**
     * @ORM\OneToMany(targetEntity="Option", mappedBy="definition", orphanRemoval=true, cascade={"persist", "remove"}, fetch="EXTRA_LAZY")
     * @var ArrayCollection
     */
    private $options;

    /**
     * @var \Enviroment\EavBundle\Entity\Attribute
     *
     * @ORM\OneToMany(targetEntity="\Enviroment\EavBundle\Entity\Attribute", mappedBy="definition", cascade={"remove"})
     */
    private $attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

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
     * @return Definition
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
     * Set type
     *
     * @param string $type
     * @return Definition
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
     * Set required
     *
     * @param boolean $required
     * @return Definition
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set orderIndex
     *
     * @param integer $orderIndex
     * @return Definition
     */
    public function setOrderIndex($orderIndex)
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    /**
     * Get orderIndex
     *
     * @return integer
     */
    public function getOrderIndex()
    {
        return $this->orderIndex;
    }

    /**
     * Set schema
     *
     * @param \Enviroment\EavBundle\Entity\Schema $schema
     * @return Definition
     */
    public function setSchema(\Enviroment\EavBundle\Entity\Schema $schema = null)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Get schema
     *
     * @return \Enviroment\EavBundle\Entity\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Add options
     *
     * @param \Enviroment\EavBundle\Entity\Option $options
     * @return Definition
     */
    public function addOption(\Enviroment\EavBundle\Entity\Option $option)
    {
        $this->options[] = $option;
        $option->setDefinition($this);

        return $this;
    }

    /**
     * Remove options
     *
     * @param \Enviroment\EavBundle\Entity\Option $options
     */
    public function removeOption(\Enviroment\EavBundle\Entity\Option $options)
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

    /**
     * @param \Enviroment\EavBundle\Entity\Option $option
     * @return $this
     */
    public function setOptions($option)
    {
        if (in_array($option, $this->options->toArray())) {
            $this->options[] = $option;
        }

        return $this;
    }

    /**
     * Add attributes
     *
     * @param \Enviroment\EavBundle\Entity\Attribute $attributes
     */
    public function addAttribute(\Enviroment\EavBundle\Entity\Attribute $attributes)
    {
        $this->attributes[] = $attributes;

        return $this;
    }

    /**
     * Remove attributes
     *
     * @param \Enviroment\EavBundle\Entity\Attribute $attributes
     */
    public function removeAttribute(\Enviroment\EavBundle\Entity\Attribute $attributes)
    {
        $this->attributes->removeElement($attributes);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
