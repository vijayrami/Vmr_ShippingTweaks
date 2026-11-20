<?php

declare(strict_types=1);

namespace Vmr\ShippingTweaks\Plugin\Shipping\Model\Rate;

use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Shipping\Model\Rate\Result as Subject;
use Vmr\ShippingTweaks\Helper\Data as ShippingTweaksHelper;

/**
 * Shipping Result Plugin
 */
class Result
{
    public function __construct(
        private readonly ShippingTweaksHelper $helper
    ) {
    }

    /**
     * Return all Rates in the Result
     *
     * @param Subject $subject
     * @param Method[] $result
     * @return Method[]
     */
    public function afterGetAllRates(Subject $subject, $result): array
    {
        if (!$this->helper->isEnabled()) {
            return $result;
        }
        $rates = $this->getAllFreeRates($result);
        return (count($rates) > 0) ? $rates : $result;
    }

    /**
     * Return all free Rates in the Result
     *
     * @param Method[] $result
     * @return Method[]
     */
    public function getAllFreeRates($result): array
    {
        $rates = [];
        foreach ($result ?: [] as $rate) {
            if ($rate->getPrice() < 0.0) {
                $rates[] = $rate;
            }
        }
        return $rates;
    }
}
