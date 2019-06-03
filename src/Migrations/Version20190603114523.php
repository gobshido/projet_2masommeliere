<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603114523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prix_targetprice (prix_id INT NOT NULL, targetprice_id INT NOT NULL, INDEX IDX_20E67C13944722F2 (prix_id), INDEX IDX_20E67C1369349FF1 (targetprice_id), PRIMARY KEY(prix_id, targetprice_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prix_targetprice ADD CONSTRAINT FK_20E67C13944722F2 FOREIGN KEY (prix_id) REFERENCES prix (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prix_targetprice ADD CONSTRAINT FK_20E67C1369349FF1 FOREIGN KEY (targetprice_id) REFERENCES targetprice (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE prix_targetprice');
    }
}
