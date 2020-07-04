<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200703203859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial data for the website';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql(file_get_contents(__DIR__ . '/init_fouras.sql'));
    }

    public function down(Schema $schema) : void
    {
        $this->addSql(file_get_contents(__DIR__ . '/rollback_init_fouras.sql'));
    }
}
