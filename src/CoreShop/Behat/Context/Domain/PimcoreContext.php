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

namespace CoreShop\Behat\Context\Domain;

use Behat\Behat\Context\Context;
use CoreShop\Behat\Service\SharedStorageInterface;
use Webmozart\Assert\Assert;

final class PimcoreContext implements Context
{
    private SharedStorageInterface $sharedStorage;
    private string $webRoot;
    private array $adminJs;
    private array $adminCss;
    private array $editmodeJs;
    private array $editmodeCss;

    public function __construct(
        SharedStorageInterface $sharedStorage,
        string $webRoot,
        array $adminJs,
        array $adminCss,
        array $editmodeJs,
        array $editmodeCss
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->webRoot = $webRoot;
        $this->adminJs = $adminJs;
        $this->adminCss = $adminCss;
        $this->editmodeJs = $editmodeJs;
        $this->editmodeCss = $editmodeCss;
    }

    /**
     * @Then /^all admin js resources should exist$/
     */
    public function allAdminJsResourceShouldExist(): void
    {
        $this->checkFilesExist($this->adminJs, 'Admin JS');
    }

    /**
     * @Then /^all admin css resources should exist$/
     */
    public function allAdminCssResourceShouldExist(): void
    {
        $this->checkFilesExist($this->adminCss, 'Admin CSS');
    }

    /**
     * @Then /^all editmode js resources should exist$/
     */
    public function allEditmodeJsResourceShouldExist(): void
    {
        $this->checkFilesExist($this->editmodeJs, 'Editmode JS');
    }

    /**
     * @Then /^all editmode css resources should exist$/
     */
    public function allEditmodeCssResourceShouldExist(): void
    {
        $this->checkFilesExist($this->editmodeCss, 'Editmode CSS');
    }

    private function checkFilesExist(array $files, string $type): void
    {
        foreach ($files as $file) {
            Assert::true($this->checkFileExists($file), sprintf('File "%s" for type %s not found', $file, $type));
        }
    }

    private function checkFileExists(string $file): bool
    {
        return file_exists(sprintf('%s%s', $this->webRoot, $file));
    }
}
