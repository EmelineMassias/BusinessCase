<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124131747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commandes_vetements (commandes_id INT NOT NULL, vetements_id INT NOT NULL, INDEX IDX_493134878BF5C2E6 (commandes_id), INDEX IDX_493134873431D455 (vetements_id), PRIMARY KEY(commandes_id, vetements_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes_vetements ADD CONSTRAINT FK_493134878BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commandes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commandes_vetements ADD CONSTRAINT FK_493134873431D455 FOREIGN KEY (vetements_id) REFERENCES vetements (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes_vetements DROP FOREIGN KEY FK_493134878BF5C2E6');
        $this->addSql('ALTER TABLE commandes_vetements DROP FOREIGN KEY FK_493134873431D455');
        $this->addSql('DROP TABLE commandes_vetements');
    }
}
