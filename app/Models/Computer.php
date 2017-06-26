<?php


namespace App\Models;


use Carbon\Carbon;

class Computer
{

    protected $name;
    protected $lastLoggedOnUserAccount;
    protected $mac;
    protected $ip;
    protected $os;
    protected $userRights;
    protected $cpu;
    protected $memorySize;
    protected $totalHddSize;
    protected $soft = [];
    protected $monitors = [];
    protected $printers = [];
    protected $detailsUpdatedAt;

    /**
     * @return Carbon | null
     */
    public function getDetailsUpdatedAt() : ?Carbon
    {
        return $this->detailsUpdatedAt;
    }


    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }


    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return null|string
     */
    public function getLastLoggedOnUserAccount() : ?string
    {
        return $this->lastLoggedOnUserAccount;
    }

    /**
     * @param string $lastLoggedOnUserAccount
     */
    public function setLastLoggedOnUserAccount(string $lastLoggedOnUserAccount)
    {
        $this->lastLoggedOnUserAccount = $lastLoggedOnUserAccount;
    }

    /**
     * @return null|string
     */
    public function getMac() : ?string
    {
        return $this->mac;
    }

    /**
     * @param string $mac
     */
    public function setMac(string $mac)
    {
        $this->mac = $mac;
    }

    /**
     * @return null|string
     */
    public function getIp() : ?string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return null|string
     */
    public function getOs() : ?string
    {
        return $this->os;
    }

    /**
     * @param string $os
     */
    public function setOs(string $os)
    {
        $this->os = $os;
    }

    /**
     * @return null|string
     */
    public function getUserRights() : ?string
    {
        return $this->userRights;
    }

    /**
     * @param string $userRights
     */
    public function setUserRights(string $userRights)
    {
        $this->userRights = $userRights;
    }

    /**
     * @return null|string
     */
    public function getCpu() : ?string
    {
        return $this->cpu;
    }

    /**
     * @param string $cpu
     */
    public function setCpu(string $cpu)
    {
        $this->cpu = $cpu;
    }

    /**
     * @return int|null
     */
    public function getMemorySizeInMb() : ?int
    {
        return $this->memorySize;
    }

    /**
     * @return int|null
     */
    public function getMemorySizeInGb() : ?int
    {
        return $this->memorySize ? round($this->memorySize / 1024) : null;
    }

    /**
     * @param int $memorySizeInMb
     */
    public function setMemorySize(int $memorySizeInMb)
    {
        $this->memorySize = $memorySizeInMb;
    }

    /**
     * @return int|null
     */
    public function getTotalHddSize() : ?int
    {
        return $this->totalHddSize;
    }


    /**
     * @param int $totalHddSizeInMb
     */
    public function setTotalHddSize(int $totalHddSizeInMb)
    {
        $this->totalHddSize = $totalHddSizeInMb;
    }

    /**
     * @return array
     */
    public function getSoft(): array
    {
        return $this->soft;
    }

    /**
     * @param string $soft
     */
    public function addSoft(string $soft)
    {
        $this->soft[] = $soft;
    }

    /**
     * @return array
     */
    public function getMonitors(): array
    {
        return $this->monitors;
    }

    /**
     * @param string $monitor
     */
    public function addMonitor(string $monitor)
    {
        $this->monitors[] = $monitor;
    }

    /**
     * @return array
     */
    public function getPrinters(): array
    {
        return $this->printers;
    }

    /**
     * @param string $printer
     */
    public function addPrinter(string $printer)
    {
        $this->printers[] = $printer;
    }

    public function setDetailsUpdatedAt(Carbon $timestamp)
    {
        $this->detailsUpdatedAt = $timestamp;
    }
}