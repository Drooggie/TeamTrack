<?php

namespace App\DataTransferObjects;

class DepartmentData
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
    ) {}
}
