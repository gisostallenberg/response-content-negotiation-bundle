<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Event\NegotiatedResultDataEvent;
use Negotiation\Accept;
use Negotiation\Negotiator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\Service\ServiceSubscriberTrait;

class ResultServiceLocator implements ResultServiceLocatorInterface
{
    use ServiceSubscriberTrait;

    /**
     * @var Negotiator
     */
    private $negotiator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        Negotiator $negotiator,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->negotiator      = $negotiator;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getResult(Request $request, ResultDataInterface $resultData): ResultInterface
    {
        $format = $this->getFormat($request);
        $result = $this->container->get(sprintf('%s::%s', __CLASS__, $format));
        $event  = new NegotiatedResultDataEvent($result);

        $result->setResultData($resultData);
        $this->eventDispatcher->dispatch($event);

        return $event->getSubject();
    }

    private function getFormat(Request $request): string
    {
        $mediaType = $this->negotiator->getBest(
            $request->headers->get('accept'),
            [
                'text/html',
                'application/json',
                'application/xml',
            ]
        );
        if ($mediaType instanceof Accept) {
            $format = $mediaType->getSubPart();
        }
        if (!isset($format)) {
            $format = $request->getRequestFormat();
        }

        return $format ?? 'html';
    }

    private function html(): HtmlResult
    {
        return $this->container->get(__METHOD__);
    }

    private function json(): JsonResult
    {
        return $this->container->get(__METHOD__);
    }

    private function xml(): XmlResult
    {
        return $this->container->get(__METHOD__);
    }
}
