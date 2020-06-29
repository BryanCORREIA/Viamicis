<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512124954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31689D86650F ON articles (user_id_id)');
        $this->addSql('ALTER TABLE comments ADD articles_id INT NOT NULL, ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A1EBAF6CC ON comments (articles_id)');
        $this->addSql('CREATE INDEX IDX_5F9E962A67B3B43D ON comments (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689D86650F');
        $this->addSql('DROP INDEX IDX_BFDD31689D86650F ON articles');
        $this->addSql('ALTER TABLE articles DROP user_id_id');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A1EBAF6CC');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A67B3B43D');
        $this->addSql('DROP INDEX IDX_5F9E962A1EBAF6CC ON comments');
        $this->addSql('DROP INDEX IDX_5F9E962A67B3B43D ON comments');
        $this->addSql('ALTER TABLE comments DROP articles_id, DROP users_id');
    }
}
