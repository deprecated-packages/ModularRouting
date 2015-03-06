<?php

namespace Zenify\ModularRouting\Tests\Routing;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Zenify\ModularRouting\Routing\RouterFactoryInterface;


class RouterFactory implements RouterFactoryInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function create()
	{
		$router = new RouteList;
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}

}
