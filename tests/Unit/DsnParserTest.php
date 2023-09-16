<?php

/*
 * This file is part of the ixnode/php-dsn-parser project.
 *
 * (c) Björn Hempel <https://www.hempel.li/>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Ixnode\PhpDsnParser\Tests\Unit;

use Ixnode\PhpDsnParser\DsnParser;
use PHPUnit\Framework\TestCase;

/**
 * Class DsnParserTest
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 0.1.0 (2023-09-16)
 * @since 0.1.0 (2023-09-16) First version.
 * @link DsnParser
 */
final class DsnParserTest extends TestCase
{
    /**
     * Test wrapper.
     *
     * @dataProvider dataProvider
     *
     * @test
     * @testdox $number) Test DsnParser:getParsed
     * @param int $number
     * @param string $dsn
     * @param array<string, string|null> $expected
     */
    public function wrapper(int $number, string $dsn, array $expected): void
    {
        /* Arrange */

        /* Act */
        $dsnParser = new DsnParser($dsn);

        /* Assert */
        $this->assertIsNumeric($number); // To avoid phpmd warning.
        $this->assertSame($expected, $dsnParser->getParsed());
    }

    /**
     * Data provider.
     *
     * @return array<int, mixed>
     */
    public function dataProvider(): array
    {
        $number = 0;

        return [
            [++$number, 'smtp://host:1025', [
                'protocol' => 'smtp',
                'user' => null,
                'password' => null,
                'host' => 'host',
                'port' => 1025,
                'options' => null,
            ], ],
            [++$number, 'smtp://abc:xyz@test:123', [
                'protocol' => 'smtp',
                'user' => 'abc',
                'password' => 'xyz',
                'host' => 'test',
                'port' => 123,
                'options' => null,
            ], ],
            [++$number, 'smtp://suserweb:S22jD7Po%.,/zu34j@mail.domain.tld:25', [
                'protocol' => 'smtp',
                'user' => 'suserweb',
                'password' => 'S22jD7Po%.,/zu34j',
                'host' => 'mail.domain.tld',
                'port' => 25,
                'options' => null,
            ], ],
            [++$number, 'smtp://suserweb:S22jD7Po%.,/zu34j@mail.domain.tld:25?verify_peer=0', [
                'protocol' => 'smtp',
                'user' => 'suserweb',
                'password' => 'S22jD7Po%.,/zu34j',
                'host' => 'mail.domain.tld',
                'port' => 25,
                'options' => 'verify_peer=0',
            ], ],
        ];
    }
}
