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

namespace CoreShop\Component\Pimcore\DataObject;

class ClassLoader
{
    /**
     * Force loads a class, this makes sense if a class is installed and needs to be used in the same request.
     *
     * @param string $className
     */
    public static function forceLoadDataObjectClass(string $className): void
    {
        $className = static::normalizeClassName($className);

        $fqcp = sprintf('%s/DataObject/%s.php', PIMCORE_CLASS_DIRECTORY, $className);
        $fqcn = sprintf('\\Pimcore\\Model\\DataObject\\%s', $className);

        static::loadClass($fqcp, $fqcn);
    }

    /**
     * Force loads a field-collection, this makes sense if a class is installed and needs to be used in the same request.
     *
     * @param string $fieldCollection
     */
    public static function forceLoadFieldCollection(string $fieldCollection): void
    {
        $className = static::normalizeClassName($fieldCollection);

        $fqcp = sprintf('%s/DataObject/Fieldcollection/Data/%s.php', PIMCORE_CLASS_DIRECTORY, $className);
        $fqcn = sprintf('\\Pimcore\\Model\\DataObject\\Fieldcollection\\Data\\%s', $className);

        static::loadClass($fqcp, $fqcn);
    }

    /**
     * Force loads a bick, this makes sense if a class is installed and needs to be used in the same request.
     *
     * @param string $brickName
     */
    public static function forceLoadBrick(string $brickName): void
    {
        $className = static::normalizeClassName($brickName);

        $fqcp = sprintf('%s/DataObject/Objectbrick/Data/%s.php', PIMCORE_CLASS_DIRECTORY, $className);
        $fqcn = sprintf('\\Pimcore\\Model\\DataObject\\Objectbrick\\Data\\%s', $className);

        static::loadClass($fqcp, $fqcn);
    }

    /**
     * Require class.
     *
     * @param string $fileName
     * @param string $className
     */
    protected static function loadClass(string $fileName, string $className): void
    {
        if (file_exists($fileName) && !class_exists($className)) {
            require_once $fileName;
        }
    }

    /**
     * Normalize a Pimcore DataObject ClassName.
     *
     * @param string $className
     *
     * @return string
     */
    protected static function normalizeClassName(string $className): string
    {
        $classNameExploded = explode('\\', $className);

        return ucfirst($classNameExploded[count($classNameExploded) - 1]);
    }
}
