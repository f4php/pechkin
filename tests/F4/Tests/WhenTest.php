<?php

declare(strict_types=1);

namespace F4\Tests;

use F4\Pechkin\When;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class WhenTest extends TestCase
{
    // any()

    public function testAnyMatchesEmptyString(): void
    {
        $this->assertTrue(When::any()->test(''));
    }

    public function testAnyMatchesAnyString(): void
    {
        $this->assertTrue(When::any()->test('hello world'));
        $this->assertTrue(When::any()->test('/start'));
        $this->assertTrue(When::any()->test('123'));
    }

    // equals()

    public function testEqualsMatchesExactString(): void
    {
        $this->assertTrue(When::equals('hello')->test('hello'));
    }

    public function testEqualsDoesNotMatchDifferentString(): void
    {
        $this->assertFalse(When::equals('hello')->test('world'));
    }

    public function testEqualsIsCaseSensitive(): void
    {
        $this->assertFalse(When::equals('Hello')->test('hello'));
    }

    public function testEqualsDoesNotMatchPartialString(): void
    {
        $this->assertFalse(When::equals('hello')->test('hello world'));
    }

    public function testEqualsMatchesEmptyString(): void
    {
        $this->assertTrue(When::equals('')->test(''));
    }

    public function testEqualsDoesNotMatchEmptyAgainstNonEmpty(): void
    {
        $this->assertFalse(When::equals('')->test('hello'));
    }

    // startsWith()

    public function testStartsWithMatchesExactPrefix(): void
    {
        $this->assertTrue(When::startsWith('/start')->test('/start'));
    }

    public function testStartsWithMatchesStringWithSuffix(): void
    {
        $this->assertTrue(When::startsWith('/start')->test('/start something'));
    }

    public function testStartsWithDoesNotMatchDifferentPrefix(): void
    {
        $this->assertFalse(When::startsWith('/start')->test('/stop'));
    }

    public function testStartsWithIsCaseSensitive(): void
    {
        $this->assertFalse(When::startsWith('/Start')->test('/start'));
    }

    public function testStartsWithEmptyPrefixMatchesAnything(): void
    {
        $this->assertTrue(When::startsWith('')->test('anything'));
        $this->assertTrue(When::startsWith('')->test(''));
    }

    public function testStartsWithMultibytePrefix(): void
    {
        $this->assertTrue(When::startsWith('привет')->test('привет мир'));
        $this->assertFalse(When::startsWith('привет')->test('мир привет'));
    }

    // matches()

    public function testMatchesReturnsTrueWhenPatternMatches(): void
    {
        $this->assertTrue(When::matches('/^\d+$/')->test('12345'));
    }

    public function testMatchesReturnsFalseWhenPatternDoesNotMatch(): void
    {
        $this->assertFalse(When::matches('/^\d+$/')->test('abc'));
    }

    public function testMatchesWorksWithAlternation(): void
    {
        $this->assertTrue(When::matches('/^(hello|world)$/')->test('hello'));
        $this->assertTrue(When::matches('/^(hello|world)$/')->test('world'));
        $this->assertFalse(When::matches('/^(hello|world)$/')->test('foo'));
    }

    public function testMatchesWorksWithCaseInsensitiveFlag(): void
    {
        $this->assertTrue(When::matches('/^hello$/i')->test('HELLO'));
    }

    // callback()

    public function testCallbackReturnsTrueWhenClosureReturnsTrue(): void
    {
        $this->assertTrue(When::callback(fn(string $s) => true)->test('anything'));
    }

    public function testCallbackReturnsFalseWhenClosureReturnsFalse(): void
    {
        $this->assertFalse(When::callback(fn(string $s) => false)->test('anything'));
    }

    public function testCallbackCastsReturnValueToBool(): void
    {
        $this->expectException(RuntimeException::class);
        $this->assertTrue(When::callback(fn(string $s) => 'truthy')->test('x'));
    }

    public function testCallbackWithCustomLogic(): void
    {
        $when = When::callback(fn(string $s) => strlen($s) > 5);
        $this->assertTrue($when->test('longstring'));
        $this->assertFalse($when->test('hi'));
    }
}
