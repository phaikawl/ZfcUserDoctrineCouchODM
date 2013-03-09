ZfcUserDoctrineCouchODM
=======================
Version 0.1 by Hai Thanh Nguyen. Forked from the MongoDB one (https://github.com/ZF-Commons/ZfcUserDoctrineMongoODM)
Introduction
------------
ZfcUserDoctrineCouchODM is a CouchDb storage adapter for [ZfcUser](https://github.com/ZF-Commons/ZfcUser). This module makes use of the Doctrine2 CouchDB ODM.

Installation
------------
Just clone this module to the `vendor` directory, add `ZfcUserDoctrineCouchODM` to the modules array in `application.config.php`, after `ZfcUser`. Important: it MUST be put after `ZfcUser`, if you put it before `ZfcUser`, it won't work!

Dependencies
------------

- [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
- [DoctrineModule](https://github.com/doctrine/DoctrineModule)
- [DoctrineCouchODMModule](https://github.com/ardemiranda/DoctrineCouchODMModule)
