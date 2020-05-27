<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526113412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pizza_pizzeria (pizza_id INT NOT NULL, pizzeria_id INT NOT NULL, INDEX IDX_8D2EEC7FD41D1D42 (pizza_id), INDEX IDX_8D2EEC7FF1965E46 (pizzeria_id), PRIMARY KEY(pizza_id, pizzeria_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pizza_pizzeria ADD CONSTRAINT FK_8D2EEC7FD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pizza_pizzeria ADD CONSTRAINT FK_8D2EEC7FF1965E46 FOREIGN KEY (pizzeria_id) REFERENCES pizzeria (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredient_pizza ADD pizza_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient_pizza ADD CONSTRAINT FK_D6EFE5AED41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id)');
        $this->addSql('CREATE INDEX IDX_D6EFE5AED41D1D42 ON ingredient_pizza (pizza_id)');
        $this->addSql('ALTER TABLE pizzaiolo DROP FOREIGN KEY FK_8E1DFF22F1965E46');
        $this->addSql('DROP INDEX IDX_8E1DFF22F1965E46 ON pizzaiolo');
        $this->addSql('ALTER TABLE pizzaiolo DROP pizzeria_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE pizza_pizzeria');
        $this->addSql('ALTER TABLE ingredient_pizza DROP FOREIGN KEY FK_D6EFE5AED41D1D42');
        $this->addSql('DROP INDEX IDX_D6EFE5AED41D1D42 ON ingredient_pizza');
        $this->addSql('ALTER TABLE ingredient_pizza DROP pizza_id');
        $this->addSql('ALTER TABLE pizzaiolo ADD pizzeria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pizzaiolo ADD CONSTRAINT FK_8E1DFF22F1965E46 FOREIGN KEY (pizzeria_id) REFERENCES pizzeria (id_pizzeria)');
        $this->addSql('CREATE INDEX IDX_8E1DFF22F1965E46 ON pizzaiolo (pizzeria_id)');
    }
}
