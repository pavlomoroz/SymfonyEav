#Installation

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