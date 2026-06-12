#!/usr/bin/env php
<?php

declare(strict_types=1);

// Downloads the Telegram Bot API documentation and splits it into one
// markdown file per DataType (docs/datatypes) and per method (docs/methods)

require_once __DIR__ . '/../vendor/autoload.php';

use F4\Pechkin\Utility\DocumentationParser,
    F4\Pechkin\Utility\SectionKind,
    GuzzleHttp\Client as Guzzle
;

$targetDirectories = [
    SectionKind::DataType->name => __DIR__ . '/../docs/datatypes',
    SectionKind::Method->name => __DIR__ . '/../docs/methods',
];

try {
    $html = (string) new Guzzle()->get(DocumentationParser::BASE_URL, ['connect_timeout' => 60])->getBody();
    $sections = new DocumentationParser()->parse($html);
    if ($sections === []) {
        throw new RuntimeException('No sections parsed, page layout may have changed');
    }
    $counts = [];
    foreach ($targetDirectories as $kind => $directory) {
        is_dir($directory) || mkdir($directory, recursive: true);
        foreach (glob($directory . '/*.md') ?: [] as $staleFile) {
            unlink($staleFile);
        }
        $counts[$kind] = 0;
    }
    foreach ($sections as $section) {
        file_put_contents(sprintf('%s/%s.md', $targetDirectories[$section->kind->name], $section->name), $section->markdown);
        $counts[$section->kind->name]++;
    }
    printf("%d datatypes, %d methods written\n", $counts[SectionKind::DataType->name], $counts[SectionKind::Method->name]);
    exit(0);
}
catch (Throwable $e) {
    fwrite(STDERR, sprintf("Error: %s\n", $e->getMessage()));
    exit(1);
}
