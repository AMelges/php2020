<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200627012345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages CHANGE ID ID INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX ID_UNIQUE ON messages (ID)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX ID_UNIQUE ON messages');
        $this->addSql('ALTER TABLE messages CHANGE ID ID INT AUTO_INCREMENT NOT NULL');
    }
}
