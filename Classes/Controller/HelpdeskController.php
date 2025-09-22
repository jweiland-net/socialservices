<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\Controller;

use JWeiland\Socialservices\Configuration\ExtConf;
use JWeiland\Socialservices\Domain\Model\Helpdesk;
use JWeiland\Socialservices\Domain\Model\Search;
use JWeiland\Socialservices\Domain\Repository\HelpdeskRepository;
use JWeiland\Socialservices\Event\PostProcessFluidVariablesEvent;
use JWeiland\Socialservices\Event\PreProcessControllerActionEvent;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Main controller to list and show records of type helpdesk
 */
class HelpdeskController extends ActionController
{
    public function __construct(
        protected readonly HelpdeskRepository $helpdeskRepository,
        protected readonly ExtConf $extConf,
    ) {}

    public function initializeAction(): void
    {
        // if this value was not set, then it will be filled with 0
        // but that is not good, because UriBuilder accepts 0 as pid, so it's better to set it to null
        if (empty($this->settings['pidOfDetailPage'])) {
            $this->settings['pidOfDetailPage'] = null;
        }
    }

    public function initializeListAction(): void
    {
        $this->preProcessControllerAction();
    }

    /**
     * @param string $letter Show only records starting with this letter
     */
    #[Validate(['validator' => 'String', 'param' => 'letter'])]
    #[Validate(['validator' => 'StringLength', 'param' => 'letter', 'options' => ['minimum' => 0, 'maximum' => 3]])]
    public function listAction(string $letter = ''): ResponseInterface
    {
        $this->postProcessAndAssignFluidVariables([
            'helpdesks' => $this->helpdeskRepository->findByLetter($letter),
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'search' => GeneralUtility::makeInstance(Search::class),
        ]);
        return $this->htmlResponse();
    }

    public function initializeShowAction(): void
    {
        $this->preProcessControllerAction();
    }

    /**
     * @param Helpdesk $helpdesk
     */
    public function showAction(Helpdesk $helpdesk): ResponseInterface
    {
        $this->postProcessAndAssignFluidVariables([
            'helpdesk' => $helpdesk,
        ]);
        return $this->htmlResponse();
    }

    public function initializeSearchAction(): void
    {
        $this->preProcessControllerAction();
    }

    public function searchAction(Search $search): ResponseInterface
    {
        $subCategories = [];
        if ($search->getCategory()) {
            $subCategories = $this->categoryRepository->findByParent($search->getCategory());
        }

        $this->postProcessAndAssignFluidVariables([
            'helpdesks' => $this->helpdeskRepository->searchHelpdesks($search),
            'categories' => $this->categoryRepository->findByParent($this->extConf->getRootCategory()),
            'subCategories' => $subCategories,
            'search' => $search,
        ]);
        return $this->htmlResponse();
    }

    protected function postProcessAndAssignFluidVariables(array $variables = []): void
    {
        /** @var PostProcessFluidVariablesEvent $event */
        $event = $this->eventDispatcher->dispatch(
            new PostProcessFluidVariablesEvent(
                $this->request,
                $this->settings,
                $variables,
            ),
        );

        $this->view->assignMultiple($event->getFluidVariables());
    }

    protected function preProcessControllerAction(): void
    {
        $this->eventDispatcher->dispatch(
            new PreProcessControllerActionEvent(
                $this->request,
                $this->arguments,
                $this->settings,
            ),
        );
    }
}
