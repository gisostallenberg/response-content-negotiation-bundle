<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Event;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultInterface;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Event\NegotiatedResultDataEvent;
use PHPUnit\Framework\TestCase;

/**
 * Test the negotiated result data event.
 *
 * @coversDefaultClass \GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Event\NegotiatedResultDataEvent
 */
class NegotiatedResultDataEventTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(NegotiatedResultDataEvent::class, $subject, 'Asserting that the class can be instantiated.');
    }

    /**
     * @covers ::setResult
     */
    public function testSetResult(): void
    {
        [$subject] = $this->getTestClass();
        $result    = $this->createMock(ResultInterface::class);

        $subject->setResult($result);
        $this->assertSame($result, $subject->getSubject(), 'Asserting that the result can be set and retrieved');
    }

    /**
     * @return array<mixed>
     */
    public function getTestClass(): array
    {
        $subject   = $this->createMock(ResultInterface::class);
        $arguments = ['foobar' => 'baz'];

        return [new NegotiatedResultDataEvent($subject, $arguments), $subject];
    }
}
