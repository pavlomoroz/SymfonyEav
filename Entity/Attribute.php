<?php

namespace Enviroment\EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table("attribute")
 */
class Attribute
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
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="Definition", inversedBy="attributes", cascade={"persist"})
     * @ORM\JoinColumn(name="definition_id", referencedColumnName="id")
     * @var Definition
     */
    private $definition;

    public function __toString()
    {
        return $this->getDefinition()->getName();
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
     * Set value
     *
     * @param string $value
     * @return Attribute
     */
    public function setValue($value)
    {
        if ($value && is_array($value)) {
            $value = reset($value);
        }
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
     * Set definition
     *
     * @param \Enviroment\EavBundle\Entity\Definition $definition
     * @return Attribute
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
}
