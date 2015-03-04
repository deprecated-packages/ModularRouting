<?php

namespace Zenify\ModularRouting\Tests\DI;

use Nette\Application\Routers\RouteList;
use Nette\DI\Compiler;
use Nette\DI\ContainerBuilder;
use Nette\DI\ServiceDefinition;
use PHPUnit_Framework_TestCase;
use Zenify\ModularRouting\DI\ModularRoutingExtension;
use Zenify\ModularRouting\Tests\Routing\RouterFactory;


class ModularRoutingExtensionTest extends PHPUnit_Framework_TestCase
{

	public function testRoutersBinding()
	{
		$extension = $this->createExtension();
		$builder = $extension->getContainerBuilder();

		// simulates ApplicationExtension
		$netteRouter = $builder->addDefinition('netteRouter')
			->setClass(RouteList::class);

		// add our router
		$builder->addDefinition('ourRouter')
			->setClass(RouterFactory::class);

		$builder->prepareClassList();
		$extension->beforeCompile();

		/** @var ServiceDefinition $netteRouter */
		$this->assertCount(1, $netteRouter->getSetup());
		$setup = $netteRouter->getSetup();

		$this->assertSame(
			['@Zenify\ModularRouting\Tests\Routing\RouterFactory', 'create'],
			$setup[0]->arguments[1]->entity
		);
	}


	/**
	 * @return ModularRoutingExtension
	 */
	private function createExtension()
	{
		$extension = new ModularRoutingExtension;
		$extension->setCompiler(new Compiler(new ContainerBuilder), 'compiler');
		return $extension;
	}

}
