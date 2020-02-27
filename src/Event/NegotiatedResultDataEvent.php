<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Event;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class NegotiatedResultDataEvent extends GenericEvent
{
    /**
     * @param ResultInterface      $subject
     * @param array<string, mixed> $arguments
     */
    public function __construct(ResultInterface $subject = null, array $arguments = [])
    {
        parent::__construct($subject, $arguments);
    }

    public function setResult(ResultInterface $result): void
    {
        $this->subject = $result;
    }
}
