<?php

/**
 *
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Labrador\Http\Test\HandlerResolver;

use Cspray\Labrador\Http\HandlerResolver\ResponseResolver;
use PHPUnit_Framework_TestCase as UnitTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseResolverTest extends UnitTestCase {

    function handlerReturnsFalseProvider() {
        return [
            ['string'],
            [1],
            [null],
            [1.1],
            [[]],
            [new \stdClass()],
            [true],
            [false]
        ];
    }

    /**
     * @dataProvider handlerReturnsFalseProvider
     */
    function testHandlerNotResponseReturnsFalse($handler) {
        $resolver = new ResponseResolver();
        $this->assertFalse($resolver->resolve(Request::create('/'), $handler));
    }

    function testHandlerResponseReturnsCallback() {
        $resolver = new ResponseResolver();
        $response = new Response();

        $controller = $resolver->resolve(Request::create('/'), $response);
        $this->assertTrue(is_callable($controller));
        $this->assertSame($response, $controller());
    }

}