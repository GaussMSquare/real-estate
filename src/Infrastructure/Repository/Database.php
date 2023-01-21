<?php

namespace App\Infrastructure\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Database
{
    protected const SUBSCRIBER_TABLE_NAME = 'subscriber';
    protected const COUNTRY_TABLE_NAME = 'country';
    protected const CIVILITY_TABLE_NAME = 'civility';
    protected const MARITAL_STATUS_TABLE_NAME = 'marital_status';

    protected Connection $dbal;

    protected QueryBuilder $queryBuilder;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
        $this->queryBuilder = $this->dbal->createQueryBuilder();
    }
}