<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190911174115 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ville_type_voyage DROP FOREIGN KEY FK_6548062DDC0FA4BF');
        $this->addSql('ALTER TABLE ville_type_voyage DROP PRIMARY KEY');
        $this->addSql('DROP INDEX IDX_6548062DDC0FA4BF ON ville_type_voyage');
        $this->addSql('ALTER TABLE ville_type_voyage CHANGE type_id type_voyage_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville_type_voyage ADD CONSTRAINT FK_6548062DDC0FA4BF FOREIGN KEY (type_voyage_id) REFERENCES type_voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville_type_voyage ADD PRIMARY KEY (ville_id, type_voyage_id)');
        $this->addSql('CREATE INDEX IDX_6548062DDC0FA4BF ON ville_type_voyage (type_voyage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ville_type_voyage DROP FOREIGN KEY FK_6548062DDC0FA4BF');
        $this->addSql('DROP INDEX IDX_6548062DDC0FA4BF ON ville_type_voyage');
        $this->addSql('ALTER TABLE ville_type_voyage DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE ville_type_voyage CHANGE type_voyage_id type_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville_type_voyage ADD CONSTRAINT FK_6548062DDC0FA4BF FOREIGN KEY (type_id) REFERENCES type_voyage (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_6548062DDC0FA4BF ON ville_type_voyage (type_id)');
        $this->addSql('ALTER TABLE ville_type_voyage ADD PRIMARY KEY (ville_id, type_id)');
    }
}
