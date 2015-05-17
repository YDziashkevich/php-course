<?php
define('ESCAPE_KEY', 27);
$ncurse = ncurses_init();
$fullscreen = ncurses_newwin ( 0, 0, 0, 0); 
ncurses_border(0,0, 0,0, 0,0, 0,0);
$small = ncurses_newwin(10, 30, 7, 25);
ncurses_wborder($small,0,0, 0,0, 0,0, 0,0);
ncurses_attron(NCURSES_A_REVERSE);
ncurses_mvaddstr(0,1,"My first ncurses application");
ncurses_attroff(NCURSES_A_REVERSE);
ncurses_refresh();

$currently_selected = 0;
$menu = array('one', 'two', 'three', 'four');

while (true) {
    for($i=0; $i<count($menu); $i++){
        $out = $menu[$i];
        if($currently_selected == intval($i)){ 
            ncurses_wattron($small,NCURSES_A_REVERSE);
            ncurses_mvwaddstr($small, 1+$i, 1, $out);
            ncurses_wattroff($small,NCURSES_A_REVERSE);
        } else {
            ncurses_mvwaddstr($small, 1+$i, 1, $out);
        }
    }

    ncurses_wrefresh($small);

    $pressed = ncurses_getch();

    if ($pressed == NCURSES_KEY_UP) {
        $currently_selected--; 
        if ($currently_selected < 0)
            $currently_selected = 0;
    } elseif ($pressed == NCURSES_KEY_DOWN) {
        $currently_selected++;
        if ($currently_selected >= count($menu))
            $currently_selected = count($menu)-1;
    } elseif($pressed == ESCAPE_KEY) {
        break;
    } else {
    ncurses_mvwaddstr($small, 5, 5, $pressed);
    }
}

ncurses_end();