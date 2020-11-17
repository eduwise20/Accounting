<?php
$table = new Schema('zzz_7_fee_groups');
$table->add('name', 'varchar', 256);
$table->add('remarks', 'varchar', 256);
$table->add('code', 'int', 11);
$table->add('is_active', 'boolean', '', false);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();