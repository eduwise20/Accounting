<?php
$table = new Schema('zzz_10_fines');
$table->add('name', 'varchar', 256);
$table->add('type', 'varchar', 256);
$table->add('fiscal_year_id', 'int', 20);
$table->add('amount', 'bigint', 20);
$table->add('is_active', 'boolean', '', false);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();