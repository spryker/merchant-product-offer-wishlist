<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlist\Business\Checker;

use Generated\Shared\Transfer\WishlistItemTransfer;
use Generated\Shared\Transfer\WishlistPreAddItemCheckResponseTransfer;
use Generated\Shared\Transfer\WishlistPreUpdateItemCheckResponseTransfer;

/**
 * @deprecated Use {@link \Spryker\Zed\MerchantProductOfferWishlist\Business\Validator\WishlistItemProductOfferValidatorInterface} instead.
 */
interface WishlistItemRelationCheckerInterface
{
    public function checkWishlistItemProductOfferRelation(WishlistItemTransfer $wishlistItemTransfer): WishlistPreAddItemCheckResponseTransfer;

    public function checkUpdateWishlistItemProductOfferRelation(
        WishlistItemTransfer $wishlistItemTransfer
    ): WishlistPreUpdateItemCheckResponseTransfer;
}
