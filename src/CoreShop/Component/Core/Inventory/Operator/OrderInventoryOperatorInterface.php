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

namespace CoreShop\Component\Core\Inventory\Operator;

use CoreShop\Component\Core\Model\OrderInterface;

interface OrderInventoryOperatorInterface
{
    /**
     * @param OrderInterface $order
     */
    public function hold(OrderInterface $order): void;

    /**
     * @param OrderInterface $order
     *
     * @throws \InvalidArgumentException
     */
    public function sell(OrderInterface $order): void;

    /**
     * @param OrderInterface $order
     *
     * @throws \InvalidArgumentException
     */
    public function release(OrderInterface $order): void;

    /**
     * @param OrderInterface $order
     *
     * @throws \InvalidArgumentException
     */
    public function giveBack(OrderInterface $order): void;
}
