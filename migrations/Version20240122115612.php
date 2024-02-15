<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122115612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP main_picture');
        $this->addSql('ALTER TABLE vetements ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_10E9A46C12469DE2 ON vetements (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image ADD main_picture TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C12469DE2');
        $this->addSql('DROP INDEX IDX_10E9A46C12469DE2 ON vetements');
        $this->addSql('ALTER TABLE vetements DROP category_id');
    }
}
