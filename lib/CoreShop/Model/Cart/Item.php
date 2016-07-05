<?php
/**
 * CoreShop.
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2016 Dominik Pfaffenbauer (http://www.pfaffenbauer.at)
 * @license    http://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace CoreShop\Model\Cart;

use CoreShop\Exception\UnsupportedException;
use CoreShop\Model\Base;
use CoreShop\Model\Cart;
use CoreShop\Model\Product;

/**
 * Class Item
 * @package CoreShop\Model\Cart
 */
class Item extends Base
{
    /**
     * Pimcore Object Class.
     *
     * @var string
     */
    public static $pimcoreClass = 'Pimcore\\Model\\Object\\CoreShopCartItem';

    /**
     * Calculates the total for the CartItem.
     *
     * @return mixed
     */
    public function getTotal()
    {
        return $this->getAmount() * $this->getProduct()->getPrice();
    }

    /**
     * Get the Cart for this CartItem.
     *
     * @return \Pimcore\Model\Object\AbstractObject|void|null
     */
    public function getCart()
    {
        $parent = $this->getParent();

        do {
            if ($parent instanceof Cart) {
                return $parent;
            }

            $parent = $parent->getParent();
        } while ($parent != null);

        return null;
    }

    /**
     * returns amount for item
     * this method has to be overwritten in Pimcore Object.
     *
     * @throws UnsupportedException
     *
     * @return int
     */
    public function getAmount()
    {
        throw new UnsupportedException('getAmount is not supported for '.get_class($this));
    }

    /**
     * sets amount for item
     * this method has to be overwritten in Pimcore Object.
     *
     * @param $amount
     *
     * @throws UnsupportedException
     */
    public function setAmount($amount)
    {
        throw new UnsupportedException('setAmount is not supported for '.get_class($this));
    }

    /**
     * returns product for item
     * this method has to be overwritten in Pimcore Object.
     *
     * @throws UnsupportedException
     *
     * @return Product
     */
    public function getProduct()
    {
        throw new UnsupportedException('getProduct is not supported for '.get_class($this));
    }
}
