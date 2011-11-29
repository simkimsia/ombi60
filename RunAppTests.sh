#!/bin/bash

cp app/Config/core.php app/Config/core.php.backup
echo "Configure::write('Acl.database', 'test');" >> app/Config/core.php


lib/Cake/Console/cake testsuite app 

mv app/Config/core.php.backup app/Config/core.php
