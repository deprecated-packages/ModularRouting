<?php

/**
 * This file is part of Zenify.
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Zenify\ModularRouting\DI;

use Nette\Application\IRouter;
use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Nette\DI\Statement;
use Nette\Reflection\ClassType;
use Zenify\ModularRouting\Routing\RankedRouterFactoryInterface;
use Zenify\ModularRouting\Routing\RouterFactoryInterface;


class ModularRoutingExtension extends CompilerExtension
{

	/**
	 * @var int
	 */
	const DEFAULT_RANK = 500;


	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();

		$routerFactories = [];
		foreach ($builder->findByType(RouterFactoryInterface::class) as $name => $routerService) {
			$routerFactories[$name] = $this->getRouterRank($routerService);
		}

		asort($routerFactories);
		$router = $builder->getDefinition($builder->getByType(IRouter::class));
		foreach ($routerFactories as $routeFactory => $rank) {
			$factory = new Statement(['@' . $routeFactory, 'create']);
			$router->addSetup('offsetSet', [NULL, $factory]);
		}
	}


	/**
	 * @return int
	 */
	public function getRouterRank(ServiceDefinition $routerFactory)
	{
		$class = $routerFactory->getClass();

		/** @var RankedRouterFactoryInterface $menuItemsProvider */
		$menuItemsProvider = ClassType::from($class)->newInstanceWithoutConstructor();
		if ($menuItemsProvider instanceof RankedRouterFactoryInterface) {
			return $menuItemsProvider->getRank();

		} else {
			return self::DEFAULT_RANK;
		}
	}

}
