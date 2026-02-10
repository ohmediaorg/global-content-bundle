<?php

namespace OHMedia\GlobalContentBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use OHMedia\GlobalContentBundle\Service\GlobalContentProvider;
use OHMedia\SettingsBundle\Entity\Setting;
use OHMedia\WysiwygBundle\Repository\WysiwygRepositoryInterface;

class GlobalContentRepository extends ServiceEntityRepository implements WysiwygRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private GlobalContentProvider $globalContentProvider,
    ) {
        parent::__construct($registry, Setting::class);
    }

    public function getShortcodeQueryBuilder(string $shortcode): QueryBuilder
    {
        return $this->createQueryBuilder('s')
            ->where('s.id LIKE :id')
            ->setParameter('id', 'global_content_%')
            ->andWhere('s.value LIKE :shortcode')
            ->setParameter('shortcode', '%'.$shortcode.'%');
    }

    public function getShortcodeRoute(): string
    {
        return 'global_content_edit';
    }

    public function getShortcodeRouteParams(mixed $entity): array
    {
        return [
            'id' => GlobalContentProvider::id($entity->getId()),
        ];
    }

    public function getShortcodeHeading(): string
    {
        return 'Global Content';
    }

    public function getShortcodeLinkText(mixed $entity): string
    {
        $settingId = $entity->getId();

        $id = GlobalContentProvider::id($settingId);

        return $this->globalContentProvider->exists($id)
            ? $this->globalContentProvider->label($id)
            : $settingId;
    }
}
