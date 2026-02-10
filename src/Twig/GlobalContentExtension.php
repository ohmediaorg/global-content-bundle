<?php

namespace OHMedia\GlobalContentBundle\Twig;

use OHMedia\GlobalContentBundle\Service\GlobalContentProvider;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalContentExtension extends AbstractExtension
{
    public function __construct(private GlobalContentProvider $globalContentProvider)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('global_content', [$this->globalContentProvider, 'render'], [
                'is_safe' => ['html'],
            ]),
        ];
    }
}
