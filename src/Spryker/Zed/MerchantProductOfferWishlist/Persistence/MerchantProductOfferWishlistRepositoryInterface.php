<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantProductOfferWishlist\Persistence;

interface MerchantProductOfferWishlistRepositoryInterface
{
    /**
     * @param string $productOfferReference
     *
     * @return int|null
     */
    public function findMerchantIdByProductOfferReference(string $productOfferReference): ?int;
}