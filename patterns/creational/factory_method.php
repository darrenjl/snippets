<?php
abstract class Pizza
{
    protected $name;
    protected $toppings;

    public function prepare()
    {
        echo 'Adding ' . print_r($this->toppings, true) . ' to ' . $this->name . ' pizza.' . PHP_EOL;
    }

    public function bake()
    {
        echo 'Baking ' . $this->name . ' pizza.';
    }
}
class NYStyleCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY cheese";
        $this->toppings = ['tomato sauce', 'cheese'];
    }
}
class NYStylePepperoniPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "NY pepperoni";
        $this->toppings = ['tomato sauce', 'cheese', 'pepperoni'];
    }
}
class ChicagoStyleCheesePizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Deep cheese";
        $this->toppings = ['tomato sauce', 'cheese'];
    }
}
class ChicagoStylePepperoniPizza extends Pizza
{
    public function __construct()
    {
        $this->name = "Deep pepperoni";
        $this->toppings = ['tomato sauce', 'cheese', 'pepperoni'];
    }
}

abstract class PizzaStore
{
    abstract public function createPizza(string $type): Pizza;
    public function orderPizza(string $type)
    {
        $pizza = $this->createPizza($type);
        $pizza->prepare();
        $pizza->bake();
    }
}

class NYPizzaStore extends PizzaStore
{
    public function createPizza(string $type): Pizza
    {
        if ($type == 'cheese') {
            return new NYStyleCheesePizza();
        } else if ($type == 'pepperoni') {
            return new NYStylePepperoniPizza();
        } else {
            echo 'Pizza not found';
            die;
        }
    }
}

class ChicagoPizzaStore extends PizzaStore
{
    public function createPizza(string $type): Pizza
    {
        if ($type == 'cheese') {
            return new ChicagoStyleCheesePizza();
        } else if ($type == 'pepperoni') {
            return new ChicagoStylePepperoniPizza();
        } else {
            echo 'Pizza not found';
            die;
        }
    }
}

$store = new ChicagoPizzaStore();
$store->orderPizza('pepperoni');
