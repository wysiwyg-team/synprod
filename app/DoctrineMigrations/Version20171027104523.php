<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171027104523 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE package ADD package_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE package ADD CONSTRAINT FK_DE6867954A17E91F FOREIGN KEY (package_type_id) REFERENCES package_type (id)');
        $this->addSql('CREATE INDEX IDX_DE6867954A17E91F ON package (package_type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE package DROP FOREIGN KEY FK_DE6867954A17E91F');
        $this->addSql('DROP INDEX IDX_DE6867954A17E91F ON package');
        $this->addSql('ALTER TABLE package DROP package_type_id');
    }
}
