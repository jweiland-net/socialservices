<?php
namespace JWeiland\Socialservices\Controller;

/*
 * This file is part of the TYPO3 CMS project.
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

use JWeiland\Socialservices\Domain\Model\Helpdesk;
use JWeiland\Socialservices\Domain\Repository\HelpdeskRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class HelpdeskController
 *
 * @package socialservices
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class HelpdeskController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * HelpdeskRepository
     *
     * @var HelpdeskRepository
     */
    protected $helpdeskRepository;

    /**
     * Letters
     *
     * @var string
     */
    protected $letters = '0-9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';

    /**
     * preprocessing of all actions
     *
     * @return void
     */
    public function initializeAction()
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    /**
     * inject helpdeskRepository
     *
     * @param HelpdeskRepository $helpdeskRepository
     * @return void
     */
    public function injectHelpdeskRepository(HelpdeskRepository $helpdeskRepository)
    {
        $this->helpdeskRepository = $helpdeskRepository;
    }

    /**
     * action list
     *
     * @param string $letter Show only records starting with this letter
     * @validate $letter String, StringLength(minimum=0,maximum=1)
     * @return void
     */
    public function listAction($letter = null)
    {
        if ($letter === null) {
            $helpdesks = $this->helpdeskRepository->findAll();
        } else {
            $helpdesks = $this->helpdeskRepository->findByStartingLetter($letter);
        }
        $this->view->assign('helpdesks', $helpdesks);
        $this->view->assign('glossar', $this->getGlossar());
    }

    /**
     * get an array with letters as keys for the glossar
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
     * action show
     *
     * @param Helpdesk $helpdesk
     * @return void
     */
    public function showAction(Helpdesk $helpdesk)
    {
        $this->view->assign('helpdesk', $helpdesk);
    }

    /**
     * secure search parameter
     *
     * @return void
     */
    public function initializeSearchAction()
    {
        if ($this->request->hasArgument('search')) {
            $search = $this->request->getArgument('search');
            $this->request->setArgument('search', htmlentities($search));
        }
    }

    /**
     * search show
     *
     * @param string $search
     * @return void
     */
    public function searchAction($search)
    {
        $helpdesks = $this->helpdeskRepository->searchHelpdesks($search);
        $this->view->assign('search', $search);
        $this->view->assign('glossar', $this->getGlossar());
        $this->view->assign('helpdesks', $helpdesks);
    }
}
