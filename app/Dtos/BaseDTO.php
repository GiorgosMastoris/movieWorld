<?php

namespace App\Dtos;

abstract class BaseDTO
{
    protected array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->initialize();
    }

    protected function initialize(): void
    {
    }

    public function toArray(): array
    {
        return $this->data;
    }

    abstract public function validate(): bool;
}
