<?php

namespace App\Infrastructure\Repository\Country;

use App\Domain\Exception\Country\GetCountryNotFoundException;
use App\Domain\Model\Country\CountryModel;
use App\Infrastructure\Repository\Database;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class GetCountryRepositoryMysql extends Database implements GetCountryRepositoryInterface
{
    public function __construct(Connection $dbal)
    {
        parent::__construct($dbal);
    }

    /**
     * @throws Exception
     */
    public function getCountries(): array
    {
        $this->queryBuilder->select('*')
            ->from(sprintf('%s',self::COUNTRY_TABLE_NAME))
        ;

        $stmt = $this->queryBuilder->executeQuery();

        if (!$rows = $stmt->fetchAllAssociative()) {
            throw new GetCountryNotFoundException();
        }

        $countries = [];

        foreach ($rows as $row) {
            $countries[] = $row;
        }

        return $countries;
    }
}