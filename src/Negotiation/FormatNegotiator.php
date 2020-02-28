<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation;

use Negotiation\Accept;
use Negotiation\Negotiator;
use Symfony\Component\HttpFoundation\Request;

class FormatNegotiator implements NegotiatorInterface
{
    /**
     * @var Negotiator
     */
    private $negotiator;

    public function __construct(Negotiator $negotiator)
    {
        $this->negotiator = $negotiator;
    }

    public function getResult(Request $request): string
    {
        $format    = $request->getRequestFormat();
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

        return $format ?? 'html';
    }
}
