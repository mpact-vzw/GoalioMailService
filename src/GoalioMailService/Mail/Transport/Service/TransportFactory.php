<?php
namespace GoalioMailService\Mail\Transport\Service;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class TransportFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {

        /** @var TransportOptions $options */
        $config = $container->get('config');
        $options = $config['goaliomailservice'];

        // Backwards compatibility with old config files
        if(isset($options['transport_class']) && !isset($options['type'])) {
            $options['type'] = $options['transport_class'];
        }

        if(isset($options['transport_options']) && !isset($options['options'])) {
            $options['options'] = $options['transport_options'];
        }

        return \Laminas\Mail\Transport\Factory::create($options);
    }
}
