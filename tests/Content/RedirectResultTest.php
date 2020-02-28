<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Tests\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\RedirectResult;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Test the redirect result.
 *
 * @coversDefaultClass \GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\RedirectResult
 */
class RedirectResultTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(RedirectResult::class, $subject, 'Asserting that the class can be instantiated.');
    }

    /**
     * @covers ::getResponse
     */
    public function testGetResponse(): void
    {
        [$subject, $url] = $this->getTestClass();
        $result          = $subject->getResponse();
        $this->assertInstanceof(RedirectResponse::class, $result, 'Asserting that a redirect response is returned.');
        $this->assertEquals($url, $result->getTargetUrl(), 'Asserting that the redirect response contains the correct redirect url.');
    }

    public function getTestClass(): array
    {
        $url = '/wibble';

        return [new RedirectResult($url), $url];
    }
}
