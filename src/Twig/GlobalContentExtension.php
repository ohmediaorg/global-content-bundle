<?php

namespace OHMedia\GlobalContentBundle\Twig;

use OHMedia\GlobalContentBundle\Service\GlobalContent;
use OHMedia\WysiwygBundle\Service\Wysiwyg;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GlobalContentExtension extends AbstractExtension
{
    public function __construct(
        private GlobalContent $globalContent,
        private Wysiwyg $wysiwyg,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('global_content', [$this, 'globalContent'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    public function globalContent(string $id)
    {
        $value = (string) $this->globalContent->get($id);

        return $this->wysiwyg->render($value);
    }
}
