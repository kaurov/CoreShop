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

namespace CoreShop\Component\Notification\Rule\Condition;

use CoreShop\Component\Notification\Model\NotificationRuleInterface;
use CoreShop\Component\Resource\Model\ResourceInterface;
use CoreShop\Component\Rule\Model\RuleInterface;

abstract class AbstractConditionChecker implements NotificationConditionCheckerInterface
{
    public function isValid(ResourceInterface $subject, RuleInterface $rule, array $configuration, array $params = []): bool
    {
        if ($subject instanceof NotificationRuleInterface) {
            throw new \InvalidArgumentException('Notification Rule Condition $subject needs to be an array with values subject and params');
        }

        if (!array_key_exists('params', $params)) {
            throw new \InvalidArgumentException('Notification Rule Condition $subject needs to be an array with values subject and params');
        }

        return $this->isNotificationRuleValid($subject, $params['params'], $configuration);
    }
}
