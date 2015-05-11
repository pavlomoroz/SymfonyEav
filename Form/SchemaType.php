<?php

namespace Enviroment\EavBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SchemaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('definitions', 'collection', array(
            'type' => new DefinitionType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enviroment\EavBundle\Entity\Schema',
        ));
    }

    public function getName()
    {
        return 'schema';
    }
}
