<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

abstract class Result implements ResultInterface
{
    private ?\GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultDataInterface $resultData = null;

    private int $statusCode = Response::HTTP_OK;

    public function __construct(protected RequestStack $request)
    {
    }

    public function setResultData(ResultDataInterface $resultData): ResultInterface
    {
        $this->resultData = $resultData;

        return $this;
    }

    public function getResultData(): ?ResultDataInterface
    {
        return $this->resultData;
    }

    public function setStatusCode(int $statusCode): ResultInterface
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
