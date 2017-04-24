<?php

namespace CoreShop\Bundle\CoreBundle\Cart\Rule\Condition;

use CoreShop\Component\Address\Model\AddressInterface;
use CoreShop\Component\Address\Model\ZoneInterface;
use CoreShop\Component\Core\Model\CountryInterface;
use CoreShop\Component\Customer\Model\CustomerInterface;
use CoreShop\Component\Order\Model\CartInterface;
use CoreShop\Component\Rule\Condition\ConditionCheckerInterface;
use Webmozart\Assert\Assert;

class ZonesConditionChecker implements ConditionCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function isValid($subject, array $configuration)
    {
        /**
         * @var $subject CartInterface
         */
        Assert::isInstanceOf($subject, CartInterface::class);

        if (!$subject->getCustomer() instanceof CustomerInterface) {
            return false;
        }

        if (!$subject->getInvoiceAddress() instanceof AddressInterface) {
            return false;
        }

        if (!$subject->getInvoiceAddress()->getCountry() instanceof CountryInterface) {
            return false;
        }

        if (!$subject->getInvoiceAddress()->getCountry()->getZone() instanceof ZoneInterface) {
            return false;
        }

        return in_array($subject->getInvoiceAddress()->getCountry()->getZone()->getId(), $configuration['zones']);
    }
}
