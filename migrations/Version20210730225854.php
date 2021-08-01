<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730225854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD video_id INT NOT NULL, ADD document_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C29C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('CREATE INDEX IDX_9474526C29C1004E ON comment (video_id)');
        $this->addSql('CREATE INDEX IDX_9474526CC33F7837 ON comment (document_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C29C1004E');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CC33F7837');
        $this->addSql('DROP INDEX IDX_9474526C29C1004E ON comment');
        $this->addSql('DROP INDEX IDX_9474526CC33F7837 ON comment');
        $this->addSql('ALTER TABLE comment DROP video_id, DROP document_id');
    }
}
