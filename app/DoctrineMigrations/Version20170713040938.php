<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170713040938 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP INDEX UNIQ_232B318CC719BD1D, ADD INDEX IDX_232B318CC719BD1D (opponent_decision_type_id)');
        $this->addSql('ALTER TABLE game DROP INDEX UNIQ_232B318C577AE23A, ADD INDEX IDX_232B318C577AE23A (computer_decision_type_id)');
        $this->addSql('ALTER TABLE game DROP INDEX UNIQ_232B318CAE9CC3E7, ADD INDEX IDX_232B318CAE9CC3E7 (game_state_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP INDEX IDX_232B318CC719BD1D, ADD UNIQUE INDEX UNIQ_232B318CC719BD1D (opponent_decision_type_id)');
        $this->addSql('ALTER TABLE game DROP INDEX IDX_232B318C577AE23A, ADD UNIQUE INDEX UNIQ_232B318C577AE23A (computer_decision_type_id)');
        $this->addSql('ALTER TABLE game DROP INDEX IDX_232B318CAE9CC3E7, ADD UNIQUE INDEX UNIQ_232B318CAE9CC3E7 (game_state_id)');
    }
}
