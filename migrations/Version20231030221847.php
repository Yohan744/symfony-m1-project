<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030221847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE theme ADD COLUMN name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__theme AS SELECT id, image, primary_color, secondary_color FROM theme');
        $this->addSql('DROP TABLE theme');
        $this->addSql('CREATE TABLE theme (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, image VARCHAR(255) NOT NULL, primary_color VARCHAR(255) NOT NULL, secondary_color VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO theme (id, image, primary_color, secondary_color) SELECT id, image, primary_color, secondary_color FROM __temp__theme');
        $this->addSql('DROP TABLE __temp__theme');
    }
}
