<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\EventListener;

use JWeiland\Glossary2\Service\GlossaryService;
use JWeiland\Socialservices\Domain\Repository\HelpdeskRepository;
use JWeiland\Socialservices\Event\PostProcessFluidVariablesEvent;
use TYPO3\CMS\Core\Utility\ArrayUtility;

class AddGlossaryEventListener extends AbstractControllerEventListener
{
    /**
     * @var GlossaryService
     */
    protected $glossaryService;

    /**
     * @var HelpdeskRepository
     */
    protected $helpdeskRepository;

    protected $allowedControllerActions = [
        'Helpdesk' => [
            'list',
        ],
    ];

    public function __construct(GlossaryService $glossaryService, HelpdeskRepository $helpdeskRepository)
    {
        $this->glossaryService = $glossaryService;
        $this->helpdeskRepository = $helpdeskRepository;
    }

    public function __invoke(PostProcessFluidVariablesEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $event->addFluidVariable(
                'glossar',
                $this->glossaryService->buildGlossary(
                    $this->helpdeskRepository->getQueryBuilderToFindAllEntries(),
                    $this->getOptions($event),
                ),
            );
        }
    }

    protected function getOptions(PostProcessFluidVariablesEvent $event): array
    {
        $options = [
            'extensionName' => 'socialservices',
            'pluginName' => 'socialservices',
            'controllerName' => 'Helpdesk',
            'column' => 'title',
            'settings' => $event->getSettings(),
        ];

        if (
            isset($event->getSettings()['glossary'])
            && is_array($event->getSettings()['glossary'])
        ) {
            ArrayUtility::mergeRecursiveWithOverrule($options, $event->getSettings()['glossary']);
        }

        return $options;
    }
}
