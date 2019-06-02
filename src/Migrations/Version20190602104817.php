<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602104817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE prestation_module (prestation_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_96591ED59E45C554 (prestation_id), INDEX IDX_96591ED5AFC2B591 (module_id), PRIMARY KEY(prestation_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_cible (prestation_id INT NOT NULL, cible_id INT NOT NULL, INDEX IDX_23D6A7BA9E45C554 (prestation_id), INDEX IDX_23D6A7BAA96E5E09 (cible_id), PRIMARY KEY(prestation_id, cible_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestation_module ADD CONSTRAINT FK_96591ED59E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_module ADD CONSTRAINT FK_96591ED5AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_cible ADD CONSTRAINT FK_23D6A7BA9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_cible ADD CONSTRAINT FK_23D6A7BAA96E5E09 FOREIGN KEY (cible_id) REFERENCES cible (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADBCF5E72D ON prestation (categorie_id)');
        $this->addSql('ALTER TABLE prix ADD prestation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prix ADD CONSTRAINT FK_F7EFEA5E9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_F7EFEA5E9E45C554 ON prix (prestation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE prestation_module');
        $this->addSql('DROP TABLE prestation_cible');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADBCF5E72D');
        $this->addSql('DROP INDEX IDX_51C88FADBCF5E72D ON prestation');
        $this->addSql('ALTER TABLE prestation DROP categorie_id');
        $this->addSql('ALTER TABLE prix DROP FOREIGN KEY FK_F7EFEA5E9E45C554');
        $this->addSql('DROP INDEX IDX_F7EFEA5E9E45C554 ON prix');
        $this->addSql('ALTER TABLE prix DROP prestation_id');
    }
}
