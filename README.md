# Zenify/ModularRouting

[![Build Status](https://img.shields.io/travis/Zenify/ModularRouting.svg?style=flat-square)](https://travis-ci.org/Zenify/ModularRouting)
[![Quality Score](https://img.shields.io/scrutinizer/g/Zenify/ModularRouting.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/ModularRouting)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/Zenify/ModularRouting.svg?style=flat-square)](https://scrutinizer-ci.com/g/Zenify/ModularRouting)
[![Downloads this Month](https://img.shields.io/packagist/dm/zenify/modular-routing.svg?style=flat-square)](https://packagist.org/packages/zenify/modular-routing)
[![Latest stable](https://img.shields.io/packagist/v/zenify/modular-routing.svg?style=flat-square)](https://packagist.org/packages/zenify/modular-routing)


## Installation

Install the latest version via composer:

```sh
$ composer require zenify/modular-routing
```

Register the extension in `config.neon`:

```yaml
extensions:
	- Zenify\ModularRouting\DI\ModularRoutingExtension
```


## Usage

Create class implementing `Zenify\ModularRouting\Routing\RouterFactoryInterface`:
 
```php
namespace App\Modules\SomeModule\Routing;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Zenify\ModularRouting\Routing\RouterFactoryInterface;

class SomeModuleRouterFactory implements RouterFactoryInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function create()
	{
		$router = new RouteList('SomeModule');
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}
}
```
 
 
And register it to `config.neon`:

```yaml
services:
	- App\Modules\SomeModule\Routing\SomeModuleRouterFactory
```

That's it!



## Testing

```sh
$ phpunit
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
