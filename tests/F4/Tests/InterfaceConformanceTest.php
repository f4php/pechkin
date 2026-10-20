<?php

declare(strict_types=1);

namespace F4\Tests;

use F4\Pechkin\{
    Bot,
    BotInterface,
    Client,
    ClientInterface,
    Flow,
    RouterInterface,
};
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;

use function array_map;
use function preg_match_all;
use function var_export;

/**
 * PHP only enforces that an implementation is *compatible* with its interface:
 * it lets parameter names differ, lets extra optional parameters be appended
 * and lets defaults differ. Callers using named arguments or programming
 * against the interface then silently get a different API. These tests require
 * the implementation and the interface to declare identical signatures.
 */
final class InterfaceConformanceTest extends TestCase
{
    /** @return array<string, array{class-string, class-string}> */
    public static function implementationProvider(): array
    {
        return [
            'Client' => [Client::class, ClientInterface::class],
            'Bot' => [Bot::class, BotInterface::class],
            'Flow' => [Flow::class, RouterInterface::class],
        ];
    }

    /** @return array<string, array{class-string, class-string, string}> */
    public static function interfaceMethodProvider(): array
    {
        $cases = [];
        foreach (self::implementationProvider() as [$class, $interface]) {
            foreach ((new ReflectionClass($interface))->getMethods() as $method) {
                $cases["{$class}::{$method->name}"] = [$class, $interface, $method->name];
            }
        }
        return $cases;
    }

    /** @return array<string, array{string}> */
    public static function clientInterfaceMethodProvider(): array
    {
        $cases = [];
        foreach ((new ReflectionClass(ClientInterface::class))->getMethods() as $method) {
            $cases[$method->name] = [$method->name];
        }
        return $cases;
    }

    #[DataProvider('implementationProvider')]
    public function testClassImplementsInterface(string $class, string $interface): void
    {
        $this->assertTrue((new ReflectionClass($class))->implementsInterface($interface));
    }

    #[DataProvider('interfaceMethodProvider')]
    public function testMethodSignatureMatchesInterface(string $class, string $interface, string $methodName): void
    {
        $expected = self::describeMethod(new ReflectionMethod($interface, $methodName));
        $actual = self::describeMethod(new ReflectionMethod($class, $methodName));
        $this->assertSame($expected, $actual, "{$class}::{$methodName}() must declare exactly the signature of {$interface}::{$methodName}()");
    }

    public function testEveryPublicClientMethodIsDeclaredInClientInterface(): void
    {
        $interface = new ReflectionClass(ClientInterface::class);
        $undeclared = [];
        foreach ((new ReflectionClass(Client::class))->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->isConstructor() || $method->isStatic()) {
                continue;
            }
            if (!$interface->hasMethod($method->name)) {
                $undeclared[] = $method->name;
            }
        }
        $this->assertSame([], $undeclared, 'Public Client methods missing from ClientInterface');
    }

    #[DataProvider('clientInterfaceMethodProvider')]
    public function testClientInterfaceDocblockParamsMatchSignature(string $methodName): void
    {
        $method = new ReflectionMethod(ClientInterface::class, $methodName);
        $doc = $method->getDocComment();
        $this->assertIsString($doc, "ClientInterface::{$methodName}() has no docblock");
        preg_match_all('/@param\s+\S+\s+\$(\w+)/', $doc, $matches);
        $this->assertSame(
            array_map(fn(ReflectionParameter $p) => $p->name, $method->getParameters()),
            $matches[1],
            "ClientInterface::{$methodName}() @param tags must list every parameter, in order",
        );
    }

    /** @return list<string> */
    private static function describeMethod(ReflectionMethod $method): array
    {
        $description = array_map(
            fn(ReflectionParameter $p) => ($p->getType() ?? 'mixed')
                . ($p->isVariadic() ? ' ...' : ' ')
                . '$' . $p->name
                . ($p->isDefaultValueAvailable() ? ' = ' . var_export($p->getDefaultValue(), true) : ''),
            $method->getParameters(),
        );
        $description[] = 'return: ' . ($method->getReturnType() ?? 'none');
        return $description;
    }
}
