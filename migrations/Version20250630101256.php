<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630101256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feedback (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE groups (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE home_page_content (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE image (id SERIAL NOT NULL, home_page_content_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045F18123323 ON image (home_page_content_id)');
        $this->addSql('CREATE TABLE post (id SERIAL NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, tags VARCHAR(255) NOT NULL, type VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DF675F31B ON post (author_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nickname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_8F02BF9DA76ED395 ON user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_8F02BF9DFE54D947 ON user_group (group_id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F18123323 FOREIGN KEY (home_page_content_id) REFERENCES home_page_content (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F18123323');
        $this->addSql('ALTER TABLE post DROP CONSTRAINT FK_5A8A6C8DF675F31B');
        $this->addSql('ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DA76ED395');
        $this->addSql('ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DFE54D947');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE home_page_content');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_group');
    }
}
