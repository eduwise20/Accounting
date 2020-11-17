<?php
$table = new Schema('zzz_9_fiscal_years');
$table->add('name', 'varchar', 256);
$table->add('year', 'varchar', 256);
$table->add('order', 'int', 11);
$table->add('code', 'int', 11);
$table->add('remarks', 'varchar', 256);
$table->add('is_running', 'boolean', '', false);
$table->add('allow_entry', 'boolean', '', false);
$table->add('start_date', 'varchar', 256);
$table->add('end_date', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();