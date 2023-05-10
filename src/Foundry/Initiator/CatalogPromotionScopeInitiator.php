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

namespace Akawakaweb\ShopFixturesPlugin\Foundry\Initiator;

use Akawakaweb\ShopFixturesPlugin\Foundry\Updater\UpdaterInterface;
use Sylius\Component\Core\Model\CatalogPromotionScopeInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CatalogPromotionScopeInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $catalogPromotionScopeFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $catalogPromotionScope = $this->catalogPromotionScopeFactory->createNew();
        Assert::isInstanceOf($catalogPromotionScope, CatalogPromotionScopeInterface::class);

        ($this->updater)($catalogPromotionScope, $attributes);

        return $catalogPromotionScope;
    }
}