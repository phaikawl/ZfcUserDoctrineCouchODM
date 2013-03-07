<?php
return array(
    'doctrine' => array(
        'driver' => array(
            'zfcuser_document' => array(
                'class' => 'Doctrine\ODM\CouchDB\Mapping\Driver\XmlDriver',
                'paths' => __DIR__ . '/xml'
            ),

            'odm_default' => array(
                'drivers' => array(
                    'ZfcUserDoctrineCouchODM\Document'  => 'zfcuser_document'
                )
            )
        )
    ),
);