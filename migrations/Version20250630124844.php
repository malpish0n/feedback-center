<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630124844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_meta (id SERIAL NOT NULL, app_user_id INT NOT NULL, key VARCHAR(255) NOT NULL, value TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD7358FC4A3353D8 ON user_meta (app_user_id)');
        $this->addSql('ALTER TABLE user_meta ADD CONSTRAINT FK_AD7358FC4A3353D8 FOREIGN KEY (app_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_meta DROP CONSTRAINT FK_AD7358FC4A3353D8');
        $this->addSql('DROP TABLE user_meta');
    }
}
