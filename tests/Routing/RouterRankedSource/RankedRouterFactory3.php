<?php

namespace Zenify\ModularRouting\Tests\Routing\RouterRankedSource;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Zenify\ModularRouting\Routing\RankedRouterFactoryInterface;


class RankedRouterFactory3 implements RankedRouterFactoryInterface
{

	/**
	 * {@inheritdoc}
	 */
	public function create()
	{
		$router = new RouteList('ThirdModule');
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}


	/**
	 * {@inheritdoc}
	 */
	public function getRank()
	{
		return 10;
	}

}
