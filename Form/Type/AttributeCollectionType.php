<?php

namespace Enviroment\EavBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

/**
* @DI\Service("form.type.attributeCollection")
* @DI\Tag("form.type", attributes = { "alias" = "attributeCollection" })
*/
class AttributeCollectionType extends CollectionType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'attributeCollection';
    }
}