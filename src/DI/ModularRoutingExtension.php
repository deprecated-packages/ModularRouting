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
use Nette\DI\Statement;
use Zenify\ModularRouting\Routing\RouterFactoryInterface;


class ModularRoutingExtension extends CompilerExtension
{

	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();

		$router = $builder->getDefinition($builder->getByType(IRouter::class));
		foreach ($builder->findByType(RouterFactoryInterface::class) as $routerService) {
			$factory = new Statement(['@' . $routerService->getClass(), 'create']);
			$router->addSetup('offsetSet', [NULL, $factory]);
		}
	}

}
