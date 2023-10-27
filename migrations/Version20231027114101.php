<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231027114101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, town_hall_id, theme_id, password, xp_level, coins FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, town_hall_id INTEGER NOT NULL, theme_id INTEGER NOT NULL, password VARCHAR(255) NOT NULL, xp_level INTEGER NOT NULL, coins INTEGER NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , CONSTRAINT FK_8D93D6495C442B0F FOREIGN KEY (town_hall_id) REFERENCES building (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, town_hall_id, theme_id, password, xp_level, coins) SELECT id, town_hall_id, theme_id, password, xp_level, coins FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D64959027487 ON user (theme_id)');
        $this->addSql('CREATE INDEX IDX_8D93D6495C442B0F ON user (town_hall_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, town_hall_id, theme_id, password, xp_level, coins FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, town_hall_id INTEGER NOT NULL, theme_id INTEGER NOT NULL, password VARCHAR(255) NOT NULL, xp_level INTEGER NOT NULL, coins INTEGER NOT NULL, username VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D6495C442B0F FOREIGN KEY (town_hall_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, town_hall_id, theme_id, password, xp_level, coins) SELECT id, town_hall_id, theme_id, password, xp_level, coins FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE INDEX IDX_8D93D6495C442B0F ON user (town_hall_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64959027487 ON user (theme_id)');
    }
}
