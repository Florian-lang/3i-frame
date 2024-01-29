#!/bin/bash

HOOKS_PATH=".git/hooks/pre-commit"

echo "#!/bin/bash" > $HOOKS_PATH
echo "docker exec \"\$(basename \"\$PWD\")-php\" bash -c composer lint" >> $HOOKS_PATH

chmod +x $HOOKS_PATH

echo "Hook de pre-commit créé."