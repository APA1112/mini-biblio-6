<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307074131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro CHANGE isbn isbn VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE socio ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, ADD is_admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE libro CHANGE isbn isbn VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE socio DROP email, DROP password, DROP is_admin');
    }
}
