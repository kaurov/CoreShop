<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) CoreShop GmbH (https://www.coreshop.org)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace CoreShop\Bundle\PayumPaymentBundle\Event;

use CoreShop\Component\Payment\Model\PaymentProviderInterface;
use CoreShop\Component\Resource\Model\ResourceInterface;
use Symfony\Contracts\EventDispatcher\Event;

class PaymentProviderSupportsEvent extends Event
{
    private PaymentProviderInterface $paymentProvider;
    private ?ResourceInterface $subject;
    private bool $supported = true;

    public function __construct(PaymentProviderInterface $paymentProvider, ResourceInterface $subject = null)
    {
        $this->paymentProvider = $paymentProvider;
        $this->subject = $subject;
    }

    public function getPaymentProvider(): PaymentProviderInterface
    {
        return $this->paymentProvider;
    }

    public function getSubject(): ?ResourceInterface
    {
        return $this->subject;
    }

    public function isSupported(): bool
    {
        return $this->supported;
    }

    public function setSupported(bool $supported): void
    {
        $this->supported = $supported;
    }
}
