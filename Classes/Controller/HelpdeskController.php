<?php
declare(strict_types = 1);
namespace JWeiland\Socialservices\Controller;

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

use JWeiland\Socialservices\Configuration\ExtConf;
use JWeiland\Socialservices\Domain\Model\Helpdesk;
use JWeiland\Socialservices\Domain\Model\Search;
use JWeiland\Socialservices\Domain\Repository\HelpdeskRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
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
     * @var string
     */
    protected $letters = '0-9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';

    /**
     * Pre processing of all actions.
     */
    public function initializeAction()
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
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
     * @param HelpdeskRepository $helpdeskRepository
     */
    public function injectHelpdeskRepository(HelpdeskRepository $helpdeskRepository)
    {
        $this->helpdeskRepository = $helpdeskRepository;
    }

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param ExtConf $extConf
     */
    public function injectExtConf(ExtConf $extConf)
    {
        $this->extConf = $extConf;
    }

    /**
     * Action list
     *
     * @param string $letter Show only records starting with this letter
     * @validate $letter String, StringLength(minimum=0,maximum=1)
     */
    public function listAction(string $letter = null)
    {
        if ($letter === null) {
            $helpdesks = $this->helpdeskRepository->findAll();
        } else {
            $helpdesks = $this->helpdeskRepository->findByStartingLetter($letter);
        }
        $this->view->assign('helpdesks', $helpdesks);
        $this->view->assign('glossar', $this->getGlossar());
        $this->view->assign('categories', $this->categoryRepository->findByParent($this->extConf->getRootCategory()));
    }

    /**
     * Get an array with letters as keys for the glossar
     *
     * @return array Array with starting letters as keys
     */
    protected function getGlossar() : array
    {
        $glossar = [];
        $availableLetters = $this->helpdeskRepository->getStartingLetters();
        $possibleLetters = GeneralUtility::trimExplode(',', $this->letters);

        // add all letters which we have found in DB
        foreach ($availableLetters as $availableLetter) {
            if (MathUtility::canBeInterpretedAsInteger($availableLetter['letter'])) {
                $availableLetter['letter'] = '0-9';
            }
            // add only letters which are valid (do not add "§$%")
            if (array_search($availableLetter['letter'], $possibleLetters) !== false) {
                $glossar[$availableLetter['letter']] = true;
            }
        }

        // add all valid letters which are not set/found by previous foreach
        foreach ($possibleLetters as $possibleLetter) {
            if (!array_key_exists($possibleLetter, $glossar)) {
                $glossar[$possibleLetter] = false;
            }
        }

        ksort($glossar, SORT_STRING);

        return $glossar;
    }

    /**
     * Action show
     *
     * @param Helpdesk $helpdesk
     */
    public function showAction(Helpdesk $helpdesk)
    {
        $this->view->assign('helpdesk', $helpdesk);
    }

    /**
     * Search show.
     *
     * @param Search $search
     */
    public function searchAction(Search $search = null)
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
        $this->view->assign('glossar', $this->getGlossar());
    }
}
