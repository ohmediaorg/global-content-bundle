<?php

namespace OHMedia\GlobalContentBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OHMediaGlobalContentBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode('tags')
                    ->children();

        foreach (HtmlTags::SAFE as $tag) {
            $allowedTags->booleanNode($tag)
                ->defaultTrue()
            ->end();
        }

        foreach (HtmlTags::UNSAFE as $tag) {
            $allowedTags->booleanNode($tag)
                ->defaultFalse()
            ->end();
        }

        $allowedTags->end()->end();
    }

    public function loadExtension(
        array $config,
        ContainerConfigurator $containerConfigurator,
        ContainerBuilder $containerBuilder
    ): void {
        $containerConfigurator->import('../config/services.yaml');
    }
}
