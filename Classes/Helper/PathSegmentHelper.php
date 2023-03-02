<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Helper;

use JWeiland\Socialservices\Domain\Model\Helpdesk;
use TYPO3\CMS\Core\DataHandling\SlugHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

/*
 * Helper class to generate a path segment (slug) for a company record.
 * Used while executing the UpgradeWizard and saving records in frontend.
 */
class PathSegmentHelper
{
    public function generatePathSegment(array $baseRecord, int $pid): string
    {
        return $this->getSlugHelper()->generate($baseRecord, $pid);
    }

    protected function getSlugHelper(): SlugHelper
    {
        // Add uid to slug, to prevent duplicates
        $config = $GLOBALS['TCA']['tx_socialservices_domain_model_helpdesk']['columns']['path_segment']['config'];
        $config['generatorOptions']['fields'] = ['title', 'uid'];

        return GeneralUtility::makeInstance(
            SlugHelper::class,
            'tx_socialservices_domain_model_helpdesk',
            'path_segment',
            $config
        );
    }
}
