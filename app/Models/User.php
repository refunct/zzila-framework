<?php

namespace App\Models;

class User
{
    private $first_name = 'Rasmus';
    private $last_name = 'Lerdorf';

    public function getFirstName(): string
    {
        return $this->first_name;
    }
    public function getLastName(): string
    {
        return $this->last_name;
    }
    public function getInfo(): array
    {
        return array(
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        );
    }
}
