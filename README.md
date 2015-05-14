#Eav Bundle

##1, Require

jms_di_extra bundle

config

    - { resource: "@EnviromentEavBundle/Resources/config/config.yml" }
    
    jms_di_extra:
        locations:
            all_bundles: false
            bundles: [ EnviromentEavBundle ]
            directories: ["%kernel.root_dir%/../src"]
            
            
routing

    enviroment_eav:
        resource: "@EnviromentEavBundle/Resources/config/routing.yml"
        prefix:   /attribute
        

FormType

    ->add('attributes', 'attributeCollection', array(
                'type' => new AttributeType()
            ))
            
Kernel 
    
    new Enviroment\EavBundle\EnviromentEavBundle(),
    
Your entity

    use Enviroment\EavBundle\Annotation as EAV;
    use Enviroment\EavBundle\Entity\AttributedEntityTrait;
    
    /**
     * Entity
     * @EAV\Entity()
     ...
     */
    class Entity 
    {
        use AttributedEntityTrait;
    }