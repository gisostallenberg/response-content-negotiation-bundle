[![Latest Stable Version](https://poser.pugx.org/gisostallenberg/response-content-negotiation-bundle/v/stable)](https://packagist.org/packages/gisostallenberg/response-content-negotiation-bundle)
[![Latest Unstable Version](https://poser.pugx.org/gisostallenberg/response-content-negotiation-bundle/v/unstable)](https://packagist.org/packages/gisostallenberg/response-content-negotiation-bundle)
[![Total Downloads](https://poser.pugx.org/gisostallenberg/response-content-negotiation-bundle/downloads)](https://packagist.org/packages/gisostallenberg/response-content-negotiation-bundle)
[![License](https://poser.pugx.org/gisostallenberg/response-content-negotiation-bundle/license)](https://packagist.org/packages/gisostallenberg/response-content-negotiation-bundle)

# Response Content Negotiation Bundle

A bundle that allows creating various Response types from a controller, based on content negotiation

## Installation
```bash
composer require gisostallenberg/response-content-negotiation-bundle
```

## Requirements
### HTML
To render HTML the bundle requires [TwigBundle](https://github.com/symfony/twig-bundle).

### JSON & XML
To output JSON or XML the bundle requires [FOS Rest Bundle](https://github.com/FriendsOfSymfony/FOSRestBundle) and [JMS Serializer Bundle](https://github.com/schmittjoh/JMSSerializerBundle) or [Symfony Serializer](https://github.com/symfony/serializer)  

## Usage
```php
<?php

namespace App\Controller;

use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultData;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultInterface;
use GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content\ResultServiceLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AcmeController
{
    /**
     * @Route("/my-page", methods={"GET"})
     */
    public function resultAction(
        ResultServiceLocator $resultServiceLocator,
        Request $request
    ): ResultInterface {
        return $resultServiceLocator->getResult($request, new ResultData('acme', ['my-data-label' => 'my data']));
    }
}
```
### HTML
This will render `acme.html.twig` with the Twig context `['my-data-label' => 'my data']`.

If you want to render a specific template, you can add this as `template` argument to the ResultData.
For example:

```php
new ResultData('acme', ['my-data-label' => 'my data'], ['template' => '@AcmeBundle/templates/acme.twig.html'])
```

This will render `@AcmeBundle/templates/acme.twig.html` with the Twig context `['my-data-label' => 'my data']`.

### JSON
This will respond with
```json
{
  "my-data-label": "my data"
}
```

### XML
This will respond with
```xml
<my-data-label>
    <entry>my data</entry>
<my-data-label>
```

### Serialization

To use serialization groups in the serialization process, you can add the `groups` option parameter.
For example:

```php
new ResultData('acme', ['my-data-label' => 'my data'], ['groups' => ['profile', 'list']])
```
