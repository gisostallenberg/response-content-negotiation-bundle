<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\Response;

interface ResultInterface
{
    public function setResultData(ResultData $resultData): self;

    public function getResultData(): ?ResultData;

    public function getResponse(): Response;
}
