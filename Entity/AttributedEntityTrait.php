<?php

namespace Enviroment\EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait AttributedEntityTrait
{
    /**
     * @var \Enviroment\EavBundle\Entity\Attribute
     *
     * @ORM\ManyToMany(targetEntity="\Enviroment\EavBundle\Entity\Attribute", fetch="EAGER", cascade={"persist", "remove"})
     */
    private $attributes;

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