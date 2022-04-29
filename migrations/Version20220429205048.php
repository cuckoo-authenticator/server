<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429205048 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE secret (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', name VARCHAR(255) NOT NULL, secret_key VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_5CA2E8E5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id BINARY(16) NOT NULL COMMENT \'(DC2Type:ulid)\', authentication_token VARCHAR(64) DEFAULT NULL, wrapped_vault_key VARCHAR(56) DEFAULT NULL, is_registered TINYINT(1) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_registration_request (id INT AUTO_INCREMENT NOT NULL, user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:ulid)\', csrf_protection_token VARCHAR(64) NOT NULL, expires_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_C5C70946A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_registration_request ADD CONSTRAINT FK_C5C70946A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE secret DROP FOREIGN KEY FK_5CA2E8E5A76ED395');
        $this->addSql('ALTER TABLE user_registration_request DROP FOREIGN KEY FK_C5C70946A76ED395');
        $this->addSql('DROP TABLE secret');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_registration_request');
    }
}
