<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\User;

use App\Domain\Model\User\UserModel;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Connection;
use App\Infrastructure\Repository\Database;
use App\Domain\Exception\User\GetSubscriberNotFoundException;

class SubscriberRepositoryMysql extends Database implements SubscriberRepositoryInterface
{
    public function __construct(Connection $dbal)
    {
        parent::__construct($dbal);
    }

    /**
     * @throws Exception
     */
    public function create(UserModel $userModel): string
    {
        $this->queryBuilder->insert(sprintf('%s', self::SUBSCRIBER_TABLE_NAME))
            ->values([
                'email' => ':email',
                'password' => ':password'
            ])
            ->setParameters([
                'email' => $userModel->getEmail(),
                'password' => $userModel->getPassword()
            ])
        ;

        $this->queryBuilder->executeStatement();

        return $this->dbal->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public function get(string $id): UserModel
    {
        $this->queryBuilder->select('id, email')
            ->from(sprintf('%s', self::SUBSCRIBER_TABLE_NAME))
            ->where('id = :id')
            ->setParameters([
                'id' => $id
            ])
        ;

        $stmt = $this->queryBuilder->executeQuery();

        if (!$row = $stmt->fetchAssociative()) {
            throw new GetSubscriberNotFoundException();
        }

        return UserModel::arrayToModel($row);
    }

    public function getByEmail(string $email): ?UserModel
    {
        $this->queryBuilder->select('email')
            ->from(sprintf('%s', self::SUBSCRIBER_TABLE_NAME))
            ->where('email = :email')
            ->setParameters([
                'email' => $email
            ])
        ;

        $stmt = $this->queryBuilder->executeQuery();

        if (!$row = $stmt->fetchAssociative()) {
            return null;
        }

        return UserModel::arrayToModel($row);
    }

    /**
     * @throws Exception
     */
    public function update(array $fieldsToUpdate, array $where): void
    {
        $this->queryBuilder->update(sprintf('%s', self::SUBSCRIBER_TABLE_NAME));

        foreach($fieldsToUpdate as $key => $value) {
            $this->queryBuilder->set($key, ":$key");
            $this->queryBuilder->setParameter($key, $value);
        }

        $i = 0;
        foreach($where as $key => $value) {
            if ($i === 0) {
                $this->queryBuilder->where("$key = :$key");
            } else {
                $this->queryBuilder->andWhere("$key = :$key");
            }

            $this->queryBuilder->setParameter($key, $value);
            $i++;
        }

        $this->queryBuilder->executeStatement();
    }
}