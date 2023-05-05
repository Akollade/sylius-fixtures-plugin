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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Updater;

use Sylius\Component\Shipping\Model\ShippingCategoryInterface;

final class ShippingCategoryUpdater implements ShippingCategoryUpdaterInterface
{
    public function update(ShippingCategoryInterface $shippingCategory, array $attributes): void
    {
        $shippingCategory->setCode($attributes['code'] ?? null);
        $shippingCategory->setName($attributes['name'] ?? null);
        $shippingCategory->setDescription($attributes['description'] ?? null);
    }
}