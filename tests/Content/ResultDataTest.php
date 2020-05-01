<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Content;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultData;
use PHPUnit\Framework\TestCase;

/**
 * Test the result data.
 *
 * @coversDefaultClass \GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultData
 */
class ResultDataTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testCanBeInstantiaded(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertInstanceOf(ResultData::class, $subject, 'Asserting that the class can be instantiated.');
    }

    /**
     * @covers ::getName
     */
    public function testTheNameOfResultDataCanBeRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertEquals('corge', $subject->getName(), 'Asserting that the name can be retrieved from ResultData.');
    }

    /**
     * @covers ::getData
     */
    public function testTheDataOfResultDataCanBeRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $this->assertEquals(['waldo', 'fred'], $subject->getData(), 'Asserting that the data can be retrieved from ResultData.');
    }

    /**
     * @covers ::setArgument
     * @covers ::getArgument
     */
    public function testAnArgumentCanBeSetAndRetrieved(): void
    {
        [$subject] = $this->getTestClass();
        $key       = 'foobar';
        $value     = 'foo';

        $subject->setArgument($key, $value);
        $this->assertEquals($value, $subject->getArgument($key), 'Asserting that the property Argument can be set and retrieved.');
    }

    /**
     * @covers ::setArgument
     * @covers ::getArgument
     */
    public function testAnExceptionIsThrownWhenRetrievingANonExistingParameter(): void
    {
        [$subject] = $this->getTestClass();
        $this->expectException(\InvalidArgumentException::class);
        $subject->getArgument('garply');
    }

    /**
     * @covers ::hasArgument
     */
    public function testPossibleToCheckIfTheResultDataHasACertainArgument(): void
    {
        [$subject] = $this->getTestClass();
        $key       = 'foobar';
        $value     = 'garply';

        $subject->setArgument($key, $value);
        $this->assertTrue($subject->hasArgument($key), 'Asserting that you can check if an argument is set on the resultdata.');
        $this->assertFalse($subject->hasArgument('corge'), 'Asserting that you can check if an argument is set on the resultdata.');
    }

    /**
     * @return array<mixed>
     */
    public function getTestClass(): array
    {
        $name      = 'corge';
        $data      = ['waldo', 'fred'];
        $arguments = [];

        return [new ResultData($name, $data, $arguments)];
    }
}
