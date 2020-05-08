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
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var ResultDataInterface
     */
    private $resultData;

    /**
     * @var int
     */
    private $statusCode = Response::HTTP_OK;

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
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
