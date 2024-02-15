<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122113734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vetements_id INT NOT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, main_picture TINYINT(1) NOT NULL, INDEX IDX_C53D045F3431D455 (vetements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vetements (id INT AUTO_INCREMENT NOT NULL, main_picture_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_10E9A46CD6BDC9DC (main_picture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3431D455 FOREIGN KEY (vetements_id) REFERENCES vetements (id)');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CD6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES vetements (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3431D455');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CD6BDC9DC');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE vetements');
    }
}
