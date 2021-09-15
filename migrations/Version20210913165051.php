<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210913165051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service ADD seo_text LONGTEXT DEFAULT NULL, ADD seo_text_hidden LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE subcategory CHANGE category_section_id_id category_section_id_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP seo_text, DROP seo_text_hidden');
        $this->addSql('ALTER TABLE subcategory CHANGE category_section_id_id category_section_id_id INT DEFAULT NULL');
    }
}
