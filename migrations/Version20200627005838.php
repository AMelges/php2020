<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200627005838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clans CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE chieftainID chieftainID INT DEFAULT NULL');
        $this->addSql('DROP INDEX userID_UNIQUE ON clansmen');
        $this->addSql('ALTER TABLE clansmen DROP FOREIGN KEY fk_clansmen_clans1');
        $this->addSql('ALTER TABLE clansmen DROP FOREIGN KEY fk_clansmen_users1');
        $this->addSql('DROP INDEX fk_clansmen_clans1_idx ON clansmen');
        $this->addSql('CREATE INDEX IDX_19FFCFCFF2B94192 ON clansmen (clanID)');
        $this->addSql('DROP INDEX fk_clansmen_users1_idx ON clansmen');
        $this->addSql('CREATE INDEX IDX_19FFCFCF5FD86D04 ON clansmen (userID)');
        $this->addSql('ALTER TABLE clansmen ADD CONSTRAINT fk_clansmen_clans1 FOREIGN KEY (clanID) REFERENCES clans (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE clansmen ADD CONSTRAINT fk_clansmen_users1 FOREIGN KEY (userID) REFERENCES usersdata (ID) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP INDEX fk_inns_users1_idx ON inns');
        $this->addSql('ALTER TABLE inns CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE realmID realmID INT DEFAULT NULL, CHANGE innkeeperID innkeeperID INT DEFAULT NULL');
        $this->addSql('DROP INDEX fk_realms_users1_idx ON realms');
        $this->addSql('ALTER TABLE realms CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE kingID kingID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tables CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE innID innID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('DROP INDEX fk_users_credentials_idx ON usersdata');
        $this->addSql('ALTER TABLE usersdata CHANGE ID ID INT AUTO_INCREMENT NOT NULL, CHANGE userID userID INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clans CHANGE ID ID INT NOT NULL, CHANGE chieftainID chieftainID INT NOT NULL');
        $this->addSql('ALTER TABLE clansmen DROP FOREIGN KEY FK_19FFCFCFF2B94192');
        $this->addSql('ALTER TABLE clansmen DROP FOREIGN KEY FK_19FFCFCF5FD86D04');
        $this->addSql('CREATE UNIQUE INDEX userID_UNIQUE ON clansmen (userID)');
        $this->addSql('DROP INDEX idx_19ffcfcf5fd86d04 ON clansmen');
        $this->addSql('CREATE INDEX fk_clansmen_users1_idx ON clansmen (userID)');
        $this->addSql('DROP INDEX idx_19ffcfcff2b94192 ON clansmen');
        $this->addSql('CREATE INDEX fk_clansmen_clans1_idx ON clansmen (clanID)');
        $this->addSql('ALTER TABLE clansmen ADD CONSTRAINT FK_19FFCFCFF2B94192 FOREIGN KEY (clanID) REFERENCES clans (ID)');
        $this->addSql('ALTER TABLE clansmen ADD CONSTRAINT FK_19FFCFCF5FD86D04 FOREIGN KEY (userID) REFERENCES usersdata (ID)');
        $this->addSql('ALTER TABLE inns CHANGE ID ID INT NOT NULL, CHANGE realmID realmID INT NOT NULL, CHANGE innkeeperID innkeeperID INT NOT NULL');
        $this->addSql('CREATE INDEX fk_inns_users1_idx ON inns (innkeeperID)');
        $this->addSql('ALTER TABLE realms CHANGE ID ID INT NOT NULL, CHANGE kingID kingID INT NOT NULL');
        $this->addSql('CREATE INDEX fk_realms_users1_idx ON realms (kingID)');
        $this->addSql('ALTER TABLE tables CHANGE ID ID INT NOT NULL, CHANGE innID innID INT NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE ID ID INT NOT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE usersdata CHANGE ID ID INT NOT NULL, CHANGE userID userID INT NOT NULL');
        $this->addSql('CREATE INDEX fk_users_credentials_idx ON usersdata (userID)');
    }
}
