<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630091918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP SEQUENCE group_id_seq CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE group_table (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user_group (user_id INT NOT NULL, group_id INT NOT NULL, PRIMARY KEY(user_id, group_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F02BF9DA76ED395 ON user_group (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_8F02BF9DFE54D947 ON user_group (group_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9DFE54D947 FOREIGN KEY (group_id) REFERENCES group_table (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "group"
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            CREATE SEQUENCE group_id_seq INCREMENT BY 1 MINVALUE 1 START 1
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "group" (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE user_group DROP CONSTRAINT FK_8F02BF9DFE54D947
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE group_table
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user_group
        SQL);
    }
}
