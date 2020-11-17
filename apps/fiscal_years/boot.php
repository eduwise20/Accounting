<?php

$admin_fiscal_year_sub_menus = [
    [
        'name' => 'Add Fiscal Year',
        'link' => U.'fiscal_years/app/add'
    ],
    [
        'name' => 'List Fiscal Years',
        'link' => U.'fiscal_years/app/list'
    ]
];

add_menu_admin('Fiscal Year', U.'fiscal_years', 'fiscal_years', 'fal fa-file', 1, $admin_fiscal_year_sub_menus); 