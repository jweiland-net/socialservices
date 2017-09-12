<?php
namespace JWeiland\Socialservices\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Stefan Frömken <sfroemken@jweiland.net>, jweiland.net
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * @package socialservices
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class HelpdeskController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * helpdeskRepository
	 *
	 * @var \JWeiland\Socialservices\Domain\Repository\HelpdeskRepository
	 * @inject
	 */
	protected $helpdeskRepository;

	protected $letters = '0-9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';





	/**
	 * preprocessing of all actions
	 *
	 * @return void
	 */
	public function initializeAction() {
		// if this value was not set, then it will be filled with 0
		// but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to NULL
		if (empty($this->settings['pidOfDetailPage'])) {
			$this->settings['pidOfDetailPage'] = NULL;
		}
	}

	/**
	 * action list
	 *
	 * @param string $letter Show only records starting with this letter
	 * @validate $letter String, StringLength(minimum=0,maximum=1)
	 * @return void
	 */
	public function listAction($letter = NULL) {
		if ($letter === NULL) {
			$helpdesks = $this->helpdeskRepository->findAll();
		} else {
			$helpdesks = $this->helpdeskRepository->findByStartingLetter($letter);
		}
		$this->view->assign('helpdesks', $helpdesks);
		$this->view->assign('glossar', $this->getGlossar());
	}

	/**
	 * action show
	 *
	 * @param \JWeiland\Socialservices\Domain\Model\Helpdesk $helpdesk
	 * @return void
	 */
	public function showAction(\JWeiland\Socialservices\Domain\Model\Helpdesk $helpdesk) {
		$this->view->assign('helpdesk', $helpdesk);
	}

	/**
	 * secure search parameter
	 *
	 * @return void
	 */
	public function initializeSearchAction() {
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
	public function searchAction($search) {
		$helpdesks = $this->helpdeskRepository->searchHelpdesks($search);
		$this->view->assign('search', $search);
		$this->view->assign('glossar', $this->getGlossar());
		$this->view->assign('helpdesks', $helpdesks);
	}

	/**
	 * get an array with letters as keys for the glossar
	 *
	 * @return array Array with starting letters as keys
	 */
	protected function getGlossar() {
		$glossar = array();
		$availableLetters = $this->helpdeskRepository->getStartingLetters();
		$possibleLetters = GeneralUtility::trimExplode(',', $this->letters);

		// add all letters which we have found in DB
		foreach ($availableLetters as $availableLetter) {
			if (MathUtility::canBeInterpretedAsInteger($availableLetter['letter'])) {
				$availableLetter['letter'] = '0-9';
			}
			// add only letters which are valid (do not add "§$%")
			if (array_search($availableLetter['letter'], $possibleLetters) !== FALSE) {
				$glossar[$availableLetter['letter']] = TRUE;
			}
		}

		// add all valid letters which are not set/found by previous foreach
		foreach ($possibleLetters as $possibleLetter) {
			if (!array_key_exists($possibleLetter, $glossar)) {
				$glossar[$possibleLetter] = FALSE;
			}
		}

		ksort($glossar, SORT_STRING);

		return $glossar;
	}

}