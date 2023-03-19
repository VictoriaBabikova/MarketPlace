<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230318105728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seller (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, description VARCHAR(1000) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seller_product (seller_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_844BDBC8DE820D9 (seller_id), INDEX IDX_844BDBC4584665A (product_id), PRIMARY KEY(seller_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seller_product ADD CONSTRAINT FK_844BDBC8DE820D9 FOREIGN KEY (seller_id) REFERENCES seller (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE seller_product ADD CONSTRAINT FK_844BDBC4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seller_product DROP FOREIGN KEY FK_844BDBC8DE820D9');
        $this->addSql('ALTER TABLE seller_product DROP FOREIGN KEY FK_844BDBC4584665A');
        $this->addSql('DROP TABLE seller');
        $this->addSql('DROP TABLE seller_product');
    }
}
