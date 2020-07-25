--FILE--
<?php

function isFinal(string $className): bool
{
    return (new \ReflectionClass($className))->isFinal();
}

function printClassInfo(string $className): void
{
    echo \sprintf(
        'Class `%s` %s final',
        $className,
        isFinal($className) ? 'is' : "isn't"
    ), "\n";
}

final class MyFinalClass
{
}

printClassInfo(MyFinalClass::class);

echo "Register class autoloader\n";
require \implode(\DIRECTORY_SEPARATOR, [__DIR__, '..', '..', 'vendor', 'autoload.php']);

printClassInfo(MyFinalClass::class);

?>
--EXPECT--
Class `MyFinalClass` is final
Register class autoloader
Class `MyFinalClass` isn't final
