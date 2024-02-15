<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124130950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetements ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vetements ADD CONSTRAINT FK_10E9A46C8BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE INDEX IDX_10E9A46C8BF5C2E6 ON vetements (commandes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vetements DROP FOREIGN KEY FK_10E9A46C8BF5C2E6');
        $this->addSql('DROP INDEX IDX_10E9A46C8BF5C2E6 ON vetements');
        $this->addSql('ALTER TABLE vetements DROP commandes_id');
    }
}
