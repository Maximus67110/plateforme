<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002120323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_detail ADD room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room_detail ADD CONSTRAINT FK_6F48B95254177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_6F48B95254177093 ON room_detail (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE room_detail DROP FOREIGN KEY FK_6F48B95254177093');
        $this->addSql('DROP INDEX IDX_6F48B95254177093 ON room_detail');
        $this->addSql('ALTER TABLE room_detail DROP room_id');
    }
}
