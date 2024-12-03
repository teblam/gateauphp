<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

class MenuCell extends Cell
{
    public function display()
    {
        $menus = $this->fetchTable('Menus')->find()
            ->order(['ordre' => 'ASC'])
            ->all();
        
        $this->set('menus', $menus);
    }
} 