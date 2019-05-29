<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529084726 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prix ADD type_prix_id INT NOT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5EBC664D07 FOREIGN KEY (type_prix_id) REFERENCES price_type (id)');
        $this->addSql('CREATE INDEX IDX_F7EFEA5EBC664D07 ON prix (type_prix_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5EBC664D07');
        $this->addSql('DROP INDEX IDX_F7EFEA5EBC664D07 ON prix');
        $this->addSql('ALTER TABLE prix DROP type_prix_id');
    }
}
