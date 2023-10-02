<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231002134059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appart CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE appart ADD CONSTRAINT FK_E3F33249BF396750 FOREIGN KEY (id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE boat CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE boat ADD CONSTRAINT FK_D86E834ABF396750 FOREIGN KEY (id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE house CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE house ADD CONSTRAINT FK_67D5399DBF396750 FOREIGN KEY (id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD locationType VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tree_house CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE tree_house ADD CONSTRAINT FK_DFD71FF8BF396750 FOREIGN KEY (id) REFERENCES location (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appart DROP FOREIGN KEY FK_E3F33249BF396750');
        $this->addSql('ALTER TABLE appart CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE boat DROP FOREIGN KEY FK_D86E834ABF396750');
        $this->addSql('ALTER TABLE boat CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE house DROP FOREIGN KEY FK_67D5399DBF396750');
        $this->addSql('ALTER TABLE house CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE location DROP locationType');
        $this->addSql('ALTER TABLE tree_house DROP FOREIGN KEY FK_DFD71FF8BF396750');
        $this->addSql('ALTER TABLE tree_house CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
