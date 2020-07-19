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

use Awesomite\MockFinals\Finals\FinalClass;
use Awesomite\MockFinals\Finals\FinalMethod;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class MainTest extends TestCase
{
    public function testFinalClass(): void
    {
        $mock = $this->getMockBuilder(FinalClass::class)->getMock();
        $this->assertInstanceOf(FinalClass::class, $mock);
    }

    public function testFinalMethod(): void
    {
        $mock = $this->getMockBuilder(FinalMethod::class)->getMock();
        $mock
            ->expects($this->once())
            ->method('sayHello')
            ->willReturn('goodbye')
        ;
        $this->assertSame('goodbye', $mock->sayHello());
    }
}
