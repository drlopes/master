<?php

namespace Alura\Bank\Model\Employee;

use Alura\Bank\Model\Employee\{Employee};

/**
 * Commentary...
 */
class VideoEditor extends Employee
{

  public function getRole():string
  {
    return 'Video Editor';
  }

  public function calculateBonus():float
  {
    return 600.0;
  }
}
