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
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Test case.
 */
class ExtConfTest extends FunctionalTestCase
{
    protected ExtConf $subject;

    protected array $testExtensionsToLoad = [
        'jweiland/glossary2',
        'jweiland/socialservices',
        'jweiland/maps2',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ExtConf(123);
    }

    public function tearDown(): void
    {
        unset(
            $this->subject,
        );

        parent::tearDown();
    }

    #[Test]
    public function getRootCategoryInitiallyReturnsZero(): void
    {
        self::assertSame(
            123,
            $this->subject->getRootCategory(),
        );
    }

    #[Test]
    public function setRootCategoryWithStringResultsInInteger(): void
    {
        $this->subject = new ExtConf(123);

        self::assertSame(
            123,
            $this->subject->getRootCategory(),
        );
    }
}
