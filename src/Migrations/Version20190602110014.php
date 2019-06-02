<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602110014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E2DA24B30');
        $this->addSql('DROP INDEX IDX_F7EFEA5E2DA24B30 ON prix');
        $this->addSql('ALTER TABLE prix CHANGE targetprices_id targetprice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E69349FF1 FOREIGN KEY (targetprice_id) REFERENCES targetprice (id)');
        $this->addSql('CREATE INDEX IDX_F7EFEA5E69349FF1 ON prix (targetprice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E69349FF1');
        $this->addSql('DROP INDEX IDX_F7EFEA5E69349FF1 ON prix');
        $this->addSql('ALTER TABLE prix CHANGE targetprice_id targetprices_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E2DA24B30 FOREIGN KEY (targetprices_id) REFERENCES targetprice (id)');
        $this->addSql('CREATE INDEX IDX_F7EFEA5E2DA24B30 ON prix (targetprices_id)');
    }
}
