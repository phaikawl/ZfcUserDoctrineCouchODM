<?php

namespace ZfcUserDoctrineCouchODM\Options;

use ZfcUser\Options\ModuleOptions as BaseModuleOptions;

class ModuleOptions extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected $userEntityClass = 'ZfcUserDoctrineCouchODM\Document\User';

    /**
     * @var bool
     */
    protected $enableDefaultEntities = true;

    /**
     * @param boolean $enableDefaultEntities
     */
    public function setEnableDefaultEntities($enableDefaultEntities)
    {
        $this->enableDefaultEntities = $enableDefaultEntities;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getEnableDefaultEntities()
    {
        return $this->enableDefaultEntities;
    }
}
