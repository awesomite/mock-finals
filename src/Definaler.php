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
final class Definaler
{
    public static function definal(string $class): void
    {
        self::definalClass($class);

        foreach ((new \ReflectionClass($class))->getMethods(\ReflectionMethod::IS_FINAL) as $method) {
            self::definalMethod($class, $method->getName());
        }
    }

    private static function definalClass(string $class): void
    {
        /*
         * It is required to add
         *   "& ~(\ZEND_ACC_PUBLIC | \ZEND_ACC_PROTECTED | \ZEND_ACC_PRIVATE | \ZEND_ACC_STATIC)"
         * otherwise code can throw the following exceptions:
         *
         *   - RuntimeException: attempt to set public, private or protected on class entry %s, not allowed in %s:%d
         *   - RuntimeException: attempt to set static on class entry %s, not allowed in %s:%d
         */
        \uopz_flags(
            $class,
            '',
            \uopz_flags($class, '') & ~\ZEND_ACC_FINAL & ~(\ZEND_ACC_PUBLIC | \ZEND_ACC_PROTECTED | \ZEND_ACC_PRIVATE | \ZEND_ACC_STATIC)
        );
    }

    private static function definalMethod(string $class, string $function): void
    {
        \uopz_flags($class, $function, \uopz_flags($class, $function) & ~\ZEND_ACC_FINAL);
    }
}
