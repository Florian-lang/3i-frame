<?php

namespace iFrame\Entity;

use App\EntityManager\EntityManager;

class BaseEntity
{
    protected EntityManager $em;

    public function __construct()
    {
        $this->em = new EntityManager();
    }
}
