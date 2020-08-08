<?php
abstract class PhoneCameraApp
{

    private $shareStrategy;

    abstract protected function edit();

    public function take() {
        print 'TAKE' . PHP_EOL;
    }    
    
    public function save() {
        print 'SAVE' . PHP_EOL;
    }

    public function setShareStrategy(ShareStrategy $shareStrategy): void {
        $this->shareStrategy = $shareStrategy;
    }

    public function share() {
        $this->shareStrategy->share();
    }


}

interface ShareStrategy
{
    function share();
}

class EmailShare implements ShareStrategy{
    public function share() {
        print 'EMAIL_SHARE' . PHP_EOL;
    }
}

class SocialShare implements ShareStrategy{
    public function share() {
        print 'SOCIAL_SHARE' . PHP_EOL;
    }
}

class BasicCameraApp extends PhoneCameraApp
{
    public function edit() {
        print 'BASIC EDIT' . PHP_EOL;
    }
}

class CameraPlusApp extends PhoneCameraApp
{
    public function edit() {
        print 'FANCY EDIT' . PHP_EOL;
    }
}

$basic = new BasicCameraApp();
$basic->setShareStrategy(new EmailShare());
$basic->share();
$basic->edit();

$plus = new CameraPlusApp();
$plus->setShareStrategy(new SocialShare());
$plus->share();
$plus->edit();

?>