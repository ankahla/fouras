<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240702112029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(file_get_contents(__DIR__ . '/init_fouras.sql'));

    }

    public function down(Schema $schema): void
    {
        $this->addSql(file_get_contents(__DIR__ . '/rollback_init_fouras.sql'));

    }
}
