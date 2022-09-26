<?php

require_once 'src/autoload.php';
use Alura\Bank\Model\Person\{CPF, Address, Person, InvalidNameException};
use Alura\Bank\Model\Account\{Holder, Account, SavingsAccount, CurrentAccount, InsuficientFundsException};
use Alura\Bank\Model\Employee\{Employee, Manager, Director, Developer, VideoEditor};
use Alura\Bank\Service\{BonusController, Authenticator, Authenticate};

include 'employeeTest.php';
include 'accountTest.php';
