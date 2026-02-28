<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure;
use InvalidArgumentException;
use RuntimeException;
use Throwable;
use F4\Pechkin\{
    Context,
    ExceptionHandlerTrait,
};

abstract class AbstractRoutable
{
    use ExceptionHandlerTrait;
    protected const int PRIORITY_HIGHEST = 30;
    protected const int PRIORITY_HIGHER = 20;
    protected const int PRIORITY_HIGH = 10;
    protected const int PRIORITY_NORMAL = 0;
    protected const int PRIORITY_LOW = -10;
    protected const int PRIORITY_LOWEST = -20;
    protected ?Closure $middleware = null;
    final protected function __construct(
        protected readonly Closure $matcher,
        protected readonly Closure $handler,
        public readonly int $priority = self::PRIORITY_NORMAL,
    ) {}
    public function before(Closure $middleware, bool $replace = false): static
    {
        if ($this->middleware && !$replace) {
            throw new InvalidArgumentException(message: 'Middleware already set');
        }
        $this->middleware = $middleware;
        return $this;
    }
    public function checkMatch(Context $context): bool
    {
        return ($this->matcher)($context);
    }
    public function invoke(Context $context): mixed
    {
        try {
            if ($this->middleware) {
                $context = $this->invokeMiddleware($context);
            }
            return ($this->handler->bindTo($this))($context);
        } catch (Throwable $e) {
            return $this->processException($e, $context);
        }
    }
    protected function invokeMiddleware(Context $context): Context
    {
        if (!$this->middleware) {
            throw new RuntimeException(message: 'Middleware not set');
        }
        return match( ($result = ($this->middleware)($context)) instanceof Context) {
            true => $result,
            default => $context,
        };
    }
}
