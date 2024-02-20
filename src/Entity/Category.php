<?php

namespace App\Entity;

class Category
{
    private int $id;
    private string $name;
    private ?string $bgcolor;
    private ?string $textcolor;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getBgColor(): ?string
    {
        return $this->bgcolor;
    }

    public function setBgColor(?string $bgcolor): self
    {
        $this->bgcolor = $bgcolor;
        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextColor(?string $textcolor): self
    {
        $this->textcolor = $textcolor;
        return $this;
    }
}