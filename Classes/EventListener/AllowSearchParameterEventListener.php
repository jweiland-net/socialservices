<?php

declare(strict_types=1);

/*
 * This file is part of the package jweiland/socialservices.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace JWeiland\Socialservices\EventListener;

use JWeiland\Socialservices\Event\PreProcessControllerActionEvent;
use TYPO3\CMS\Extbase\Property\TypeConverter\PersistentObjectConverter;

/*
 * If you navigate to 2nd, 3rd, ... page of pageBrowser we add the POST data as GET parameter to the URI.
 * With this click we lost the MappingConfiguration "__trustedProperties" of the form. So we have to allow the
 * form fields for PropertyMapper here again.
 */
class AllowSearchParameterEventListener extends AbstractControllerEventListener
{
    protected $allowedControllerActions = [
        'Helpdesk' => [
            'search',
        ],
    ];

    public function __invoke(PreProcessControllerActionEvent $event): void
    {
        if ($this->isValidRequest($event)) {
            $pmc = $event->getArguments()
                ->getArgument('search')
                ->getPropertyMappingConfiguration();

            $pmc->allowAllProperties();

            $pmc->setTypeConverterOptions(
                PersistentObjectConverter::class,
                [
                    PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED => true,
                ],
            );
        }
    }
}
