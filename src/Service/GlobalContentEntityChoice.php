<?php

namespace OHMedia\GlobalContentBundle\Service;

use OHMedia\GlobalContentBundle\Entity\GlobalContent;
use OHMedia\SecurityBundle\Service\EntityChoiceInterface;

class GlobalContentEntityChoice implements EntityChoiceInterface
{
    public function getLabel(): string
    {
        return 'Global Content';
    }

    public function getEntities(): array
    {
        return [GlobalContent::class];
    }
}
