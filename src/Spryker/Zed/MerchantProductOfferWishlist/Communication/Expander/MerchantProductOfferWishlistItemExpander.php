<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlist\Communication\Expander;

use Generated\Shared\Transfer\MerchantCriteriaTransfer;
use Generated\Shared\Transfer\ProductOfferCriteriaTransfer;
use Generated\Shared\Transfer\WishlistItemTransfer;
use Spryker\Zed\MerchantProductOfferWishlist\Dependency\Facade\MerchantProductOfferWishlistToMerchantFacadeInterface;
use Spryker\Zed\MerchantProductOfferWishlist\Dependency\Facade\MerchantProductOfferWishlistToProductOfferFacadeInterface;

class MerchantProductOfferWishlistItemExpander implements MerchantProductOfferWishlistItemExpanderInterface
{
    /**
     * @var \Spryker\Zed\MerchantProductOfferWishlist\Dependency\Facade\MerchantProductOfferWishlistToProductOfferFacadeInterface
     */
    protected $productOfferFacade;

    /**
     * @var \Spryker\Zed\MerchantProductOfferWishlist\Dependency\Facade\MerchantProductOfferWishlistToMerchantFacadeInterface
     */
    protected $merchantFacade;

    public function __construct(
        MerchantProductOfferWishlistToProductOfferFacadeInterface $productOfferFacade,
        MerchantProductOfferWishlistToMerchantFacadeInterface $merchantFacade
    ) {
        $this->productOfferFacade = $productOfferFacade;
        $this->merchantFacade = $merchantFacade;
    }

    public function expandWishlistItem(WishlistItemTransfer $wishlistItemTransfer): WishlistItemTransfer
    {
        if (!$wishlistItemTransfer->getProductOfferReference()) {
            return $wishlistItemTransfer;
        }

        /** @var string $productOfferReference */
        $productOfferReference = $wishlistItemTransfer->getProductOfferReference();
        $productOfferCriteriaTransfer = (new ProductOfferCriteriaTransfer())
            ->setProductOfferReference($productOfferReference);
        $productOfferTransfer = $this->productOfferFacade->findOne($productOfferCriteriaTransfer);

        if (!$productOfferTransfer) {
            return $wishlistItemTransfer;
        }

        if ($productOfferTransfer->getMerchantReference()) {
            return $wishlistItemTransfer->setMerchantReference($productOfferTransfer->getMerchantReference());
        }

        $idMerchant = $productOfferTransfer->getFkMerchant();

        if (!$idMerchant) {
            return $wishlistItemTransfer;
        }

        $merchantCriteriaTransfer = (new MerchantCriteriaTransfer())
            ->setIdMerchant($idMerchant);

        $merchantTransfer = $this->merchantFacade
            ->findOne($merchantCriteriaTransfer);

        if (!$merchantTransfer) {
            return $wishlistItemTransfer;
        }

        return $wishlistItemTransfer->setMerchantReference($merchantTransfer->getMerchantReference());
    }
}
