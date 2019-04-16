<?php
namespace JWeiland\Socialservices\Configuration;

/*
 * This file is part of the socialservices project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class ExtConf
 *
 * @package JWeiland\Socialservices\Configuration
 */
class ExtConf implements SingletonInterface
{
    /**
     * root category.
     *
     * @var int
     */
    protected $rootCategory = 0;

    /**
     * constructor of this class
     * This method reads the global configuration and calls the setter methods.
     */
    public function __construct()
    {
        // get global configuration
        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['socialservices'], ['allowed_classes' => false]);
        if (is_array($extConf) && count($extConf)) {
            // call setter method foreach configuration entry
            foreach ($extConf as $key => $value) {
                $methodName = 'set' . ucfirst($key);
                if (method_exists($this, $methodName)) {
                    $this->$methodName($value);
                }
            }
        }
    }

    /**
     * @return int
     */
    public function getRootCategory(): int
    {
        return $this->rootCategory;
    }

    /**
     * @param int $rootCategory
     */
    public function setRootCategory(int $rootCategory)
    {
        $this->rootCategory = $rootCategory;
    }
}
