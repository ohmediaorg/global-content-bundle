<?php

namespace OHMedia\GlobalContentBundle\Security\Voter;

use OHMedia\GlobalContentBundle\Entity\GlobalContent;
use OHMedia\GlobalContentBundle\Service\GlobalContentProvider;
use OHMedia\SecurityBundle\Entity\User;
use OHMedia\SecurityBundle\Security\Voter\AbstractEntityVoter;

class GlobalContentVoter extends AbstractEntityVoter
{
    public const INDEX = 'index';
    public const EDIT = 'edit';

    public function __construct(private GlobalContentProvider $globalContentProvider)
    {
    }

    protected function getAttributes(): array
    {
        return [
            self::INDEX,
            self::EDIT,
        ];
    }

    protected function getEntityClass(): string
    {
        return GlobalContent::class;
    }

    protected function canIndex(GlobalContent $globalContent, User $loggedIn): bool
    {
        return count($this->globalContentProvider->config()) > 0;
    }

    protected function canEdit(GlobalContent $globalContent, User $loggedIn): bool
    {
        return true;
    }
}
