<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230722111847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C9D86650F ON announcement (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C9D86650F');
        $this->addSql('DROP INDEX IDX_4DB9D91C9D86650F ON announcement');
        $this->addSql('ALTER TABLE announcement DROP user_id_id');
    }
}
