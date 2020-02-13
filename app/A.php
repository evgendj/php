<?php

nanespace app;

class A
{
  protected const TEST = "Class A";

  public function getTest()
  {
    var_dump(self::TEST);
  }
}
