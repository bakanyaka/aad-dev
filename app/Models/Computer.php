<?php


namespace App\Models;


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
     * @return string
     */
    public function getLastLoggedOnUserAccount() : string
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
     * @return string
     */
    public function getMac() : string
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
     * @return string
     */
    public function getIp() : string
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
     * @return string
     */
    public function getOs() : string
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
     * @return string
     */
    public function getUserRights() : string
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
     * @return string
     */
    public function getCpu() : string
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
     * @return int
     */
    public function getMemorySizeInMb() : int
    {
        return $this->memorySize;
    }

    /**
     * @return int
     */
    public function getMemorySizeInGb() : int
    {
        return $this->memorySize / 1024;
    }

    /**
     * @param int $memorySizeInMb
     */
    public function setMemorySize(int $memorySizeInMb)
    {
        $this->memorySize = $memorySizeInMb;
    }

    /**
     * @return int
     */
    public function getTotalHddSize() : int
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
}