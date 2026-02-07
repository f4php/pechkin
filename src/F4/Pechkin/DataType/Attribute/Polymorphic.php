<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute,
    Closure,
    InvalidArgumentException
;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
final readonly class Polymorphic
{
    public function __construct(
        public readonly array $map = [],
        public readonly string $discriminator = 'type',
        protected readonly ?Closure $createFromArray = null,
    ) {}

    public function createFromArray(array $data): mixed
    {
        if($this->createFromArray) {
            if(null === ($result = ($this->createFromArray)($data))) {
                throw new InvalidArgumentException('Failed to determine custom polymorphic target');
            }
            return $result;
        }
        if(!$type = $data[$this->discriminator] ?? null) {
            throw new InvalidArgumentException("Cannot determine value of discriminator");
        }
        if(!$target = $this->map[$type] ?? null) {
            throw new InvalidArgumentException("Cannot determine polymorphic target");
        }
        unset($data[$this->discriminator]);
        return match ($target instanceof Polymorphic) {
            true => $target->createFromArray($data),
            default => $target::fromArray($data),
        };
    }
}
