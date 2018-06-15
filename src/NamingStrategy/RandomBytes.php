<?php
declare(strict_types=1);

class RandomBytes implements NamingStrategyInterface
{
    /**
     * @return string
     *
     * Only throws on old/low-entropy systems.
     */
    public function generate(): string
    {
        return bin2hex(random_bytes(random_int(4, 12)));
    }
}
