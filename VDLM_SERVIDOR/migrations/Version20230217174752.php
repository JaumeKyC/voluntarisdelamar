<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217174752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ACTIVIDADES (id INT AUTO_INCREMENT NOT NULL, ES_FORMACION TINYINT(1) NOT NULL, NOMBRE VARCHAR(255) NOT NULL, FECHA_INICIO DATE NOT NULL, HORA_INICIO TIME NOT NULL, UBICACION VARCHAR(255) NOT NULL, ENTIDAD_ORGANIZADORA VARCHAR(255) NOT NULL, NUM_EMBARCACIONES INT NOT NULL, NUM_MOTOS INT NOT NULL, NUM_PATRONES INT NOT NULL, NUM_TRIPULANTES INT NOT NULL, NUM_SOCORRISTAS INT NOT NULL, OBSERVACIONES VARCHAR(500) DEFAULT NULL, VOLUNTARIOS INT NOT NULL, MAX_VOLUNTARIOS INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE actividades_user (actividades_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3783CA562F4F3E2F (actividades_id), INDEX IDX_3783CA56A76ED395 (user_id), PRIMARY KEY(actividades_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE USER (id INT AUTO_INCREMENT NOT NULL, EMAIL VARCHAR(180) NOT NULL, NOMBRE VARCHAR(255) NOT NULL, APELLIDOS VARCHAR(255) NOT NULL, DNI VARCHAR(9) NOT NULL, FECHA_NACIMIENTO DATE NOT NULL, TELEFONO VARCHAR(9) NOT NULL, DIRECCION VARCHAR(255) DEFAULT NULL, POBLACION VARCHAR(255) DEFAULT NULL, COD_POSTAL VARCHAR(50) DEFAULT NULL, PROVINCIA VARCHAR(255) DEFAULT NULL, FECHA_ALTA DATE NOT NULL, CAMISETA VARCHAR(255) DEFAULT NULL, FICHA_SEPA VARCHAR(255) DEFAULT NULL, VOLUN_LA_CAIXA VARCHAR(255) DEFAULT NULL, IBAN VARCHAR(40) DEFAULT NULL, TITULACIONES VARCHAR(500) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_BB063BFD10C6BEC4 (EMAIL), UNIQUE INDEX UNIQ_BB063BFDE92867B1 (DNI), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actividades_user ADD CONSTRAINT FK_3783CA562F4F3E2F FOREIGN KEY (actividades_id) REFERENCES ACTIVIDADES (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE actividades_user ADD CONSTRAINT FK_3783CA56A76ED395 FOREIGN KEY (user_id) REFERENCES USER (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actividades_user DROP FOREIGN KEY FK_3783CA562F4F3E2F');
        $this->addSql('ALTER TABLE actividades_user DROP FOREIGN KEY FK_3783CA56A76ED395');
        $this->addSql('DROP TABLE ACTIVIDADES');
        $this->addSql('DROP TABLE actividades_user');
        $this->addSql('DROP TABLE USER');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
