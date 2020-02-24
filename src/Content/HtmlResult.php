<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HtmlResult extends Result
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(RequestStack $request, Environment $twig)
    {
        parent::__construct($request);

        $this->twig = $twig;
    }

    public function getResponse(): Response
    {
        $resultData = $this->getResultData();

        return new Response($this->twig->render(
            $resultData->getName().'.html.twig', // TODO: locate templates to render
            $resultData->getData()
        ));
    }
}
