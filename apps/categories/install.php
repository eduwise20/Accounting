<?php
$table = new Schema('zzz_5_categories');
$table->add('name', 'varchar', 256);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save(); 

$table = new Schema('zzz_6_subcategories');
$table->add('category_id', 'int', 11);
$table->add('name', 'varchar', 256);
$table->add('remarks', 'varchar', 256);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save(); 