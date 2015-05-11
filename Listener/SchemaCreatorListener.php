<?php

namespace Enviroment\EavBundle\Listener;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Enviroment\EavBundle\Entity\Schema;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("attribute.schema_creator")
 * @DI\Tag("doctrine.event_listener", attributes = {"event" = "loadClassMetadata"})
 */
class SchemaCreatorListener
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();

        $metadata = $eventArgs->getClassMetadata();
        $refl = $metadata->getReflectionClass();

        if ($refl === null) {
            $refl = new \ReflectionClass($metadata->getName());
        }

        $reader = new AnnotationReader();

        if ($reader->getClassAnnotation($refl, 'Enviroment\EavBundle\Annotation\Entity') != null) {
            try {
                $schema = $em->getRepository('EnviromentEavBundle:Schema')->findOneBy(array(
                    'className' => $metadata->getName()
                ));

                if ($schema === null) {
                    $schema = new Schema();
                    $schema->setClassName($metadata->getName());

                    $em->persist($schema);
                    $em->flush($schema);
                }
            } catch (DBALException $e) {
                // Discard DBAL exceptions in order for schema:update to work
            }
        }
    }
}