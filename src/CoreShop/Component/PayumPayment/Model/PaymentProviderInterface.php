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

namespace CoreShop\Component\PayumPayment\Model;

use CoreShop\Component\Payment\Model\PaymentProviderInterface as BasePaymentProviderInterface;

interface PaymentProviderInterface extends BasePaymentProviderInterface
{
    /**
     * @param GatewayConfig $gatewayConfig
     */
    public function setGatewayConfig(GatewayConfig $gatewayConfig);

    /**
     * @return GatewayConfig
     */
    public function getGatewayConfig();
}
