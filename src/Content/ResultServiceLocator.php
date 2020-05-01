<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Event\NegotiatedResultDataEvent;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation\NegotiatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Service\ServiceSubscriberTrait;

class ResultServiceLocator implements ResultServiceLocatorInterface
{
    use ServiceSubscriberTrait;

    /**
     * @var NegotiatorInterface
     */
    private $negotiator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        NegotiatorInterface $negotiator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->negotiator      = $negotiator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getResult(Request $request, ResultDataInterface $resultData, int $statusCode = Response::HTTP_OK): ResultInterface
    {
        $format = $this->negotiator->getResult($request);
        $result = $this->container->get(sprintf('%s::%s', __CLASS__, $format));
        $event  = new NegotiatedResultDataEvent($result);

        $result->setStatusCode($statusCode);
        $result->setResultData($resultData);
        $this->eventDispatcher->dispatch($event);

        return $event->getSubject();
    }
}
