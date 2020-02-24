<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Negotiation\Accept;
use Negotiation\Negotiator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Service\ServiceSubscriberTrait;

class ResultServiceLocator implements ResultServiceLocatorInterface
{
    use ServiceSubscriberTrait;

    /**
     * @var Negotiator
     */
    private $negotiator;

    public function __construct(
        Negotiator $negotiator
    ) {
        $this->negotiator = $negotiator;
    }

    public function getResult(Request $request, ResultDataInterface $resultData): ResultInterface
    {
        $format = $this->getFormat($request);
        $result = $this->container->get(sprintf('%s::%s', __CLASS__, $format));
        $result->setResultData($resultData);

        // todo: dispatch negotiated result

        return $result;
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
