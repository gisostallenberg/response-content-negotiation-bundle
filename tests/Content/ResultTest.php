<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Tests\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultData;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultInterface;
use GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Content\FooResult;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test the result.
 *
 * @coversDefaultClass \GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\Result
 */
class ResultTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ResultInterface::class, $subject, 'Asserting that the class can be instantiated.');
    }

    /**
     * @covers ::setResultData
     * @covers ::getResultData
     */
    public function testTheResultDataCanBeSetAndRetrieved(): void
    {
        [$subject]  = $this->getTestClass();
        $resultData = new ResultData(
            'foobar',
            [],
            [
                'status_code' => Response::HTTP_OK,
            ]
        );

        $subject->setResultData($resultData);

        $this->assertSame($resultData, $subject->getResultData(), 'Asserting that the result data can be set and retrieved.');
    }

    /**
     * @covers ::getStatusCode
     */
    public function testTheStatusCodeForTheResponseCanBeSet(): void
    {
        [$subject]  = $this->getTestClass();
        $resultData = new ResultData(
            'foobar',
            [],
            [
                'status_code' => Response::HTTP_BAD_REQUEST,
            ]
        );

        $subject->setResultData($resultData);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $subject->getResponse()->getStatusCode(), 'Asserting that the response status code can be set.');
    }

    /**
     * @covers ::getStatusCode
     */
    public function testTheDefaultStatusCodeForTheResponseIsHttp200Ok(): void
    {
        [$subject]  = $this->getTestClass();
        $resultData = new ResultData(
            'foobar',
            []
        );

        $subject->setResultData($resultData);

        $this->assertEquals(Response::HTTP_OK, $subject->getResponse()->getStatusCode(), 'Asserting that the default response status code is HTTP 200 OK.');
    }

    public function getTestClass(): array
    {
        $requestStack = new RequestStack();

        return [new FooResult($requestStack), $requestStack];
    }
}
