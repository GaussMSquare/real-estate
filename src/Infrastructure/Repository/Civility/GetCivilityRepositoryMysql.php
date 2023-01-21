<?php

namespace App\Infrastructure\Repository\Civility;

use App\Domain\Exception\Civility\GetCivilityNotFoundException;
use App\Infrastructure\Repository\Database;
use Doctrine\DBAL\Connection;

class GetCivilityRepositoryMysql extends Database implements GetCivilityRepositoryInterface
{
    public function __construct(Connection $dbal)
    {
        parent::__construct($dbal);
    }

    public function getCivilities(): array
    {
        $this->queryBuilder->select('*')
            ->from(sprintf('%s',self::CIVILITY_TABLE_NAME))
        ;

        $stmt = $this->queryBuilder->executeQuery();

        if (!$rows = $stmt->fetchAllAssociative()) {
            throw new GetCivilityNotFoundException();
        }

        $civilities = [];

        foreach ($rows as $row) {
            $civilities[] = $row;
        }

        return $civilities;
    }
}