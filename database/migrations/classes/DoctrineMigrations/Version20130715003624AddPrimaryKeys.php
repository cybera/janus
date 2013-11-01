<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20130715003624AddPrimaryKeys extends AbstractMigration
{
    /**
     * Adds Primary key to each column (doctrine requires this)
     *
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Since eid is actually a foreign key it cannot be null
        $this->addSql("SET FOREIGN_KEY_CHECKS = 0");
        $this->addSql("
            ALTER TABLE " . DB_TABLE_PREFIX . "hasEntity
                CHANGE `eid` `eid` INT(11) NOT NULL,
                ADD PRIMARY KEY (uid, eid)");

        $this->addSql("
            ALTER TABLE " . DB_TABLE_PREFIX . "userData
                DROP INDEX uid,
                ADD PRIMARY KEY (uid, `key`)");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE " . DB_TABLE_PREFIX . "hasEntity
                DROP PRIMARY KEY,
                CHANGE eid eid int(11) DEFAULT NULL");

        $this->addSql("
            ALTER TABLE " . DB_TABLE_PREFIX . "userData
                DROP PRIMARY KEY,
                ADD UNIQUE INDEX uid (uid, `key`)");
    }
}
