<?php

namespace App\Infrastructure\Repository\MaritalStatus;

use App\Domain\Exception\MaritalStatus\GetMaritalStatusNotFoundException;
use App\Infrastructure\Repository\Database;
use Doctrine\DBAL\Connection;

class GetMaritalStatusRepositoryMysql extends Database implements GetMaritalStatusRepositoryInterface
{

    public function __construct(Connection $dbal)
    {
        parent::__construct($dbal);
    }

    public function getMaritalStatuses(): array
    {
        $this->queryBuilder->select('*')
            ->from(sprintf('%s',self::MARITAL_STATUS_TABLE_NAME))
        ;

        $stmt = $this->queryBuilder->executeQuery();

        if (!$rows = $stmt->fetchAllAssociative()) {
            throw new GetMaritalStatusNotFoundException();
        }

        $maritalStatuses = [];

        foreach ($rows as $row) {
            $maritalStatuses[] = $row;
        }

        return $maritalStatuses;
    }
}