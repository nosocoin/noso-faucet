<?php

namespace NosoProject\Model;

final class PaymentsModel
{
  private $DB;

  public function __construct($DB)
  {
    $this->DB = $DB;
  }
}
