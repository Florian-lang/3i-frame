migration-generate:
	docker exec 3i-frame-php php src/Command/CreateMigrationCommand.php

migration-migrate:
	docker exec 3i-frame-php php src/Command/MigrateCommand.php

migration-rollback:
	docker exec 3i-frame-php php src/Command/MigrateCommand.php prev

migration-setup:
	docker exec 3i-frame-php php src/Command/MigrateCommand.php setup
