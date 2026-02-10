<?php

namespace OHMedia\GlobalContentBundle\Twig;

use OHMedia\GlobalContentBundle\Service\GlobalContent;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalContentExtension extends AbstractExtension
{
    public function __construct(private GlobalContent $globalContent)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('global_content', [$this->globalContent, 'render'], [
                'is_safe' => ['html'],
            ]),
        ];
    }
}
