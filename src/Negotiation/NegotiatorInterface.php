<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation;

use Symfony\Component\HttpFoundation\Request;

interface NegotiatorInterface
{
    public function getResult(Request $request): string;
}
