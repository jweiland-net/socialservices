<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Tests\Functional\Configuration;

use JWeiland\Socialservices\Configuration\ExtConf;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Test case.
 */
class ExtConfTest extends FunctionalTestCase
{
    /**
     * @var ExtConf
     */
    protected $subject;

    /**
     * @var array
     */
    protected $testExtensionsToLoad = [
        'typo3conf/ext/glossary2',
        'typo3conf/ext/socialservices',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ExtConf(
            GeneralUtility::makeInstance(ExtensionConfiguration::class),
        );
    }

    public function tearDown(): void
    {
        unset(
            $this->subject,
        );

        parent::tearDown();
    }

    /**
     * @test
     */
    public function getRootCategoryInitiallyReturnsZero(): void
    {
        self::assertSame(
            0,
            $this->subject->getRootCategory(),
        );
    }

    /**
     * @test
     */
    public function setRootCategoryWithStringResultsInInteger(): void
    {
        $this->subject->setRootCategory('123Test');

        self::assertSame(
            123,
            $this->subject->getRootCategory(),
        );
    }
}
