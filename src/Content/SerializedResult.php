<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Serializer\Serializer;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class SerializedResult extends Result
{
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(RequestStack $request, Serializer $serializer)
    {
        parent::__construct($request);

        $this->serializer = $serializer;
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    protected function getContext(): Context
    {
        $context    = new Context();
        $resultData = $this->getResultData();
        if ($resultData !== null && $resultData->hasArgument('groups')) {
            $groups = $resultData->getArgument('groups');
            $context->addGroups($groups);
        }

        return $context;
    }
}
