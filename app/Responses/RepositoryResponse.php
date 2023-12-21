<?php

namespace App\Responses;

class RepositoryResponse
{
    public string $status;
    public string $message;

    public function __construct(array $data)
    {
        $this->status = data_get($data, 'status');
        $this->message = data_get($data, 'message');
    }
}
