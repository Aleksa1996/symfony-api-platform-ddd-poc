<?php

namespace App\Common\Domain;

use App\Common\Domain\Id;

trait Identity
{
    /**
     * @var Id
     */
    protected Id $id;

    /**
     * @return  Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @param  Id  $id
     *
     * @return  void
     */
    protected function setId(Id $id): void
    {
        $this->id = $id;
    }
}
