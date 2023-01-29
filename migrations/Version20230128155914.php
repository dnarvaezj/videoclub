<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230128155914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alquileres_peliculas (alquileres_id INT NOT NULL, peliculas_id INT NOT NULL, INDEX IDX_ABCB6F3F873D01D1 (alquileres_id), INDEX IDX_ABCB6F3F9EDD74B8 (peliculas_id), PRIMARY KEY(alquileres_id, peliculas_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alquileres_peliculas ADD CONSTRAINT FK_ABCB6F3F873D01D1 FOREIGN KEY (alquileres_id) REFERENCES alquileres (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alquileres_peliculas ADD CONSTRAINT FK_ABCB6F3F9EDD74B8 FOREIGN KEY (peliculas_id) REFERENCES peliculas (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alquileres ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE alquileres ADD CONSTRAINT FK_4060DBBFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4060DBBFA76ED395 ON alquileres (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alquileres_peliculas DROP FOREIGN KEY FK_ABCB6F3F873D01D1');
        $this->addSql('ALTER TABLE alquileres_peliculas DROP FOREIGN KEY FK_ABCB6F3F9EDD74B8');
        $this->addSql('DROP TABLE alquileres_peliculas');
        $this->addSql('ALTER TABLE alquileres DROP FOREIGN KEY FK_4060DBBFA76ED395');
        $this->addSql('DROP INDEX IDX_4060DBBFA76ED395 ON alquileres');
        $this->addSql('ALTER TABLE alquileres DROP user_id');
    }
}
