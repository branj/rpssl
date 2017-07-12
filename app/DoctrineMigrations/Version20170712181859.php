<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170712181859 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game CHANGE game_state_id game_state_id INT DEFAULT 1 NOT NULL, CHANGE _decision_type_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CC719BD1D FOREIGN KEY (opponent_decision_type_id) REFERENCES decision_type (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C577AE23A FOREIGN KEY (computer_decision_type_id) REFERENCES decision_type (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CAE9CC3E7 FOREIGN KEY (game_state_id) REFERENCES game_state (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CC719BD1D ON game (opponent_decision_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318C577AE23A ON game (computer_decision_type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CAE9CC3E7 ON game (game_state_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CC719BD1D');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C577AE23A');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CAE9CC3E7');
        $this->addSql('DROP INDEX UNIQ_232B318CC719BD1D ON game');
        $this->addSql('DROP INDEX UNIQ_232B318C577AE23A ON game');
        $this->addSql('DROP INDEX UNIQ_232B318CAE9CC3E7 ON game');
        $this->addSql('ALTER TABLE game CHANGE game_state_id game_state_id INT NOT NULL, CHANGE user_id _decision_type_id INT NOT NULL');
    }
}
