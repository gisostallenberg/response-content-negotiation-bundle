<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle\Controller;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultData;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultInterface;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultServiceLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResultController
{
    /**
     * @Route("/get/result", methods={"GET"})
     */
    public function resultAction(
        ResultServiceLocator $resultServiceLocator,
        Request $request
    ): ResultInterface {
        return $resultServiceLocator->getResult($request, new ResultData('test', ['test' => 'result data']));
    }
}
