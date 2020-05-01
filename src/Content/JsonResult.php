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
        $data    = $this->getResultData()->getData();

        return new JsonResponse(
            $this->getSerializer()->serialize($data, 'json', $context),
            $this->getStatusCode($data),
            [],
            true
        );
    }

    /**
     * @param array<string, mixed> $data
     */
    private function getStatusCode(array $data): int
    {
        if (array_key_exists('errors', $data) && is_array($data['errors']) && count($data['errors']) > 0) {
            return Response::HTTP_BAD_REQUEST;
        }

        return Response::HTTP_OK;
    }
}
