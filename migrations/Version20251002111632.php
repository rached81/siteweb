<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251002111632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', expires_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE response (id INT AUTO_INCREMENT NOT NULL, contact_id INT DEFAULT NULL, user_id INT DEFAULT NULL, object VARCHAR(255) DEFAULT NULL, response LONGTEXT NOT NULL, submited TINYINT(1) NOT NULL, INDEX IDX_3E7B0BFBE7A1254A (contact_id), INDEX IDX_3E7B0BFBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES admin (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBE7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE response ADD CONSTRAINT FK_3E7B0BFBA76ED395 FOREIGN KEY (user_id) REFERENCES admin (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin ADD password_changed_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', ADD must_change_password TINYINT(1) NOT NULL DEFAULT 0
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `primary` ON profile_category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE profile_category ADD PRIMARY KEY (category_id, profile_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE time_line ADD article_type VARCHAR(10) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBE7A1254A
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE response DROP FOREIGN KEY FK_3E7B0BFBA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reset_password_request
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE response
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE admin DROP password_changed_at, DROP must_change_password
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX `PRIMARY` ON profile_category
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE profile_category ADD PRIMARY KEY (profile_id, category_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE time_line DROP article_type
        SQL);
    }
}
