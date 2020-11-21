<?php

$svg = '<svg xmlns="http://www.w3.org/2000/svg" id="Solid" viewBox="0 0 512 512" width="24" height="24">
<g>
<path d="M448,168H32V456H448ZM176,352a48,48,0,0,1-96,0,8,8,0,0,1,16,0,32,32,0,1,0,32-32,8,8,0,0,1,0-16,32,32,0,1,0-32-32,8,8,0,0,1-16,0,48,48,0,1,1,74.507,40A47.994,47.994,0,0,1,176,352Zm64-48a48,48,0,1,1-48,48V272a48,48,0,0,1,96,0,8,8,0,0,1-16,0,32,32,0,0,0-64,0v44.261A47.806,47.806,0,0,1,240,304Zm112,96a48.054,48.054,0,0,1-48-48,8,8,0,0,1,16,0,32,32,0,1,0,32-32H320a8,8,0,0,1-8-8V232a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H328v64h24a48,48,0,0,1,0,96Z" fill="#2196f3"/>
<path d="M464,464a8,8,0,0,1-8,8H48v16H480V88H464Z" fill="#2196f3"/>
<circle cx="240" cy="352" r="32" fill="#2196f3"/>
<path d="M368,72V48a8,8,0,0,1,16,0v8h16V48a24,24,0,0,0-48,0V72H304V48a8,8,0,0,1,16,0v8h16V48a24,24,0,0,0-48,0V72H160V48a8,8,0,0,1,16,0v8h16V48a24,24,0,0,0-48,0V72H96V48a8,8,0,0,1,16,0v8h16V48a24,24,0,0,0-48,0V72H32v80H448V72Z" fill="#2196f3"/>
</g>
</svg>';

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

add_menu_admin_svg('Fiscal Year', U.'fiscal_years', 'fiscal_years', $svg, 1, $admin_fiscal_year_sub_menus); 