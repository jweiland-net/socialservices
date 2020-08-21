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

    public function __construct(HelpdeskRepository $helpdeskRepository, CategoryRepository $categoryRepository, ExtConf $extConf, GlossaryService $glossaryService)
    {
        if (method_exists(get_parent_class($this), '__construct')) {
            parent::__construct();
        }
        $this->helpdeskRepository = $helpdeskRepository;
        $this->categoryRepository = $categoryRepository;
        $this->extConf = $extConf;
        $this->glossaryService = $glossaryService;
    }

    /**
     * Pre processing of all actions.
     */
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
     * Action list
     *
     * @param string|null $letter Show only records starting with this letter
     * @TYPO3\CMS\Extbase\Annotation\Validate("StringLength", param="letter", options={"minimum": 0, "maximum": 3})
     */
    public function listAction(?string $letter = null): void
    {
        if ($letter === null) {
            $helpdesks = $this->helpdeskRepository->findAll();
        } else {
            $helpdesks = $this->helpdeskRepository->findByStartingLetter($letter);
        }
        $this->view->assign('helpdesks', $helpdesks);
        $this->view->assign('glossar', $this->glossaryService->buildGlossary(
            $this->helpdeskRepository->getQueryBuilderToFindAllEntries(),
            [
                'extensionName' => 'socialservices',
                'pluginName' => 'socialservices',
                'controllerName' => 'Helpdesk',
            ]
        ));
        $this->view->assign('categories', $this->categoryRepository->findByParent($this->extConf->getRootCategory()));
    }

    /**
     * Action show
     *
     * @param Helpdesk $helpdesk
     */
    public function showAction(Helpdesk $helpdesk): void
    {
        $this->view->assign('helpdesk', $helpdesk);
    }

    /**
     * Search show.
     *
     * @param Search|null $search
     */
    public function searchAction(?Search $search = null): void
    {
        if ($search instanceof Search) {
            $helpdesks = $this->helpdeskRepository->searchHelpdesks($search);
            if ($search->getCategory()) {
                $this->view->assign('subCategories', $this->categoryRepository->findByParent($search->getCategory()));
            }
        } else {
            $helpdesks = $this->helpdeskRepository->findAll();
        }
        $this->view->assign('helpdesks', $helpdesks);
        $this->view->assign('categories', $this->categoryRepository->findByParent($this->extConf->getRootCategory()));
        $this->view->assign('search', $search);
        $this->view->assign('glossar', $this->glossaryService->buildGlossary($this->helpdeskRepository->getQueryBuilderToFindAllEntries()));
    }
}
