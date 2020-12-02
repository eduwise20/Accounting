<?php

$admin_student_scholarship_sub_menus = [
    [
        'name' => 'Assign Scholarship to Student',
        'link' => U.'assign_scholarship_to_students/app/add/'
    ]
];

add_menu_admin('Assign Scholarship to Student',U.'assign_scholarship_to_students/app','assign_scholarship_to_students','fal fa-file',2,$admin_student_scholarship_sub_menus);