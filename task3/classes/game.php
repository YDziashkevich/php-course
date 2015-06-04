<?php
class Game
{
    private $x;
    private $y;
    private $currentX;
    private $currentY;
    private $gameWin;
    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->currentX = (int)HEIGHT_WIN/2;
        $this->currentY = (int)WIDTH_WIN/2;
        ncurses_curs_set(0);
        $mainWin = ncurses_newwin(0, 0, 0, 0);
        ncurses_getmaxyx($mainWin, $rows, $cols);
        $this->gameWin = ncurses_newwin(HEIGHT_WIN, WIDTH_WIN, ((int)$rows/2 - (int)HEIGHT_WIN/2), ((int)$cols/2 - (int)WIDTH_WIN/2));
        $this->getField();
    }
    private function getField($x = 0, $y = 0)
    {
        if($x == 0 && $y == 0){
            $out = '';
            for($i = 1; $i <= WIDTH_WIN * HEIGHT_WIN; $i++){
                $out .= MARKER_FIELD;
            }
            ncurses_mvwaddstr($this->gameWin, 0, 0, $out);
            ncurses_wborder($this->gameWin, 0, 0, 0, 0, 0, 0, 0, 0);
            ncurses_wattron($this->gameWin, NCURSES_A_REVERSE);
            ncurses_mvwaddstr($this->gameWin, $this->currentX, $this->currentY, MARKER_CHAR);
            ncurses_wattroff($this->gameWin, NCURSES_A_REVERSE);
            ncurses_wrefresh($this->gameWin);
        }else{
            ncurses_wattron($this->gameWin, NCURSES_A_REVERSE);
            ncurses_mvwaddstr($this->gameWin, $x, $y, MARKER_CHAR);
            ncurses_wattroff($this->gameWin, NCURSES_A_REVERSE);
            ncurses_mvwaddstr($this->gameWin, $this->currentX, $this->currentY, MARKER_FIELD);
            $this->currentX = $x;
            $this->currentY = $y;
            ncurses_wrefresh($this->gameWin);
        }

    }
    private function moutionChar()
    {

    }
}