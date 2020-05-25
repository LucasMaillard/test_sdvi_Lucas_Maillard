<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525111831 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizza ADD ingredients_pizza_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pizza ADD CONSTRAINT FK_CFDD826FA5CE130B FOREIGN KEY (ingredients_pizza_id) REFERENCES ingredient_pizza (id)');
        $this->addSql('CREATE INDEX IDX_CFDD826FA5CE130B ON pizza (ingredients_pizza_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizza DROP FOREIGN KEY FK_CFDD826FA5CE130B');
        $this->addSql('DROP INDEX IDX_CFDD826FA5CE130B ON pizza');
        $this->addSql('ALTER TABLE pizza DROP ingredients_pizza_id');
    }
}
