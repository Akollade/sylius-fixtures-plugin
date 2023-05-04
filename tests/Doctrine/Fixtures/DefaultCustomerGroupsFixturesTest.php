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

namespace Tests\Acme\SyliusExamplePlugin\Doctrine\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultCustomerGroupsFixturesTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_default_customer_groups(): void
    {
        self::bootKernel();

        /** @var Fixture $fixture */
        $fixture = self::getContainer()->get('sylius.shop_fixtures.doctrine.fixtures.default_customer_groups');

        $fixture->load(self::getContainer()->get('doctrine.orm.entity_manager'));

        $customerGroups = $this->getCustomerGroupRepository()->findAll();

        $this->assertCount(2, $customerGroups);
    }

    private function getCustomerGroupRepository(): RepositoryInterface
    {
        return static::getContainer()->get('sylius.repository.customer_group');
    }
}