<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002115608 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_detail (id INT AUTO_INCREMENT NOT NULL, bed_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_6F48B95288688BB9 (bed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room_detail ADD CONSTRAINT FK_6F48B95288688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_detail DROP FOREIGN KEY FK_6F48B95288688BB9');
        $this->addSql('DROP TABLE room_detail');
    }
}
