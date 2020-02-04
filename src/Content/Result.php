<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\RequestStack;

abstract class Result implements ResultInterface
{
    private RequestStack $request;

    private ResultData $resultData;

    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    public function setResultData(ResultData $resultData): ResultInterface
    {
        $this->resultData = $resultData;

        return $this;
    }

    public function getResultData(): ?ResultData
    {
        return $this->resultData;
    }
}
