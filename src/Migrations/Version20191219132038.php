<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191219132038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE eloigner DROP distance_km');
        $this->addSql('ALTER TABLE eloigner RENAME INDEX eloigner_electricterminal0_fk TO IDX_9E8659F6D3E2FC8C');
        $this->addSql('ALTER TABLE espacer DROP distance_km');
        $this->addSql('ALTER TABLE espacer RENAME INDEX espacer_trimobile0_fk TO IDX_5F0C4971B69927C8');
        $this->addSql('ALTER TABLE etre DROP distance_km');
        $this->addSql('ALTER TABLE etre RENAME INDEX etre_velib0_fk TO IDX_5E95960248346AD');
        $this->addSql('ALTER TABLE distance DROP distance_km');
        $this->addSql('ALTER TABLE distance RENAME INDEX distance_monuments0_fk TO IDX_1C929A812B636E16');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE distance ADD distance_km DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE distance RENAME INDEX idx_1c929a812b636e16 TO distance_monuments0_FK');
        $this->addSql('ALTER TABLE eloigner ADD distance_km DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE eloigner RENAME INDEX idx_9e8659f6d3e2fc8c TO eloigner_electricterminal0_FK');
        $this->addSql('ALTER TABLE espacer ADD distance_km DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE espacer RENAME INDEX idx_5f0c4971b69927c8 TO espacer_trimobile0_FK');
        $this->addSql('ALTER TABLE etre ADD distance_km DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE etre RENAME INDEX idx_5e95960248346ad TO etre_velib0_FK');
    }
}
