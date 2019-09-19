<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919032102 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact ADD categories_id INT DEFAULT NULL, ADD cibles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A21214B7 FOREIGN KEY (categories_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6389E046BDF FOREIGN KEY (cibles_id) REFERENCES cible (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638A21214B7 ON contact (categories_id)');
        $this->addSql('CREATE INDEX IDX_4C62E6389E046BDF ON contact (cibles_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A21214B7');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6389E046BDF');
        $this->addSql('DROP INDEX IDX_4C62E638A21214B7 ON contact');
        $this->addSql('DROP INDEX IDX_4C62E6389E046BDF ON contact');
        $this->addSql('ALTER TABLE contact DROP categories_id, DROP cibles_id');
    }
}
