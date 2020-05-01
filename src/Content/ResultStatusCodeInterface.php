<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

interface ResultStatusCodeInterface
{
    public function setStatusCode(int $statusCode): ResultInterface;

    public function getStatusCode(): int;
}
