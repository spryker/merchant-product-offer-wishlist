<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

declare(strict_types = 1);

namespace SprykerTest\Zed\MerchantProductOfferWishlist\Communication\Plugin\Wishlist;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductOfferTransfer;
use Generated\Shared\Transfer\WishlistItemTransfer;
use Spryker\Zed\MerchantProductOfferWishlist\Communication\Plugin\Wishlist\WishlistProductOfferPreUpdateItemPlugin;
use SprykerTest\Zed\MerchantProductOfferWishlist\MerchantProductOfferWishlistCommunicationTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group MerchantProductOfferWishlist
 * @group Communication
 * @group Plugin
 * @group Wishlist
 * @group WishlistProductOfferPreUpdateItemPluginTest
 * Add your own group annotations below this line
 */
class WishlistProductOfferPreUpdateItemPluginTest extends Unit
{
    protected MerchantProductOfferWishlistCommunicationTester $tester;

    public function testGivenAnItemOfAProductOfferWhenPreUpdateItemThenTheItemCarriesTheMerchantReferenceOfTheOffer(): void
    {
        // Arrange
        $productOfferTransfer = $this->haveProductOfferOfAMerchant();
        $wishlistItemTransfer = $this->buildWishlistItemOfProductOffer($productOfferTransfer);

        // Act
        $wishlistItemTransfer = (new WishlistProductOfferPreUpdateItemPlugin())->preUpdateItem($wishlistItemTransfer);

        // Assert
        $this->assertSame($productOfferTransfer->getMerchantReferenceOrFail(), $wishlistItemTransfer->getMerchantReference());
    }

    protected function haveProductOfferOfAMerchant(): ProductOfferTransfer
    {
        return $this->tester->haveProductOffer([
            ProductOfferTransfer::MERCHANT_REFERENCE => $this->tester->haveMerchant()->getMerchantReferenceOrFail(),
        ]);
    }

    protected function buildWishlistItemOfProductOffer(ProductOfferTransfer $productOfferTransfer): WishlistItemTransfer
    {
        return (new WishlistItemTransfer())
            ->setSku($productOfferTransfer->getConcreteSkuOrFail())
            ->setProductOfferReference($productOfferTransfer->getProductOfferReferenceOrFail());
    }
}
