<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Story\DefaultMenuTaxonStory;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class DefaultMenuTaxonStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    function it_creates_default_menu_taxon(): void
    {
        self::bootKernel();

        DefaultMenuTaxonStory::load();

        $taxons = $this->getTaxonRepository()->findAll();

        $this->assertCount(1, $taxons);

        $taxon = $taxons[0];
        $this->assertInstanceOf(TaxonInterface::class, $taxon);
        $this->assertEquals('MENU_CATEGORY', $taxon->getCode());

        $taxon->setCurrentLocale('en_US');
        $this->assertEquals('Category', $taxon->getName());

        $taxon->setCurrentLocale('fr_FR');
        $this->assertEquals('Catégorie', $taxon->getName());
    }

    private function getTaxonRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.taxon');
    }
}