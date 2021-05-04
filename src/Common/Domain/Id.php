<?php

namespace App\Common\Domain;

use Ramsey\Uuid\Uuid;

class Id extends ValueObject
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @param string|null $id
     */
    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
    }

    /**
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return  string
     */
    public function equals(Id $id): bool
    {
        return $this->id === $id->getId();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->id;
    }
}
