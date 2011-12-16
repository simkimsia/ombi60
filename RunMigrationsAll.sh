#!/bin/bash          

echo "Running Migrations for Log Plugin"
lib/Cake/Console/cake Migrations.migration all --plugin Log

echo "Running Migations for main app"
lib/Cake/Console/cake Migrations.migration all