<?php

declare(strict_types=1);

/*
 * This file is part of the Response Content Negotiation Bundle package.
 * (c) Giso Stallenberg.
 */

namespace GisoStallenberg\Bundle\ResponseContentNegotiationBundle\Content;

class ResultData implements ResultDataInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array<mixed, mixed>
     */
    private $data = [];

    /**
     * @var array<string, mixed>
     */
    private $arguments = [];

    /**
     * @param array<mixed, mixed>  $data
     * @param array<string, mixed> $arguments
     */
    public function __construct(
        string $name,
        array $data = [],
        array $arguments = []
    ) {
        $this->name       = $name;
        $this->data       = $data;
        $this->arguments  = $arguments;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get argument by key.
     *
     * @param string $key Key
     *
     * @throws \InvalidArgumentException if key is not found
     *
     * @return mixed Contents of array key
     */
    public function getArgument(string $key)
    {
        if ($this->hasArgument($key)) {
            return $this->arguments[$key];
        }

        throw new \InvalidArgumentException(sprintf('Argument "%s" not found.', $key));
    }

    /**
     * Add argument to event.
     *
     * @param string $key   Argument name
     * @param mixed  $value Value
     *
     * @return $this
     */
    public function setArgument(string $key, $value): ResultDataInterface
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    /**
     * Has argument.
     *
     * @param string $key Key of arguments array
     */
    public function hasArgument(string $key): bool
    {
        return \array_key_exists($key, $this->arguments);
    }
}
