<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonResult extends SerializedResult
{
    public function getResponse(): Response
    {
        $context = $this->getContext();

        return new JsonResponse(
            $this->getSerializer()->serialize($this->getResultData()->getData(), 'json', $context),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
