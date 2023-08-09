<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Response;

use Symfony\Component\HttpFoundation\Response;

class XmlResponse extends Response
{
    /**
     * @param mixed                 $data    The response data
     * @param int                   $status  The response status code
     * @param array<string, string> $headers An array of response headers
     */
    public function __construct(mixed $data = null, $status = 200, $headers = [])
    {
        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', 'application/xml; charset=utf-8');
        }
    }
}
