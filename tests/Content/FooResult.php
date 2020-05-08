<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\Result;
use Symfony\Component\HttpFoundation\Response;

class FooResult extends Result
{
    public function getResponse(): Response
    {
        return new Response(
            implode('', $this->getResultData()->getData()),
            $this->getStatusCode()
        );
    }
}
