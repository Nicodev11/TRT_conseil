<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230722113104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement ADD CONSTRAINT FK_4DB9D91C9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4DB9D91C9D86650F ON announcement (user_id_id)');
        $this->addSql('ALTER TABLE candidacies ADD candidacie_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidacies ADD CONSTRAINT FK_CA9ED74DD30E6475 FOREIGN KEY (candidacie_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CA9ED74DD30E6475 ON candidacies (candidacie_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9C7CD36F2');
        $this->addSql('DROP INDEX IDX_1483A5E9C7CD36F2 ON users');
        $this->addSql('ALTER TABLE users DROP candidacies_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE announcement DROP FOREIGN KEY FK_4DB9D91C9D86650F');
        $this->addSql('DROP INDEX IDX_4DB9D91C9D86650F ON announcement');
        $this->addSql('ALTER TABLE candidacies DROP FOREIGN KEY FK_CA9ED74DD30E6475');
        $this->addSql('DROP INDEX UNIQ_CA9ED74DD30E6475 ON candidacies');
        $this->addSql('ALTER TABLE candidacies DROP candidacie_id');
        $this->addSql('ALTER TABLE users ADD candidacies_id INT NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9C7CD36F2 FOREIGN KEY (candidacies_id) REFERENCES candidacies (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1483A5E9C7CD36F2 ON users (candidacies_id)');
    }
}
