<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130162540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shortened_url (id INT AUTO_INCREMENT NOT NULL, strategy_id INT NOT NULL, hash VARCHAR(15) NOT NULL, long_url VARCHAR(255) NOT NULL, visits INT NOT NULL, last_visit DATETIME DEFAULT NULL, INDEX IDX_559BBCF7D5CAD932 (strategy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shortened_url ADD CONSTRAINT FK_559BBCF7D5CAD932 FOREIGN KEY (strategy_id) REFERENCES strategy (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE shortened_url');
    }
}
