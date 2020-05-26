<?php

declare(strict_types=1);

namespace PoP\ApplicationWP\Conditional\Posts;

use PoP\ApplicationWP\Component;
use PoP\Root\Component\YAMLServicesTrait;

/**
 * Initialize component
 */
class ConditionalComponent
{
    use YAMLServicesTrait;

    public static function initialize(bool $skipSchema = false): void
    {
        self::initYAMLServices(Component::$COMPONENT_DIR, '/Conditional/Posts');
    }
}
