<?php

namespace App\ValueObjects;

class Money
{
    public function __construct(
        private readonly int $cents
    ) {}

    public function toDollars(): string
    {
        return '$' . number_format($this->cents / 100, 2);
    }

    public function toCents(): int
    {
        return $this->cents;
    }
}
