<?php
namespace GoalioMailService\Mail\Options\Service;

use GoalioMailService\Mail\Options\TransportOptions;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TransportOptionsFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('Config');
        return new TransportOptions(isset($config['goaliomailservice']) ? $config['goaliomailservice'] : array());
    }

}