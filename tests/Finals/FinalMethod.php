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

namespace Awesomite\MockFinals\Finals;

/**
 * @internal
 */
class FinalMethod
{
    final public function sayHello(): string
    {
        return 'hello';
    }
}
