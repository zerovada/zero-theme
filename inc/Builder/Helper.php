<?php
declare( strict_types=1 );

namespace Zero\Builder;

/**
 * Helper for builder-related constants.
 */
class Helper {
    /**
     * Maximum number of extra header menus that can be registered.
     * Adjust this number as needed in future sprints.
     *
     * @var int
     */
    public static int $component_limit = 5;
}
