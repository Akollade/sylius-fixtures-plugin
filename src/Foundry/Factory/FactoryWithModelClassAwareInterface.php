<?php

/*
 * This file is part of ShopFixturesPlugin.
 *
 * (c) Akawaka
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Factory;

interface FactoryWithModelClassAwareInterface
{
    /**
     * @param class-string $modelClass
     */
    public static function withModelClass(string $modelClass): void;
}
