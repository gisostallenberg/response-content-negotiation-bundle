<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResultControllerTest extends WebTestCase
{
    public function testHtmlIsDefault(): void
    {
        $client = static::createClient();

        $client->request('GET', '/get/result');
        $default = $client->getResponse()->getContent();

        $client->request('GET', '/get/result', [], [], ['HTTP_ACCEPT' => 'text/html']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals($default, $client->getResponse()->getContent());
    }

    public function testHtml(): void
    {
        $client = static::createClient();

        $client->request('GET', '/get/result', [], [], ['HTTP_ACCEPT' => 'text/html']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        if ($content === false) {
            $this->fail('There is no response content');

            return;
        }

        $fileContents = @file_get_contents(__DIR__.'/../Resources/views/test.html.twig');
        if ($fileContents === false) {
            $this->fail('The data can not be tested');

            return;
        }

        $expectedXml = str_replace('{{ test }}', 'result data', $fileContents);
        $this->assertXmlStringEqualsXmlString(
            $expectedXml,
            $content
        );
    }

    public function testJson(): void
    {
        $client = static::createClient();

        $client->request('GET', '/get/result', [], [], ['HTTP_ACCEPT' => 'application/json']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        if ($content === false) {
            $this->fail('There is no response content');

            return;
        }

        $jsonResult = \json_decode($content, true);

        $this->assertIsArray($jsonResult);
        $this->assertEquals(['test' => 'result data'], $jsonResult);
    }

    public function testXml(): void
    {
        $client = static::createClient();

        $client->request('GET', '/get/result', [], [], ['HTTP_ACCEPT' => 'application/xml']);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = $client->getResponse()->getContent();
        if ($content === false) {
            $this->fail('There is no response content');

            return;
        }

        $this->assertXmlStringEqualsXmlString(
            '<result><entry><![CDATA[result data]]></entry></result>',
            $content
        );
    }
}
