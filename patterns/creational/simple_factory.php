<?php
abstract class Zone
{
    private $displayName;
    private $offset;
    public function __construct(string $displayName, int $offset)
    {
        $this->displayName = $displayName;
        $this->offset = $offset;
    }
    public function getDisplayName(): string
    {
        return $displayName;
    }
    public function getOffset(): int
    {
        return $offset;
    }
}

class ZoneUSCentral extends Zone
{
    public function __construct()
    {
        parent::__construct("CDT", -5);
    }
}

class ZoneUSEastern extends Zone
{
    public function __construct()
    {
        parent::__construct("EST", -5);
    }
}

class ZoneUSPacific extends Zone
{
    public function __construct()
    {
        parent::__construct("PST", -8);
    }
}

class ZoneUSMountain extends Zone
{
    public function __construct()
    {
        parent::__construct("MDT", -6);
    }
}

class ZoneFactory
{
    public static function CreateZone(string $zoneId): Zone
    {
        switch ($zoneId) {
            case 'US/Central':
                return new ZoneUSCentral();
            case 'US/Eastern':
                return new ZoneUSEastern();
            case 'US/Pacific':
                return new ZoneUSPacific();
            case 'US/Mountain':
                return new ZoneUSMountain();
            default:
                echo 'Zone not found';
                break;
        }
    }
}

$zone = ZoneFactory::CreateZone("US/Eastern");
var_dump($zone);
