<?php

namespace Enviroment\EavBundle\Services;

use Doctrine\ORM\EntityManager;
use Enviroment\EavBundle\Entity\Attribute;
use Enviroment\EavBundle\Entity\Schema;

class EavEntityService
{
    /** @var EntityManager  */
    protected  $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAttributeSchema($entityClass = '')
    {
        $schemas = $this->entityManager->getRepository('EnviromentEavBundle:Schema')->findAll();

        if (!$schemas) {
            throw new \Exception("No Entities connected to Attribute bundle");
        }

        /** @var Schema  $schema */
        $schema = null;

        if ($entityClass) {
            /** @var Schema $schemaValue */
            foreach ($schemas as $schemaValue) {
                if ($schemaValue->getClassName() == $entityClass){
                    $schema = $schemaValue;
                    break;
                }
            }

            if (!$schema) {
                throw new \Exception("Invalid entity class");
            }
        } else {
            $schema = $schemas[0];
        }

        return $schema;
    }

    public function createAttributeEntity($entityClass = '')
    {
        $schema = $this->getAttributeSchema($entityClass);

        $className = $schema->getClassName();

        $entity = new $className();

        foreach ($schema->getDefinitions() as $definition) {
            $attribute = new Attribute();
            $attribute->setDefinition($definition);

            $entity->addAttribute($attribute);
        }

        return $entity;
    }
}