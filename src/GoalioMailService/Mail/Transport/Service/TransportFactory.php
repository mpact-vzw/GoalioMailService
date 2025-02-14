<?php
namespace GoalioMailService\Mail\Transport\Service;

use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\ServiceManager\FactoryInterface;

class TransportFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {

        /** @var TransportOptions $options */
        $config = $serviceLocator->get('config');
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
