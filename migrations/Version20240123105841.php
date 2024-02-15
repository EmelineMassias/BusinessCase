<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123105841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, vetements_id INT NOT NULL, src VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_C53D045F3431D455 (vetements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3431D455 FOREIGN KEY (vetements_id) REFERENCES vetements (id)');
        $this->addSql('ALTER TABLE user ADD numero_rue INT DEFAULT NULL, ADD rue VARCHAR(255) DEFAULT NULL, ADD cp VARCHAR(255) DEFAULT NULL, ADD ville VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vetements ADD main_picture_id INT DEFAULT NULL, ADD image VARCHAR(255) NOT NULL, ADD prestation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CD6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10E9A46CD6BDC9DC ON vetements (main_picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CD6BDC9DC');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3431D455');
        $this->addSql('DROP TABLE image');
        $this->addSql('ALTER TABLE user DROP numero_rue, DROP rue, DROP cp, DROP ville');
        $this->addSql('DROP INDEX UNIQ_10E9A46CD6BDC9DC ON vetements');
        $this->addSql('ALTER TABLE vetements DROP main_picture_id, DROP image, DROP prestation');
    }
}
