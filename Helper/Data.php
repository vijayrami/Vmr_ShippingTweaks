<?php

declare(strict_types=1);

namespace Vmr\ShippingTweaks\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Enabled Config Path
     */
    const XML_CONFIG_ENABLED = 'shipping/behavior/tweaks';

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_CONFIG_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }
}