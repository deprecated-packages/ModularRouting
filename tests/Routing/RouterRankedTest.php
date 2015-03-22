<?php

namespace Zenify\ModularRouting\Tests\Routing;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\DI\Container;
use PHPUnit_Framework_TestCase;
use Zenify\ModularRouting\Tests\ContainerFactory;


class RouterRankedTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Container
	 */
	private $container;

	/**
	 * @var RouteList
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


	public function testOrder()
	{
		$this->assertSame('FirstModule:', $this->router[0]->module);
		$this->assertSame('ThirdModule:', $this->router[1]->module);
		$this->assertSame('SecondModule:', $this->router[2]->module);
	}

}
