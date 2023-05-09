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
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class ChannelInitiator implements InitiatorInterface
{
    public function __construct(
        private FactoryInterface $channelFactory,
        private UpdaterInterface $updater,
    ) {
    }

    public function __invoke(array $attributes, string $class): object
    {
        $channel = $this->channelFactory->createNew();
        Assert::isInstanceOf($channel, ChannelInterface::class);

        ($this->updater)($channel, $attributes);

        $defaultLocale = $channel->getDefaultLocale();

        if (null !== $defaultLocale) {
            // Ensure Default locale is on available locale
            $channel->addLocale($defaultLocale);
        }

        return $channel;
    }
}
