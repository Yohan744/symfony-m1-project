<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026080917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE building (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, level INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE building_state (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER NOT NULL, level INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL, upgrade_reward INTEGER NOT NULL, upgrade_cost INTEGER NOT NULL, CONSTRAINT FK_CF3363614D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CF3363614D2A7E12 ON building_state (building_id)');
        $this->addSql('CREATE TABLE condition (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, building_id INTEGER NOT NULL, linked_building_id INTEGER NOT NULL, level_required INTEGER NOT NULL, CONSTRAINT FK_BDD688434D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_BDD68843A5056EFA FOREIGN KEY (linked_building_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_BDD688434D2A7E12 ON condition (building_id)');
        $this->addSql('CREATE INDEX IDX_BDD68843A5056EFA ON condition (linked_building_id)');
        $this->addSql('CREATE TABLE theme (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, image VARCHAR(255) NOT NULL, primary_color VARCHAR(255) NOT NULL, secondary_color VARCHAR(255) NOT NULL, name VARCHAR(255))');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        // --(DC2Type:json)
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, roles CLOB NOT NULL,  town_hall_id INTEGER, theme_id INTEGER , email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, xp_level INTEGER NOT NULL, xp_points INTEGER NOT NULL, coins INTEGER NOT NULL, CONSTRAINT FK_8D93D6495C442B0F FOREIGN KEY (town_hall_id) REFERENCES building (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_8D93D64959027487 FOREIGN KEY (theme_id) REFERENCES theme (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8D93D6495C442B0F ON user (town_hall_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64959027487 ON user (theme_id)');

        $this->addSql('CREATE TABLE user_building (user_id INTEGER NOT NULL, building_id INTEGER NOT NULL, PRIMARY KEY(user_id, building_id), CONSTRAINT FK_1E285D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1E285D44D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_1E285D4A76ED395 ON user_building (user_id)');
        $this->addSql('CREATE INDEX IDX_1E285D44D2A7E12 ON user_building (building_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE building_state');
        $this->addSql('DROP TABLE condition');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
