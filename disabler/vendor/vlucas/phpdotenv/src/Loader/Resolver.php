<?php

declare (strict_types=1);
namespace HBP_Disabler_Vendor\Dotenv\Loader;

use HBP_Disabler_Vendor\Dotenv\Parser\Value;
use HBP_Disabler_Vendor\Dotenv\Repository\RepositoryInterface;
use HBP_Disabler_Vendor\Dotenv\Util\Regex;
use HBP_Disabler_Vendor\Dotenv\Util\Str;
use HBP_Disabler_Vendor\PhpOption\Option;
final class Resolver
{
    /**
     * This class is a singleton.
     *
     * @codeCoverageIgnore
     *
     * @return void
     */
    private function __construct()
    {
        //
    }
    /**
     * Resolve the nested variables in the given value.
     *
     * Replaces ${varname} patterns in the allowed positions in the variable
     * value by an existing environment variable.
     *
     * @param \Dotenv\Repository\RepositoryInterface $repository
     * @param \Dotenv\Parser\Value                   $value
     *
     * @return string
     */
    public static function resolve(RepositoryInterface $repository, Value $value)
    {
        return \array_reduce($value->getVars(), static function (string $s, int $i) use ($repository) {
            return Str::substr($s, 0, $i) . self::resolveVariable($repository, Str::substr($s, $i));
        }, $value->getChars());
    }
    /**
     * Resolve a single nested variable.
     *
     * @param \Dotenv\Repository\RepositoryInterface $repository
     * @param string                                 $str
     *
     * @return string
     */
    private static function resolveVariable(RepositoryInterface $repository, string $str)
    {
        return Regex::replaceCallback('/\A\${([a-zA-Z0-9_.]+)}/', static function (array $matches) use ($repository) {
            return Option::fromValue($repository->get($matches[1]))->getOrElse($matches[0]);
        }, $str, 1)->success()->getOrElse($str);
    }
}
