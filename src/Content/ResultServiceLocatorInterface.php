<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

interface ResultServiceLocatorInterface extends ServiceSubscriberInterface
{
    public function getResult(Request $request, ResultDataInterface $resultData): ResultInterface;
}
