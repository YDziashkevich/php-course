<?php
class Game
{
    private $x;
    private $y;
    public function __construct()
    {
        ncurses_curs_set(0);
        $mainWin = ncurses_newwin(0, 0, 0, 0);
        ncurses_getmaxyx($mainWin, $rows, $cols);
        $gameWin = ncurses_newwin(HEIGHT_WIN, WIDTH_WIN, ((int)$rows/2 - (int)HEIGHT_WIN/2), ((int)$cols/2 - (int)WIDTH_WIN/2));
        $out = '';
        for($i = 1; $i <= WIDTH_WIN * HEIGHT_WIN; $i++){
            $out .= MARKER_FIELD;
        }
        ncurses_mvwaddstr($gameWin, 0, 0, $out);
        ncurses_wattron($gameWin, NCURSES_A_REVERSE);
        ncurses_mvwaddstr($gameWin, (int)HEIGHT_WIN/2, (int)WIDTH_WIN/2, MARKER_CHAR);
        ncurses_wattroff($gameWin, NCURSES_A_REVERSE);
        ncurses_wborder($gameWin, 0, 0, 0, 0, 0, 0, 0, 0);
        ncurses_wrefresh($gameWin);
        $this->x = 0;
        $this->y = 0;
    }
}