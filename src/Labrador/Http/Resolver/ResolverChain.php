<?php

/**
 * Allows for a series of HandlerResolver to attempt to resolve a given $handler;
 * the first HandlerResolver in the chain that returns a callable wins.
 * 
 * @license See LICENSE in source root
 */

namespace Labrador\Http\Resolver;

use Labrador\Http\HandlerResolver;

class ResolverChain implements HandlerResolver {

    /**
     * @property HandlerResolver[]
     */
    private $resolvers = [];

    /**
     * @param mixed $handler
     * @return callable|false
     */
    function resolve($handler) {
        /** @var HandlerResolver $resolver */
        foreach ($this->resolvers as $resolver) {
            $cb = $resolver->resolve($handler);
            if (is_callable($cb)) {
                return $cb;
            }
        }

        return false;
    }

    /**
     * @param HandlerResolver $resolver
     * @return $this
     */
    function add(HandlerResolver $resolver) {
        $this->resolvers[] = $resolver;
        return $this;
    }

}
