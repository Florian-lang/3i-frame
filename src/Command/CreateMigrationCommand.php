<?php

namespace App\Command;

$fileName = 'Version' . date('YmdHis');

$content = "<?php

namespace iFrameMigrations;

use iFrame\Entity\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class $fileName extends AbstractMigration {

    public function up() : void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down() : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}"
;

file_put_contents('migrations/' . $fileName . '.php', $content);

echo "Migration $fileName created successfully.\n";
