<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200720122901 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Ajout des champs website et expired_on';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE projects ADD COLUMN website VARCHAR(255)');
        $this->addSql('ALTER TABLE projects ADD COLUMN expired_on DATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__projects AS SELECT id, name, description, target_amount FROM projects');
        $this->addSql('DROP TABLE projects');
        $this->addSql('CREATE TABLE projects (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255), description CLOB NOT NULL, target_amount NUMERIC(15, 2))');
        $this->addSql('INSERT INTO projects (id, name, description, target_amount) SELECT id, name, description, target_amount FROM __temp__projects');
        $this->addSql('DROP TABLE __temp__projects');
    }
}
