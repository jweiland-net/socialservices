<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Controller;

use JWeiland\Socialservices\Domain\Model\Helpdesk;
use JWeiland\Socialservices\Domain\Model\Search;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Main controller to list and show records of type helpdesk
 */
class HelpdeskController extends AbstractController
{
    public function initializeListAction(): void
    {
        $this->preProcessControllerAction();
    }

    /**
     * @param string $letter Show only records starting with this letter
     * @TYPO3\CMS\Extbase\Annotation\Validate("String", param="letter")
     * @TYPO3\CMS\Extbase\Annotation\Validate("StringLength", param="letter", options={"minimum": 0, "maximum": 3})
     */
    public function listAction(string $letter = ''): void
    {
        $this->postProcessAndAssignFluidVariables([
            'helpdesks' => $this->helpdeskRepository->findByLetter($letter),
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'search' => GeneralUtility::makeInstance(Search::class)
        ]);
    }

    public function initializeShowAction(): void
    {
        $this->preProcessControllerAction();
    }

    /**
     * @param Helpdesk $helpdesk
     */
    public function showAction(Helpdesk $helpdesk): void
    {
        $this->postProcessAndAssignFluidVariables([
            'helpdesk' => $helpdesk
        ]);
    }

    public function initializeSearchAction(): void
    {
        $this->preProcessControllerAction();
    }

    /**
     * @param Search $search
     */
    public function searchAction(Search $search): void
    {
        $subCategories = [];
        if ($search->getCategory()) {
            $subCategories = $this->categoryRepository->findByParent($search->getCategory());
        }

        $this->postProcessAndAssignFluidVariables([
            'helpdesks' => $this->helpdeskRepository->searchHelpdesks($search),
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'subCategories' => $subCategories,
            'search' => $search
        ]);
    }
}
