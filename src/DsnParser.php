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

namespace Ixnode\PhpDsnParser;

use Ixnode\PhpDsnParser\Tests\Unit\DsnParserTest;

/**
 * Class DsnParser
 *
 * @author Björn Hempel <bjoern@hempel.li>
 * @version 0.1.0 (2023-09-16)
 * @since 0.1.0 (2023-09-16) First version.
 * @link DsnParserTest
 */
class DsnParser
{
    private const REGEXP_DSN = '~^([a-z]+)://(?:(?=.*@)([^:]+):([^@]+)@)?([^:]+):([0-9]+)(?:(?:\?)?(.+|))~';

    private const KEY_PROTOCOL = 'protocol';

    private const KEY_USER = 'user';

    private const KEY_PASSWORD = 'password';

    private const KEY_HOST = 'host';

    private const KEY_PORT = 'port';

    private const KEY_OPTIONS = 'options';

    /** @var array{protocol: string|null, user: string|null, password: string|null, host: string|null, port: int|null, options: string|null}|false $parsed */
    private readonly array|false $parsed;

    /**
     * @param string $dsn
     */
    public function __construct(protected string $dsn)
    {
        $this->parsed = $this->doParse($dsn);
    }

    /**
     * Parses the given dsn string.
     *
     * @param string $dsn
     * @return array{protocol: string|null, user: string|null, password: string|null, host: string|null, port: int|null, options: string|null}|false
     */
    private function doParse(string $dsn): array|false
    {
        $parts = [];

        if (!preg_match(self::REGEXP_DSN, $dsn, $parts)) {
            return false;
        }

        return [
            self::KEY_PROTOCOL => $this->getStringNull($parts, 1),
            self::KEY_USER => $this->getStringNull($parts, 2),
            self::KEY_PASSWORD => $this->getStringNull($parts, 3),
            self::KEY_HOST => $this->getStringNull($parts, 4),
            self::KEY_PORT => $this->getIntNull($parts, 5),
            self::KEY_OPTIONS => $this->getStringNull($parts, 6),
        ];
    }

    /**
     * Returns a part from given index (as string representation).
     *
     * @param array<int, string> $parts
     * @param int $index
     * @return string|null
     */
    private function getStringNull(array $parts, int $index): ?string
    {
        if (!array_key_exists($index, $parts)) {
            return null;
        }

        $part = $parts[$index];

        if (empty($part)) {
            return null;
        }

        return strval($part);
    }

    /**
     * Returns a part from given index (as string representation).
     *
     * @param array<int, string> $parts
     * @param int $index
     * @return int|null
     */
    private function getIntNull(array $parts, int $index): ?int
    {
        if (!array_key_exists($index, $parts)) {
            return null;
        }

        $part = $parts[$index];

        if (empty($part)) {
            return null;
        }

        return intval($part);
    }

    /**
     * Returns only one part of parsed data.
     *
     * @param string $key
     * @return string|int|null
     */
    private function getX(string $key): string|int|null
    {
        $parsed = $this->getParsed();

        if ($parsed === false) {
            return null;
        }

        if (!array_key_exists($key, $parsed)) {
            return null;
        }

        return $parsed[$key];
    }

    /**
     * Returns the parsed dsn representation.
     *
     * @return array{protocol: string|null, user: string|null, password: string|null, host: string|null, port: int|null, options: string|null}|false
     */
    public function getParsed(): array|false
    {
        return $this->parsed;
    }

    /**
     * Returns the protocol.
     *
     * @return string|null
     */
    public function getProtocol(): string|null
    {
        $value = $this->getX(self::KEY_PROTOCOL);

        if (is_null($value)) {
            return null;
        }

        return strval($value);
    }

    /**
     * Returns the user.
     *
     * @return string|null
     */
    public function getUser(): string|null
    {
        $value = $this->getX(self::KEY_USER);

        if (is_null($value)) {
            return null;
        }

        return strval($value);
    }

    /**
     * Returns the password.
     *
     * @return string|null
     */
    public function getPassword(): string|null
    {
        $value = $this->getX(self::KEY_PASSWORD);

        if (is_null($value)) {
            return null;
        }

        return strval($value);
    }

    /**
     * Returns the host.
     *
     * @return string|null
     */
    public function getHost(): string|null
    {
        $value = $this->getX(self::KEY_HOST);

        if (is_null($value)) {
            return null;
        }

        return strval($value);
    }

    /**
     * Returns the port.
     *
     * @return int|null
     */
    public function getPort(): int|null
    {
        $value = $this->getX(self::KEY_PORT);

        if (is_null($value)) {
            return null;
        }

        return intval($value);
    }

    /**
     * Returns the options as string.
     *
     * @return string|null
     */
    public function getOptions(): string|null
    {
        $value = $this->getX(self::KEY_OPTIONS);

        if (is_null($value)) {
            return null;
        }

        return strval($value);
    }
}
