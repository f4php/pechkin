<?php

namespace F4\Pechkin\DataType\Attribute;

use Attribute,
    Closure,
    InvalidArgumentException
;

use F4\Pechkin\DataType\AbstractDataType;

use function sprintf;

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
            // Missing discriminator on (likely new) data: degrade to null rather
            // than aborting deserialization of the surrounding object.
            AbstractDataType::warn(sprintf('Pechkin: missing polymorphic discriminator "%s"; resolving to null', $this->discriminator));
            return null;
        }
        if(!$target = $this->map[$type] ?? null) {
            // Unknown subtype introduced by an upstream API change: degrade to
            // null and warn instead of throwing.
            AbstractDataType::warn(sprintf('Pechkin: unknown polymorphic discriminator "%s"; resolving to null', $type));
            return null;
        }
        unset($data[$this->discriminator]);
        return match ($target instanceof Polymorphic) {
            true => $target->createFromArray($data),
            default => $target::fromArray($data),
        };
    }
}
