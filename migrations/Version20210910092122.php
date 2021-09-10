<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210910092122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_section (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EAAB3A919777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_section ADD CONSTRAINT FK_EAAB3A919777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE subcategory ADD category_section_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA448F6C8DC78 FOREIGN KEY (category_section_id_id) REFERENCES category_section (id)');
        //$this->addSql('CREATE INDEX IDX_DDCA448F6C8DC78 ON subcategory (category_section_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA448F6C8DC78');
        $this->addSql('DROP TABLE category_section');
        $this->addSql('DROP INDEX IDX_DDCA448F6C8DC78 ON subcategory');
        $this->addSql('ALTER TABLE subcategory DROP category_section_id_id');
    }
}
