<?php

namespace App\Dto;

use DateTime;

class ExpenseDto
{
    public ?int $user_id;
    public ?string $description;
    public ?DateTime $date;
    public ?float $value;

    public function __construct(array $data)
    {
        $this->user_id = auth()->user()->id;
        $this->description = isset($data['description']) ? $data['description'] : null;
        $this->date = isset($data['date']) ? new DateTime($data['date']) : null;
        $this->value = isset($data['value']) ? $data['value'] : null;
    }

    public function toArray()
    {
        $data = [];

        if ($this->user_id) $data['user_id'] = $this->user_id;
        if ($this->description) $data['description'] = $this->description;
        if ($this->date) $data['date'] = $this->date->format('y-m-d');
        if ($this->value) $data['value'] = $this->value;

        return $data;
    }
}
