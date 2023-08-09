<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\DependencyInjection\ResponseContentNegotiationExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class GisoStallenbergResponseContentNegotiationBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ResponseContentNegotiationExtension();
    }
}
