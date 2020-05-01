<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Negotiation;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation\FormatNegotiator;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation\NegotiatorInterface;
use Negotiation\Negotiator;
use PHPUnit\Framework\TestCase;

/**
 * Test the format negotiator.
 *
 * @coversDefaultClass \GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Negotiation\FormatNegotiator
 */
class FormatNegotiatorTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(NegotiatorInterface::class, $subject, 'Asserting that the class can be instantiated.');
    }

    /**
     * @covers ::setPriorities
     * @covers ::getPriorities
     */
    public function testAnPrioritiesCanBeSetAndRetrieved(): void
    {
        [$subject]  = $this->getTestClass();
        $priorities = ['foo/bar', 'quuz/x-quux'];

        $subject->setPriorities($priorities);
        $this->assertEquals($priorities, $subject->getPriorities(), 'Asserting that the priorities can be set and retrieved.');
    }

    /**
     * @return array<mixed>
     */
    public function getTestClass(): array
    {
        $negotiator = $this->createMock(Negotiator::class);

        return [new FormatNegotiator($negotiator), $negotiator];
    }
}
