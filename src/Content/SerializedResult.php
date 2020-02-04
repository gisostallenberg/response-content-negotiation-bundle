<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use FOS\RestBundle\Serializer\Serializer;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class SerializedResult extends Result
{
    /**
     * @var Serializer
     */
    private Serializer $serializer;

    public function __construct(RequestStack $request, Serializer $serializer)
    {
        parent::__construct($request);

        $this->serializer = $serializer;
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }
}
