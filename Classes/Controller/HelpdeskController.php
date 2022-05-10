<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Controller;

use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Socialservices\Configuration\ExtConf;
use JWeiland\Socialservices\Domain\Model\Helpdesk;
use JWeiland\Socialservices\Domain\Model\Search;
use JWeiland\Socialservices\Domain\Repository\HelpdeskRepository;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Main controller to list and show helpdesks
 */
class HelpdeskController extends ActionController
{
    /**
     * @var HelpdeskRepository
     */
    protected $helpdeskRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var ExtConf
     */
    protected $extConf;

    /**
     * @var GlossaryService
     */
    protected $glossaryService;

    public function injectHelpdeskRepository(HelpdeskRepository $helpdeskRepository): void
    {
        $this->helpdeskRepository = $helpdeskRepository;
    }

    public function injectCategoryRepository(CategoryRepository $categoryRepository): void
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function injectExtConf(ExtConf $extConf): void
    {
        $this->extConf = $extConf;
    }

    public function injectGlossaryService(GlossaryService $glossaryService): void
    {
        $this->glossaryService = $glossaryService;
    }

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
        if ($this->arguments->hasArgument('search')) {
            $this->arguments->getArgument('search')
                ->getPropertyMappingConfiguration()
                ->allowProperties(
                    'searchWord',
                    'letter',
                    'category',
                    'subCategory'
                );
        }
    }

    /**
     * @param string $letter Show only records starting with this letter
     * @TYPO3\CMS\Extbase\Annotation\Validate("String", param="letter")
     * @TYPO3\CMS\Extbase\Annotation\Validate("StringLength", param="letter", options={"minimum": 0, "maximum": 3})
     */
    public function listAction(string $letter = ''): void
    {
        $this->view->assignMultiple([
            'helpdesks' => $this->helpdeskRepository->findByLetter($letter),
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'search' => GeneralUtility::makeInstance(Search::class)
        ]);
        $this->assignGlossary();
    }

    /**
     * @param Helpdesk $helpdesk
     */
    public function showAction(Helpdesk $helpdesk): void
    {
        $this->view->assign('helpdesk', $helpdesk);
    }

    /**
     * @param Search $search
     */
    public function searchAction(Search $search): void
    {
        $helpdesks = $this->helpdeskRepository->searchHelpdesks($search);

        if ($search->getCategory()) {
            $this->view->assign('subCategories', $this->categoryRepository->findByParent($search->getCategory()));
        }

        $this->view->assignMultiple([
            'helpdesks' => $helpdesks,
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'search' => $search
        ]);
        $this->assignGlossary();
    }

    protected function assignGlossary(): void
    {
        $options = [
            'extensionName' => 'socialservices',
            'pluginName' => 'socialservices',
            'controllerName' => 'Helpdesk',
            'column' => 'title',
            'settings' => $this->settings
        ];

        if (
            isset($this->settings['glossary'])
            && is_array($this->settings['glossary'])
        ) {
            ArrayUtility::mergeRecursiveWithOverrule($options, $this->settings['glossary']);
        }

        $this->view->assign(
            'glossar',
            $this->glossaryService->buildGlossary(
                $this->helpdeskRepository->getQueryBuilderToFindAllEntries(),
                $options
            )
        );
    }
}
