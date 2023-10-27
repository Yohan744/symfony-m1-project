<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026141417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, town_hall_id INTEGER NOT NULL, theme_id INTEGER NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, xp_level INTEGER NOT NULL, coins INTEGER NOT NULL, CONSTRAINT FK_8D93D6495C442B0F FOREIGN KEY (town_hall_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8D93D6495C442B0F ON user (town_hall_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64959027487 ON user (theme_id)');
        $this->addSql('CREATE TABLE user_building (user_id INTEGER NOT NULL, building_id INTEGER NOT NULL, PRIMARY KEY(user_id, building_id), CONSTRAINT FK_1E285D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E285D44D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1E285D4A76ED395 ON user_building (user_id)');
        $this->addSql('CREATE INDEX IDX_1E285D44D2A7E12 ON user_building (building_id)');
        $this->addSql('ALTER TABLE building ADD COLUMN level INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_building');
        $this->addSql('CREATE TEMPORARY TABLE __temp__building AS SELECT id, name, description FROM building');
        $this->addSql('DROP TABLE building');
        $this->addSql('CREATE TABLE building (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO building (id, name, description) SELECT id, name, description FROM __temp__building');
        $this->addSql('DROP TABLE __temp__building');
    }
}
