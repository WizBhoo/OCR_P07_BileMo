<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605110211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_user (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name VARCHAR(50) NOT NULL, username VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_5C0F152BF85E0677 (username), UNIQUE INDEX UNIQ_5C0F152BE7927C74 (email), INDEX IDX_5C0F152B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(50) NOT NULL, model VARCHAR(50) NOT NULL, color VARCHAR(15) NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_C74404555E237E06 (name), UNIQUE INDEX UNIQ_C7440455E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_user ADD CONSTRAINT FK_5C0F152B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_user DROP FOREIGN KEY FK_5C0F152B19EB6921');
        $this->addSql('DROP TABLE client_user');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE client');
    }
}
