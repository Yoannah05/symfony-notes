<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126075527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id SERIAL NOT NULL, identifiant VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, dtn DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE inscription (id SERIAL NOT NULL, date_inscription DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE inscription_etudiant (inscription_id INT NOT NULL, etudiant_id INT NOT NULL, PRIMARY KEY(inscription_id, etudiant_id))');
        $this->addSql('CREATE INDEX IDX_D8EB5D465DAC5993 ON inscription_etudiant (inscription_id)');
        $this->addSql('CREATE INDEX IDX_D8EB5D46DDEAB1A3 ON inscription_etudiant (etudiant_id)');
        $this->addSql('CREATE TABLE inscription_semestre (inscription_id INT NOT NULL, semestre_id INT NOT NULL, PRIMARY KEY(inscription_id, semestre_id))');
        $this->addSql('CREATE INDEX IDX_D8FDF0195DAC5993 ON inscription_semestre (inscription_id)');
        $this->addSql('CREATE INDEX IDX_D8FDF0195577AFDB ON inscription_semestre (semestre_id)');
        $this->addSql('CREATE TABLE note (id SERIAL NOT NULL, valeur NUMERIC(5, 2) NOT NULL, session DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE note_etudiant (note_id INT NOT NULL, etudiant_id INT NOT NULL, PRIMARY KEY(note_id, etudiant_id))');
        $this->addSql('CREATE INDEX IDX_6125FE7D26ED0855 ON note_etudiant (note_id)');
        $this->addSql('CREATE INDEX IDX_6125FE7DDDEAB1A3 ON note_etudiant (etudiant_id)');
        $this->addSql('CREATE TABLE note_matiere (note_id INT NOT NULL, matiere_id INT NOT NULL, PRIMARY KEY(note_id, matiere_id))');
        $this->addSql('CREATE INDEX IDX_11B293D026ED0855 ON note_matiere (note_id)');
        $this->addSql('CREATE INDEX IDX_11B293D0F46CD258 ON note_matiere (matiere_id)');
        $this->addSql('ALTER TABLE inscription_etudiant ADD CONSTRAINT FK_D8EB5D465DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscription_etudiant ADD CONSTRAINT FK_D8EB5D46DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF0195DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscription_semestre ADD CONSTRAINT FK_D8FDF0195577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note_etudiant ADD CONSTRAINT FK_6125FE7D26ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note_etudiant ADD CONSTRAINT FK_6125FE7DDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note_matiere ADD CONSTRAINT FK_11B293D026ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note_matiere ADD CONSTRAINT FK_11B293D0F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere ALTER code TYPE VARCHAR(20)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inscription_etudiant DROP CONSTRAINT FK_D8EB5D465DAC5993');
        $this->addSql('ALTER TABLE inscription_etudiant DROP CONSTRAINT FK_D8EB5D46DDEAB1A3');
        $this->addSql('ALTER TABLE inscription_semestre DROP CONSTRAINT FK_D8FDF0195DAC5993');
        $this->addSql('ALTER TABLE inscription_semestre DROP CONSTRAINT FK_D8FDF0195577AFDB');
        $this->addSql('ALTER TABLE note_etudiant DROP CONSTRAINT FK_6125FE7D26ED0855');
        $this->addSql('ALTER TABLE note_etudiant DROP CONSTRAINT FK_6125FE7DDDEAB1A3');
        $this->addSql('ALTER TABLE note_matiere DROP CONSTRAINT FK_11B293D026ED0855');
        $this->addSql('ALTER TABLE note_matiere DROP CONSTRAINT FK_11B293D0F46CD258');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscription_etudiant');
        $this->addSql('DROP TABLE inscription_semestre');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE note_etudiant');
        $this->addSql('DROP TABLE note_matiere');
        $this->addSql('ALTER TABLE matiere ALTER code TYPE VARCHAR(255)');
    }
}
