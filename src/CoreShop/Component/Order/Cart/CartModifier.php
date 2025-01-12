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

namespace CoreShop\Component\Order\Cart;

use CoreShop\Component\Order\CartEvents;
use CoreShop\Component\Order\Model\OrderInterface;
use CoreShop\Component\Order\Model\OrderItemInterface;
use CoreShop\Component\StorageList\Model\StorageListInterface;
use CoreShop\Component\StorageList\Model\StorageListItemInterface;
use CoreShop\Component\StorageList\StorageListItemQuantityModifierInterface;
use CoreShop\Component\StorageList\StorageListItemResolverInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

class CartModifier implements CartModifierInterface
{
    protected StorageListItemQuantityModifierInterface $cartItemQuantityModifier;
    protected EventDispatcherInterface $eventDispatcher;
    protected ?StorageListItemResolverInterface $cartItemResolver;

    public function __construct(
        StorageListItemQuantityModifierInterface $cartItemQuantityModifier,
        EventDispatcherInterface $eventDispatcher,
        StorageListItemResolverInterface $cartItemResolver = null
    ) {
        $this->cartItemQuantityModifier = $cartItemQuantityModifier;
        $this->eventDispatcher = $eventDispatcher;
        $this->cartItemResolver = $cartItemResolver;
    }

    public function addToList(StorageListInterface $storageList, StorageListItemInterface $item): void
    {
        $this->resolveItem($storageList, $item);
    }

    public function removeFromList(StorageListInterface $storageList, StorageListItemInterface $item): void
    {
        /**
         * @var $storageList OrderInterface
         * @var $item        OrderItemInterface
         */
        Assert::isInstanceOf($storageList, OrderInterface::class);
        Assert::isInstanceOf($item, OrderItemInterface::class);

        $this->eventDispatcher->dispatch(
            new GenericEvent($storageList, ['item' => $item]),
            CartEvents::PRE_REMOVE_ITEM
        );

        $storageList->removeItem($item);
        $item->delete();

        $this->eventDispatcher->dispatch(
            new GenericEvent($storageList, ['item' => $item]),
            CartEvents::POST_REMOVE_ITEM
        );
    }

    /**
     * @param StorageListInterface     $storageList
     * @param StorageListItemInterface $storageListItem
     */
    private function resolveItem(StorageListInterface $storageList, StorageListItemInterface $storageListItem): void
    {
        foreach ($storageList->getItems() as $item) {
            if ($this->cartItemResolver->equals($item, $storageListItem)) {
                $this->cartItemQuantityModifier->modify(
                    $item,
                    $item->getQuantity() + $storageListItem->getQuantity()
                );

                return;
            }
        }

        $this->eventDispatcher->dispatch(
            new GenericEvent($storageList, ['item' => $storageListItem]),
            CartEvents::PRE_ADD_ITEM
        );

        $storageList->addItem($storageListItem);

        $this->eventDispatcher->dispatch(
            new GenericEvent($storageList, ['item' => $storageListItem]),
            CartEvents::POST_ADD_ITEM
        );
    }
}
