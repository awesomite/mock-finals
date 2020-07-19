[![Build Status](https://github.com/awesomite/mock-finals/workflows/Tests/badge.svg?branch=master)](https://github.com/awesomite/mock-finals/actions?query=workflow%3ATests)

# Mock Finals

Mock final classes and methods in your tests. Library overrides existing class loaders and removes all `final`
occurrences in runtime using [`uopz_flags`](https://www.php.net/manual/en/function.uopz-flags.php).

## Installation

```
composer require --dev awesomite/mock-finals
```

## Requirements

* PHP ^7.1
* [uopz](https://www.php.net/manual/en/book.uopz.php) (`pecl install uopz`)

## Example


```php
class Greeter
{
    final public function sayHello(): string
    {
        return 'hello';
    }
}

class MyTest extends \PHPUnit\Framework\TestCase
{
    public function testSayHello(): void
    {
        $mock = $this->getMockBuilder(Greeter::class)->getMock();
        $mock
            ->expects($this->once())
            ->method('sayHello')
            ->willReturn('goodbye')
        ;
        $this->assertSame('goodbye', $mock->sayHello());
    }
}
```
