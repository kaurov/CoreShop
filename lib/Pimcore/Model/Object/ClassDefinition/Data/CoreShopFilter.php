<?php
/**
 * CoreShop
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015 Dominik Pfaffenbauer (http://dominik.pfaffenbauer.at)
 * @license    http://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace Pimcore\Model\Object\ClassDefinition\Data;

use CoreShop\Model\Object\ClassDefinition\Data\Select as CoreShopSelect;

class CoreShopFilter extends  CoreShopSelect
{

    /**
     * Static type of this element
     *
     * @var string
     */
    public $fieldtype = "coreShopFilter";

    /**
     * Type for the generated phpdoc
     *
     * @var string
     */
    public $phpdocType = "CoreShop\\Model\\Product\\Filter";
}
