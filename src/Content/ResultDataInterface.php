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
}
