<?php
interface A{
      public function print1();
      public function print2();

   }
interface B{

    public function print3();
  }

interface ved extends A,B {
 
}
class Vijay implements ved{
    public function print1()
    {
        echo "vedprint1 method";
    }
    public function print2()
    {
        echo "vedprint2 method";
    }

    public function print3()
    {
        echo "vedprint3 method";
    }

}

$inter = new Vijay();
$inter->print1();
$inter->print2();
$inter->print3();

?>