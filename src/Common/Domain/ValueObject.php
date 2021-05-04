<?php

namespace App\Common\Domain;

abstract class ValueObject
{
    /**
     * @return string
     */
    public abstract function __toString(): string;
}
