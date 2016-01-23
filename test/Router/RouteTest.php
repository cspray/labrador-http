<?php

/**
 * 
 * @license See LICENSE in source root
 * @version 1.0
 * @since   1.0
 */

namespace Cspray\Labrador\Http\Test\Router;

use Cspray\Labrador\Http\Router\Route;
use Cspray\Labrador\Http\Test\Stub\ToStringHandlerObject;
use Cspray\Labrador\Http\Test\Stub\ToStringHandlerObjectWithMethod;
use PHPUnit_Framework_TestCase as UnitTestCase;

class RouteTest extends UnitTestCase {

    function routeProvider() {
        return [
            [new Route('/handler-string', 'GET', 'handler_name'), "GET\t/handler-string\t\thandler_name"],
            [new Route('/handler-anon-func', 'POST', function() {}), "POST\t/handler-anon-func\t\tclosure{}"],
            [new Route('/handler-object', 'GET', new ToStringHandlerObject()), "GET\t/handler-object\t\tCspray\\Labrador\\Http\\Test\\Stub\\ToStringHandlerObject"],
            [new Route('/handler-callable-array', 'GET', [new ToStringHandlerObjectWithMethod(), 'doIt']), "GET\t/handler-callable-array\t\tCspray\\Labrador\\Http\\Test\\Stub\\ToStringHandlerObjectWithMethod::doIt"],
            [new Route('/handler-plain-array', 'GET', [1,2,3,4]), "GET\t/handler-plain-array\t\tArray(4)"]
        ];
    }

    /**
     * @dataProvider routeProvider
     */
    function testRouteToString($route, $expected) {
        $this->assertEquals($expected, (string) $route);
    }

}
