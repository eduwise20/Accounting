<?php
$table = new Schema('zzz_1_classes');
$table->add('name', 'varchar', 256);
$table->add('code', 'int', 20);
$table->add('created_at', 'TIMESTAMP', '', 'null');
$table->add('updated_at', 'TIMESTAMP', '', 'null');
$table->save();