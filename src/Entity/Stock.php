<?php

namespace App\Entity;

class Stock
{
    private int $id;
    private int $number;

    public function getId(): int
    {
        return $this->id;
    }

    public function setProductId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;
        return $this;
    }
}