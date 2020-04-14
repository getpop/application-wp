<?php

declare(strict_types=1);

namespace PoP\ApplicationWP;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\ComponentModel\Container\ContainerBuilderUtils;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    public static $COMPONENT_DIR;
    use YAMLServicesTrait;
    // const VERSION = '0.1.0';

    /**
     * Initialize services
     */
    public static function init()
    {
        parent::init();
        self::$COMPONENT_DIR = dirname(__DIR__);
        self::initYAMLServices(self::$COMPONENT_DIR);

        if (class_exists('\PoP\Posts\Component')) {
            \PoP\ApplicationWP\Conditional\Posts\ConditionalComponent::init();
        }
    }

    /**
     * Boot component
     *
     * @return void
     */
    public static function beforeBoot()
    {
        parent::beforeBoot();

        // Initialize classes
        ContainerBuilderUtils::instantiateNamespaceServices(__NAMESPACE__ . '\\LooseContracts');
    }
}
