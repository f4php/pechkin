<?php

declare(strict_types=1);

namespace F4\Pechkin\Utility;

use F4\Pechkin\Utility\SectionKind;

readonly class DocumentationSection
{
    public function __construct(
        public readonly string $name,
        public readonly SectionKind $kind,
        public readonly string $markdown,
    )
    {}
}
