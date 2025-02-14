<?php

namespace GoalioMailService\Mail\View;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\View\Renderer\PhpRenderer;

class MailPhpRendererFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $renderer = new PhpRenderer();

        $helperManager = $serviceLocator->get('ViewHelperManager');
        $resolver      = $serviceLocator->get('ViewResolver');

        $renderer->setHelperPluginManager($helperManager);
        $renderer->setResolver($resolver);

        $application = $serviceLocator->get('Application');
        $event       = $application->getMvcEvent();

        if($event !== null) {
            $model = $serviceLocator->get('Application')->getMvcEvent()->getViewModel();

            $modelHelper = $renderer->plugin('view_model');
            $modelHelper->setRoot($model);
        }

        return $renderer;
    }
}