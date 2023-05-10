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
use Sylius\Component\Promotion\Model\CatalogPromotionActionInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CatalogPromotionActionInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $catalogPromotionActionFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $catalogPromotionAction = $this->catalogPromotionActionFactory->createNew();
        Assert::isInstanceOf($catalogPromotionAction, CatalogPromotionActionInterface::class);

        ($this->updater)($catalogPromotionAction, $attributes);

        return $catalogPromotionAction;
    }
}