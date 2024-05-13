<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510073455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE is_favorite (id INT AUTO_INCREMENT NOT NULL, real_estate_id_id INT DEFAULT NULL, favorite TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_FD6CF8DD9FC92D7C (real_estate_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE is_favorite_user (is_favorite_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2DE8E467B712568 (is_favorite_id), INDEX IDX_2DE8E46A76ED395 (user_id), PRIMARY KEY(is_favorite_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE is_favorite ADD CONSTRAINT FK_FD6CF8DD9FC92D7C FOREIGN KEY (real_estate_id_id) REFERENCES real_estate (id)');
        $this->addSql('ALTER TABLE is_favorite_user ADD CONSTRAINT FK_2DE8E467B712568 FOREIGN KEY (is_favorite_id) REFERENCES is_favorite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE is_favorite_user ADD CONSTRAINT FK_2DE8E46A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE is_favorite DROP FOREIGN KEY FK_FD6CF8DD9FC92D7C');
        $this->addSql('ALTER TABLE is_favorite_user DROP FOREIGN KEY FK_2DE8E467B712568');
        $this->addSql('ALTER TABLE is_favorite_user DROP FOREIGN KEY FK_2DE8E46A76ED395');
        $this->addSql('DROP TABLE is_favorite');
        $this->addSql('DROP TABLE is_favorite_user');
    }
}
