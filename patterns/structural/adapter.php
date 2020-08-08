<?php 

interface Drone {
    function beep();
    function spinRotors();
    function takeOff();
}

class SuperDrone implements Drone {
    public function beep() {
        print 'BEEP' . PHP_EOL;
    }
    public function spinRotors() {
        print 'SPIN_ROTORS' . PHP_EOL;
    }
    public function takeOff() {
        print 'TAKE_OFF' . PHP_EOL;
    }
}

interface Duck {
    function quack();
    function fly();
}

class MallardDuck implements Duck{
    public function quack() {
        print 'QUACK' . PHP_EOL;
    }
    public function fly() {
        print 'FLY' . PHP_EOL;
    }
}

class DroneAdapter implements Duck{
    public $drone;
    function __construct(Drone $drone) {
        $this->drone = $drone;

    }
    public function quack() {
        $this->drone->beep();
    }
    public function fly() {
        $this->drone->spinRotors();
        $this->drone->takeOff();
    }
}

class DuckSimulator{
    public function testDuck(Duck $duck) {
        $duck->quack();
        $duck->fly();
    }
}

$duckSimulator = new DuckSimulator();

$duckSimulator->testDuck(new MallardDuck());

$droneAdapter = new DroneAdapter(new SuperDrone());
$duckSimulator->testDuck($droneAdapter);
