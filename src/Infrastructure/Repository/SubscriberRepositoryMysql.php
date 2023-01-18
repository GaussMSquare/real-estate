<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\User\UserModel;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class SubscriberRepositoryMysql implements SubscriberRepositoryInterface
{
    public const DB_NAME = 'gaussmrgaussmsq';
    public const TABLE_NAME = 'subscriber';

    private Connection $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    /**
     * @throws Exception
     */
    public function create(UserModel $user): void
    {
        $queryBuilder = $this->dbal->createQueryBuilder();
        $queryBuilder->insert(sprintf('%s.%s', self::DB_NAME, self::TABLE_NAME))
            ->values([
                'product' => ':product',
                'abo_id' => ':abo_id',
                'type' => ':type',
                'duration' => ':duration',
                'is_valid' => ':is_valid',
                'is_processed' => ':is_processed',
                'created_at' => ':created_at'
            ])
            ->setParameters([
                'product' => $audio->getProduct()->toString(),
                'abo_id' => $audio->getAboId(),
                'type' => $audio->getType(),
                'duration' => $audio->getDuration(),
                'is_valid' => $this->boolToString($audio->isValid()),
                'is_processed' => $this->boolToString($audio->isProcessed()),
                'created_at' => $audio->getCreatedAt()->format($this->dateTimeFormat)
            ])
        ;

        $queryBuilder->executeStatement();
    }
}