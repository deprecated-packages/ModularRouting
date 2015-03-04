<?php

namespace Zenify\ModularRouting\Tests\Routing;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\DI\Container;
use PHPUnit_Framework_TestCase;
use Zenify\ModularRouting\Tests\ContainerFactory;


class RouterTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @var IRouter
	 */
	private $router;


	public function __construct()
	{
		$this->container = (new ContainerFactory)->create();
	}


	protected function setUp()
	{
		$this->router = $this->container->getByType(IRouter::class);
	}


	public function test()
	{
		$routeList = $this->router[0];
		/** @var Route[] $routeList */
		$baseRoute = $routeList[0];

		$this->assertInstanceOf(Route::class, $baseRoute);
		$this->assertSame('<presenter>/<action>[/<id>]', $baseRoute->getMask());
	}

}
