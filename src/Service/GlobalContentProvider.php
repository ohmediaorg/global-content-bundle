<?php

namespace OHMedia\GlobalContentBundle\Service;

use OHMedia\SettingsBundle\Service\Settings;
use OHMedia\WysiwygBundle\Service\Wysiwyg;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class GlobalContentProvider
{
    public const PREFIX = 'global_content_';

    public function __construct(
        private Settings $settings,
        private Wysiwyg $wysiwyg,
        #[Autowire('%oh_media_global_content.global_content%')]
        private array $globalContentConfig,
    ) {
    }

    public function config(): array
    {
        return $this->globalContentConfig;
    }

    public function label(string $id): string
    {
        return $this->globalContentConfig[$id];
    }

    public function exists(string $id): bool
    {
        return isset($this->globalContentConfig[$id]);
    }

    public function get(string $id): ?string
    {
        return $this->settings->get(self::PREFIX.$id);
    }

    public function set(string $id, string $value): void
    {
        $this->settings->set(self::PREFIX.$id, $value);
    }

    public function render(string $id): ?string
    {
        $value = (string) $this->get($id);

        return $this->wysiwyg->render($value);
    }

    public static function id(string $settingId): string
    {
        return str_replace(
            GlobalContentProvider::PREFIX,
            '',
            $settingId,
        );
    }
}
