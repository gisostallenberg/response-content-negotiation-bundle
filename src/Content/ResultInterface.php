<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\Response;

interface ResultInterface extends ResultStatusCodeInterface
{
    public function setResultData(ResultDataInterface $resultData): self;

    public function getResultData(): ?ResultDataInterface;

    public function getResponse(): Response;
}
