<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720091036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE announcement ADD contract_id_id INT NOT NULL, DROP type');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C3C450273 FOREIGN KEY (contract_id_id) REFERENCES contract (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C3C450273 ON announcement (contract_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C3C450273');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP INDEX IDX_4DB9D91C3C450273 ON announcement');
        $this->addSql('ALTER TABLE announcement ADD type VARCHAR(255) NOT NULL, DROP contract_id_id');
    }
}
