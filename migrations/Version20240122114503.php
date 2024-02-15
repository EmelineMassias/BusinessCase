<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122114503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetements ADD main_picture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46CD6BDC9DC FOREIGN KEY (main_picture_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10E9A46CD6BDC9DC ON vetements (main_picture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46CD6BDC9DC');
        $this->addSql('DROP INDEX UNIQ_10E9A46CD6BDC9DC ON vetements');
        $this->addSql('ALTER TABLE vetements DROP main_picture_id');
    }
}
