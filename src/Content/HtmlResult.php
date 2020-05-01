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
        $template   = $this->getTemplate($resultData);

        return new Response(
            $this->twig->render(
                $template,
                $resultData->getData()
            ),
            $this->getStatusCode()
        );
    }

    private function getTemplate(ResultDataInterface $resultData): string
    {
        if ($resultData->hasArgument('template')) {
            return $resultData->getArgument('template');
        }

        return $resultData->getName().'.html.twig';
    }
}
