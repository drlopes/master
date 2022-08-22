<?php

namespace Alura\Bank\Service;

use Alura\Bank\Model\Employee\{Employee};

/**
 * Commentary...
 */
class BonusController
{
  private int $totalBonusAmmount = 0;

  public function addBonus(Employee $employee):void
  {
    $this->totalBonusAmmount += $employee->calculateBonus();
  }

  public function getTotalBonus():float
  {
    return $this->totalBonusAmmount;
  }
}
