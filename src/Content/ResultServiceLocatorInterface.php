<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\ServiceSubscriberInterface;

interface ResultServiceLocatorInterface extends ServiceSubscriberInterface
{
    public function getResult(Request $request, ResultDataInterface $resultData, int $statusCode = Response::HTTP_OK): ResultInterface;
}
