<?php

namespace Enviroment\EavBundle\Form;

use Enviroment\EavBundle\Form\EventListener\AttributeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new AttributeSubscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enviroment\EavBundle\Entity\Attribute',
        ));
    }

    public function getName()
    {
        return 'attribute';
    }
}
