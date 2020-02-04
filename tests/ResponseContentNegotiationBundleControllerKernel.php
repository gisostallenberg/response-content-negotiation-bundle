<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\Tests\ResponseContentNegotiationBundle;

use FOS\RestBundle\FOSRestBundle;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\GisoStallenbergResponseContentNegotiationBundle;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class ResponseContentNegotiationBundleControllerKernel extends Kernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function registerBundles()
    {
        return [
            new GisoStallenbergResponseContentNegotiationBundle(),
            new FrameworkBundle(),
            new TwigBundle(),
            new FOSRestBundle(),
            new JMSSerializerBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->import(__DIR__.'/Resources/config/routes.yaml');
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $confDir = __DIR__.'/Resources/config';
        $loader->load($confDir.'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{services}'.self::CONFIG_EXTS, 'glob');
    }

    public function getCacheDir()
    {
        return __DIR__.'/var/cache/'.spl_object_hash($this);
    }
}
