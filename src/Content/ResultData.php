<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

class ResultData implements ResultDataInterface
{
    private string $name;

    /**
     * @var array<mixed, mixed>
     */
    private array $data = [];

    /**
     * @param array<mixed, mixed> $data
     */
    public function __construct(
        string $name,
        array $data = []
    ) {
        $this->name = $name;
        $this->data = $data;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
