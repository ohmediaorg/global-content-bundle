<?php

namespace OHMedia\GlobalContentBundle\Service;

use OHMedia\BackendBundle\Service\AbstractNavItemProvider;
use OHMedia\BootstrapBundle\Component\Nav\NavItemInterface;
use OHMedia\BootstrapBundle\Component\Nav\NavLink;
use OHMedia\GlobalContentBundle\Entity\GlobalContent;
use OHMedia\GlobalContentBundle\Security\Voter\GlobalContentVoter;

class GlobalContentNavItemProvider extends AbstractNavItemProvider
{
    public function getNavItem(): ?NavItemInterface
    {
        if ($this->isGranted(GlobalContentVoter::INDEX, new GlobalContent())) {
            return (new NavLink('Global Content', 'global_content_index'))
                ->setIcon('globe2');
        }

        return null;
    }
}
