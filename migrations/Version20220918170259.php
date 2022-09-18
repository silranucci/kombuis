<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918170259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE furniture_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE shelf_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE furniture (id INT NOT NULL, room_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_665DDAB354177093 ON furniture (room_id)');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, brand VARCHAR(255) DEFAULT NULL, days_is_good_after_opening VARCHAR(255) DEFAULT NULL, name VARCHAR(50) NOT NULL, safety_stock INT DEFAULT NULL, unit_of_measure VARCHAR(50) NOT NULL, total_quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.days_is_good_after_opening IS \'(DC2Type:dateinterval)\'');
        $this->addSql('CREATE TABLE product_item (id INT NOT NULL, product_id INT NOT NULL, shelf_id INT NOT NULL, opening_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, quantity INT NOT NULL, use_by_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_92F307BF4584665A ON product_item (product_id)');
        $this->addSql('CREATE INDEX IDX_92F307BF7C12FBC0 ON product_item (shelf_id)');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE shelf (id INT NOT NULL, furniture_id INT NOT NULL, shelf_number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A5475BE3CF5485C3 ON shelf (furniture_id)');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB354177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_item ADD CONSTRAINT FK_92F307BF4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_item ADD CONSTRAINT FK_92F307BF7C12FBC0 FOREIGN KEY (shelf_id) REFERENCES shelf (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE shelf ADD CONSTRAINT FK_A5475BE3CF5485C3 FOREIGN KEY (furniture_id) REFERENCES furniture (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE furniture_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE shelf_id_seq CASCADE');
        $this->addSql('ALTER TABLE furniture DROP CONSTRAINT FK_665DDAB354177093');
        $this->addSql('ALTER TABLE product_item DROP CONSTRAINT FK_92F307BF4584665A');
        $this->addSql('ALTER TABLE product_item DROP CONSTRAINT FK_92F307BF7C12FBC0');
        $this->addSql('ALTER TABLE shelf DROP CONSTRAINT FK_A5475BE3CF5485C3');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_item');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE shelf');
    }
}
