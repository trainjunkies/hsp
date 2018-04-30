# Trainjunkies - HSP

[![Build Status](https://travis-ci.org/trainjunkies/hsp.svg?branch=master)](https://travis-ci.org/trainjunkies/hsp)

PHP API to consume National Rail Historical Services Performance API.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. Also instructions on consuming the API in your project.

### Installation

To consume the NRE Data Feeds in your project, require the package via composer.

```
composer.phar require trainjunkies/hsp
```

To query the API configure the `Client` with your own API credentials from [National Rail Datafeeds][National Rail Datafeeds]

```
<?php

include __DIR__ . '/vendor/autoload.php';

$client = \Trainjunkies\Hsp\ClientFactory::create(
    'USERNAME',
    'PASSWORD'
);

try {
    $result = $client->getServiceDetails('SOME-RID-VALUE');
} catch (Exception $e) {
    die($e->getMessage());
}
```

### Development / Testing installation

For development you will require your flavour of [Docker][docker] and [Git][git] installed.

```
git clone git@github.com:trainjunkies/hsp.git
```

And in the directory where you'e cloned the project...

```
docker-compose up -d --build
```

This will provision the `hsp` container, installing required PHP libraries & Xdebug.

## Running the tests

Explain how to run the automated tests for this system

### Unit/Spec tests

```
docker-compose run --rm hsp bin/phpspec r
```

### Integration suite

To query a valid Service Details request against the HSP API

```
docker-compose run --rm hsp bin/phpunit
```

### Code style checker

For consistency...

```
docker-compose run --rm hsp bin/phpcs --standard=PSR2 src/
```

### Debugging with Xdebug

Xdebug is enabled within the container by default with the settings specified in `docker-compose.yml`

By default Xdebug will attempt to connect to `10.254.254.254` on port ` 9000`. To facilitate this you can alias `127.0.0.1` to this address using the below instructions.

#### DockerForMac

```
sudo ifconfig lo0 alias 10.254.254.254
```

#### Ubuntu

```
sudo ifconfig lo:1 10.254.254.254 up
```

You should now be able to use Xdebug by setting PHPStorm to listen for connections.

**NOTE:** The path mapping should be `/var/www` to your project directory.
**NOTE:** Further configuration to your IDE might be required to listen to incomming Xdebug connections. With the below example in PHPStorm a "server" needs to be defined for `trainjunkies_hsp_dev_container`

```
docker-compose run --rm -e PHP_IDE_CONFIG="serverName=trainjunkies_hsp_dev_container" hsp bin/phpspec r spec/Trainjunkies/Hsp/ClientSpec.php 
```

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Ben McManus**  - [bennoislost](https://github.com/bennoislost)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

[National Rail Datafeeds]: https://datafeeds.nationalrail.co.uk/#/user "National Rail Datafeeds"
[Git]: https://git-scm.com/downloads	"Git"
[Docker]: https://www.docker.com/community-edition#/download	"Docker"
