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
     * @var array<string>
     */
    private $priorities = [
        'text/html',
        'application/json',
        'application/xml',
    ];

    public function __construct(private Negotiator $negotiator)
    {
    }

    public function getResult(Request $request): string
    {
        $format    = $request->getRequestFormat();
        $mediaType = $this->negotiator->getBest(
            $request->headers->get('accept'),
            $this->priorities
        );

        if ($mediaType instanceof Accept) {
            $format = $mediaType->getSubPart();
        }

        return $format ?? 'html';
    }

    /**
     * @return array<string>
     */
    public function getPriorities(): array
    {
        return $this->priorities;
    }

    /**
     * @param array<string> $priorities
     */
    public function setPriorities(array $priorities): self
    {
        $this->priorities = $priorities;

        return $this;
    }
}
