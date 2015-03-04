<?php

/**
 * This file is part of Zenify.
 *
 * For the full copyright and license information, please view
 * the file LICENSE that was distributed with this source code.
 */

namespace Zenify\ModularRouting\Routing;

use Nette\Application\IRouter;


interface RouterFactoryInterface
{

	/**
	 * @return IRouter
	 */
	function create();

}
