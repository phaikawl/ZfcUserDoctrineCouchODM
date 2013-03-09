<?php

namespace ZfcUserDoctrineCouchODM\Mapper;

use Doctrine\ODM\CouchDB\DocumentManager,
    ZfcUserDoctrineCouchODM\Options\ModuleOptions;

class UserInsertDuplicateException extends \Exception {
    public function __construct($message = null) {
        if (!$message) {
            $this->message = "Duplicated username or email.";
        }
    }
}

class UserCouchDB implements \ZfcUser\Mapper\UserInterface
{
    /**
     * @var \Doctrine\ODM\DocumentManager
     */
    protected $dm;
    
    /**
     * @var \ZfcUserDoctrineORM\Options\ModuleOptions
     */
    protected $options;
    
    public function __construct(DocumentManager $dm, ModuleOptions $options)
    {
        $this->dm      = $dm;
        $this->options = $options;
        $this->entityClass = $this->options->getUserEntityClass();
    }

    public function findByEmail($email)
    {
        $user = $this->getUserRepository()->findOneBy(array('email' => $email));
        return $user;
    }

    public function findByUsername($username)
    {
        $user = $this->getUserRepository()->findOneBy(array('username' => $username));
        return $user;
    }
    
    public function findById($id)
    {
        $user = $this->dm->find($this->entityClass, $id);
        return $user;
    }

    public function getDocumentManager()
    {
        return $this->dm;
    }

    public function setDocumentManager(DocumentManager $dm)
    {
        $this->dm = $dm;
        return $this;
    }

    public function getUserRepository()
    {
        return $this->dm->getRepository($this->entityClass);
    }
    
    public function persist($document)
    {
        $dm = $this->dm;
        $dm->persist($document);
        $dm->flush();
    }
    
    public function insert($document, $tableName = null, HydratorInterface $hydrator = null)
    {
        $dm = $this->dm;
        //checking
        $loop = array(
                'username' => $document->getUsername(),
                'email' => $document->getEmail()
            );
        foreach ($loop as $criteria => $value) {
            if ($this->getUserRepository()
                ->findOneBy(array($criteria => $value)) !== null)
            {
                throw new UserInsertDuplicateException;
            }
        }

        //OK
        $dm->persist($document);
        $dm->flush();

        //Check again, just being careful
        foreach ($loop as $criteria => $value) {
            $users = $this->getUserRepository()->findBy(array($criteria => $value));
            if (count($users) > 1) {
                $dm->remove($document);
                $dm->flush();
                throw new UserInsertDuplicateException;          
            }
        }
    }

    public function update($document, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'id = ' . $document->getId();
        }

        $this->dm->persist($document);
        $this->dm->flush();
    }
}
