<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use FOS\RestBundle\Context\Context;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Response\XmlResponse;
use Symfony\Component\HttpFoundation\Response;

class XmlResult extends SerializedResult
{
    public function getResponse(): Response
    {
        return new XmlResponse(
            $this->getSerializer()->serialize($this->getResultData()->getData(), 'xml', new Context())
        );
    }
}
