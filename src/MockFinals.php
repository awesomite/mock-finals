<?php

declare(strict_types=1);

/*
 * This file is part of the awesomite/mock-finals package.
 *
 * (c) Bartłomiej Krukowski <bartlomiej@krukowski.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Awesomite\MockFinals;

/**
 * @internal
 */
final class MockFinals
{
    /**
     * @var callable[]
     */
    private static $loaders = [];

    public function __invoke(string $className): void
    {
        foreach (self::$loaders as $loader) {
            \call_user_func($loader, $className);
            if (\class_exists($className, false)) {
                Definaler::definal($className);

                break;
            }
        }
    }

    public static function enable(): void
    {
        foreach (\spl_autoload_functions() as $fn) {
            \spl_autoload_unregister($fn);
            self::$loaders[] = $fn;
        }

        \spl_autoload_register(new static(), true, true);
        self::definalExisting();
    }

    private static function definalExisting(): void
    {
        foreach (\get_declared_classes() as $className) {
            $class = new \ReflectionClass($className);
            if (!$class->isInternal()) {
                Definaler::definal($className);
            }
        }
    }
}
