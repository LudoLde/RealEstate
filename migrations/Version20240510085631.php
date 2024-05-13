<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240510085631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE is_favourite (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, real_estate_id_id INT DEFAULT NULL, favourite TINYINT(1) DEFAULT NULL, INDEX IDX_655AA7769D86650F (user_id_id), INDEX IDX_655AA7769FC92D7C (real_estate_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE is_favourite ADD CONSTRAINT FK_655AA7769D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE is_favourite ADD CONSTRAINT FK_655AA7769FC92D7C FOREIGN KEY (real_estate_id_id) REFERENCES real_estate (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE is_favourite DROP FOREIGN KEY FK_655AA7769D86650F');
        $this->addSql('ALTER TABLE is_favourite DROP FOREIGN KEY FK_655AA7769FC92D7C');
        $this->addSql('DROP TABLE is_favourite');
    }
}
