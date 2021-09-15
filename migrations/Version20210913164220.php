<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210913164220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, subcategory_id_id INT DEFAULT NULL, h1 VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, seo_img VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) NOT NULL, INDEX IDX_E19D9AD2F78A56EE (subcategory_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2F78A56EE FOREIGN KEY (subcategory_id_id) REFERENCES subcategory (id)');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY subcategory_ibfk_1');
        $this->addSql('ALTER TABLE subcategory CHANGE category_section_id_id category_section_id_id INT NOT NULL');
        $this->addSql('DROP INDEX category_section_id_id ON subcategory');
        $this->addSql('CREATE INDEX IDX_DDCA448F6C8DC78 ON subcategory (category_section_id_id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT subcategory_ibfk_1 FOREIGN KEY (category_section_id_id) REFERENCES category_section (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE service');
        $this->addSql('ALTER TABLE subcategory DROP FOREIGN KEY FK_DDCA448F6C8DC78');
        $this->addSql('ALTER TABLE subcategory CHANGE category_section_id_id category_section_id_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX idx_ddca448f6c8dc78 ON subcategory');
        $this->addSql('CREATE INDEX category_section_id_id ON subcategory (category_section_id_id)');
        $this->addSql('ALTER TABLE subcategory ADD CONSTRAINT FK_DDCA448F6C8DC78 FOREIGN KEY (category_section_id_id) REFERENCES category_section (id)');
    }
}
