<?php

declare(strict_types=1);

namespace F4\Pechkin;

use Closure,
    InvalidArgumentException,
    Throwable,
    ReflectionFunction
;

use F4\Pechkin\{
    Context,
};

use function is_subclass_of;

trait ExceptionHandlerTrait
{
    protected array $exceptionHandlers = [];
    public function addExceptionHandler(string $exceptionClassName, Closure $exceptionHandler): static
    {
        if (!is_subclass_of(object_or_class: $exceptionClassName, class: Throwable::class, allow_string: true)) {
            throw new InvalidArgumentException(message: "{$exceptionClassName} is not throwable");
        }
        if (isset($this->exceptionHandlers[$exceptionClassName])) {
            throw new InvalidArgumentException(message: "{$exceptionClassName} handler is already set");
        }
        $this->exceptionHandlers[$exceptionClassName] = $exceptionHandler;
        return $this;
    }
    public function getExceptionHandlers(?string $exceptionClass = null): array
    {
        return match (null !== $exceptionClass) {
            true => $this->exceptionHandlers[$exceptionClass] ?? [],
            default => $this->exceptionHandlers,
        };
    }
    public function onException(string $exceptionClassName, Closure $exceptionHandler): static
    {
        return $this->addExceptionHandler(exceptionClassName: $exceptionClassName, exceptionHandler: $exceptionHandler);
    }
    public function processException(Throwable $exception, Context $context): mixed
    {
        foreach ($this->exceptionHandlers as $className => $handler) {
            if ($exception instanceof $className) {
                $handlerReflection = new ReflectionFunction($handler);
                $handlerThis = $handlerReflection->getClosureThis();
                return $handler->call($handlerThis, $exception, $context);
            }
        }
        throw $exception;
    }
}
