<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

interface ResultDataInterface
{
    public function getName(): string;

    /**
     * @return array<mixed, mixed>
     */
    public function getData(): array;

    /**
     * @return mixed Contents of array key
     */
    public function getArgument(string $key);

    /**
     * @param mixed $value
     */
    public function setArgument(string $key, $value): self;

    public function hasArgument(string $key): bool;
}
