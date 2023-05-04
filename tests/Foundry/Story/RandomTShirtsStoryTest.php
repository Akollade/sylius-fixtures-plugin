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

namespace Tests\Acme\SyliusExamplePlugin\Foundry\Story;

use Akawakaweb\ShopFixturesPlugin\Foundry\Factory\LocaleFactory;
use Akawakaweb\ShopFixturesPlugin\Foundry\Story\RandomTShirtsStory;
use Sylius\Component\Core\Model\ProductInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\Acme\SyliusExamplePlugin\PurgeDatabaseTrait;
use Zenstruck\Foundry\Test\Factories;

final class RandomTShirtsStoryTest extends KernelTestCase
{
    use PurgeDatabaseTrait;
    use Factories;

    /** @test */
    public function it_creates_random_t_shirts(): void
    {
        self::bootKernel();

        LocaleFactory::new()->withCode('en_US')->create();
        RandomTShirtsStory::load();

        $products = $this->getProductRepository()->findAll();

        $this->assertCount(6, $products);

        $product = $products[0];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Everyday white basic T-Shirt', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_01.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(4, $product->getAttributes());

        $product = $products[1];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Loose white designer T-Shirt', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_02.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[2];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Ribbed copper slim fit Tee', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('women_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_03.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[3];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Sport basic white T-Shirt', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('men_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_01.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[4];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Raglan grey & black Tee', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('men_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_02.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());

        $product = $products[5];
        $this->assertInstanceOf(ProductInterface::class, $product);
        $this->assertEquals('Oversize white cotton T-Shirt', $product->getName());
        $this->assertEquals('FASHION_WEB', $product->getChannels()[0]->getCode());
        $this->assertEquals('men_t_shirts', $product->getMainTaxon()->getCode());
        $this->assertStringEndsWith('t-shirt_03.jpg', $product->getImagesByType('main')[0]->getPath());
        $this->assertCount(3, $product->getAttributes());
    }

    private function getProductRepository(): RepositoryInterface
    {
        return self::getContainer()->get('sylius.repository.product');
    }
}