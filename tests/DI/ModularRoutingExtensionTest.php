<?php

namespace Zenify\ModularRouting\Tests\DI;

use Nette\Application\IRouter;
use Nette\Application\Routers\RouteList;
use Nette\DI\Compiler;
use Nette\DI\ContainerBuilder;
use Nette\DI\ServiceDefinition;
use PHPUnit_Framework_TestCase;
use Zenify\ModularRouting\DI\ModularRoutingExtension;
use Zenify\ModularRouting\Tests\Routing\RouterSource\RouterFactory;


class ModularRoutingExtensionTest extends PHPUnit_Framework_TestCase
{

	public function testRoutersBinding()
	{
		$extension = $this->createExtension();
		$builder = $extension->getContainerBuilder();

		// add our router
		$builder->addDefinition('ourRouter')
			->setClass(RouterFactory::class);

		$builder->prepareClassList();
		$extension->beforeCompile();

		/** @var ServiceDefinition $netteRouter */
		$netteRouter = $builder->findByType(IRouter::class)['netteRouter'];
		$this->assertCount(1, $netteRouter->getSetup());
		$this->assertSame(
			['@ourRouter', 'create'],
			$netteRouter->getSetup()[0]->arguments[1]->entity
		);
	}


	/**
	 * @return ModularRoutingExtension
	 */
	private function createExtension()
	{
		$builder = new ContainerBuilder;
		// simulates ApplicationExtension
		$builder->addDefinition('netteRouter')
			->setClass(RouteList::class);

		$extension = new ModularRoutingExtension;
		$extension->setCompiler(new Compiler($builder), 'compiler');
		return $extension;
	}

}
