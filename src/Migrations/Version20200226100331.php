<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200226100331 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trilib_distance_monument CHANGE id_trilib id_trilib INT DEFAULT NULL, CHANGE id_monuments id_monuments INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE id_country id_country INT DEFAULT NULL');
        $this->addSql('ALTER TABLE velib_distance_monument CHANGE id_velib id_velib INT DEFAULT NULL, CHANGE id_monuments id_monuments INT DEFAULT NULL');
        $this->addSql('ALTER TABLE electricterminal_distance_monument CHANGE id_electricterminal id_electricterminal INT DEFAULT NULL, CHANGE id_monuments id_monuments INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trimobile_distance_monument CHANGE id_trimobile id_trimobile INT DEFAULT NULL, CHANGE id_monuments id_monuments INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE electricterminal_distance_monument CHANGE id_electricterminal id_electricterminal INT NOT NULL, CHANGE id_monuments id_monuments INT NOT NULL');
        $this->addSql('ALTER TABLE trilib_distance_monument CHANGE id_monuments id_monuments INT NOT NULL, CHANGE id_trilib id_trilib INT NOT NULL');
        $this->addSql('ALTER TABLE trimobile_distance_monument CHANGE id_monuments id_monuments INT NOT NULL, CHANGE id_trimobile id_trimobile INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE id_country id_country INT NOT NULL');
        $this->addSql('ALTER TABLE velib_distance_monument CHANGE id_monuments id_monuments INT NOT NULL, CHANGE id_velib id_velib INT NOT NULL');
    }
}
