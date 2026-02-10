<?php

namespace OHMedia\GlobalContentBundle\Service;

use OHMedia\SettingsBundle\Service\Settings;

class GlobalContent
{
    private const PREFIX = 'global_content_';

    public function __construct(private Settings $settings)
    {
    }

    public function get(string $id): ?string
    {
        return $this->settings->get(self::PREFIX.$id);
    }

    public function set(string $id, string $value): void
    {
        $this->settings->set(self::PREFIX.$id, $value);
    }
}
