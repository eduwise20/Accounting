<?php
$admin_student_sub_menus = [
    [
        'name' => 'Add Student',
        'link' => U.'students/app/add/'
    ],
    [
        'name' => 'List Students',
        'link' => U.'students/app/list/'
    ]
];

add_menu_admin('Students',U.'students/app','students','fal fa-file',2, $admin_student_sub_menus);