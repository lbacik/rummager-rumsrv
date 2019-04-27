<?php

declare(strict_types=1);

namespace spec\Rummager\Service;

use Rummager\Service\Api;
use PhpSpec\ObjectBehavior;
use Rummager\Service\CheckProcess;
use Rummager\Service\Host;
use Rummager\Service\Network\Ipv4Class;
use Rummager\Service\Module\Smtp\Smtp;
use Rummager\Service\Network;
use Rummager\Service\Network\Status as NetworkStatus;
use Rummager\Service\ServiceProviderInterface;
use Rummager\Service\Module;

class ApiSpec extends ObjectBehavior
{
    public function let(
        ServiceProviderInterface $serviceProvider,
        Host $host,
        CheckProcess $checkProcess,
        Network $network,
        Module $module,
        Smtp $smtp
    ) {
        $this->beConstructedWith($serviceProvider);

        $serviceProvider->offsetGet('host')->willReturn($host);
        $serviceProvider->offsetGet('checkProcess')->willReturn($checkProcess);
        $serviceProvider->offsetGet('network')->willReturn($network);
        $serviceProvider->offsetGet('module')->willReturn($module);
        $serviceProvider->offsetGet('smtp')->willReturn($smtp);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Api::class);
    }

    public function it_returns_host_id(Host $host)
    {
        $host->hostIdByName('example.com')->willReturn(1);
        $this->getHostID('example.com')->shouldReturn(1);
    }

    public function it_returns_number_of_running_nodes(Host $host)
    {
        $host->nodesRunning(1)->willReturn(10);
        $this->getNodesRunning(1)->shouldReturn(10);
    }

    public function it_returns_max_nodes(Host $host)
    {
        $host->getMaxNodes(1)->willReturn(10);
        $this->getHostMaxNodes(1)->shouldReturn(10);
    }

    public function it_returns_max_threads(Host $host)
    {
        $host->getMaxThreads(1)->willReturn(10);
        $this->getHostMaxThreads(1)->shouldReturn(10);
    }

    public function it_returns_node_status(Host $host) 
    {
        $host->checkNodeIsRunning(123)->willReturn(true);
        $this->checkNodeIsRunning(123)->shouldReturn(true);
    }

    public function it_returns_new_node_id(Host $host)
    {
        $host->getNewNodeId(1)->willReturn(123);
        $this->getNewNodeId(1)->shouldReturn(123);
    }

    public function it_should_return_network(Network $network)
    {
        $networkString = '1.1.1.1/24';
        $network->getNetworkAsCidr(1)->willReturn($networkString);
        $this->getNetwork(1)->shouldReturn($networkString);
    }

    public function it_returns_last_checked_ip(Smtp $smtp)
    {
        $ip = '1.1.1.0';
        $brd = '1.1.1.255';
        $result = '1.1.1.10';

        $smtp->lastIp($ip, $brd)->willReturn($result);
        $this->getLastIp($ip, $brd)->shouldReturn($result);
    }

    public function it_updates_network_status(Network $network)
    {
        $netAddr = '1.1.1.0';
        $mask = '255.255.255.0';
        $newStatus = NetworkStatus::STATUS_FINISHED;

        $network->updateStatus($netAddr, $mask, $newStatus)->shouldBeCalled();
        $this->updateNetworkStatus($netAddr, $mask, $newStatus);
    }

    public function it_should_start_new_check(CheckProcess $checkProcess)
    {
        $nodeId = 1;
        $moduleId = 1;
 
        $checkProcess->startNew($nodeId, $moduleId)->willReturn(10);
        $this->startNewCheck($nodeId, $moduleId)->shouldReturn(10);
    }

    public function it_should_return_network_id(
        CheckProcess $checkProcess,
        Ipv4Class $network
    ) {
        $checkId = 1;
        // $network->getId()->willReturn(10);
        $checkProcess->getNetworkId($checkId)->willReturn(10);
        $this->getNetworkId($checkId)->shouldBeInteger();
    }

    public function it_returns_module_id(Module $module)
    {
        $name = 'smtp';
        $moduleId = 1;

        $module->moduleIdByName($name)->willReturn(1);
        $this->getModuleId($name)->shouldReturn(1);
    }

    public function it_adds_host_data(
        CheckProcess $checkProcess, 
        Module $module
    ) {
        $checkId = 100;
        $moduleId = 1;

        $data = [
            'checkId' => $checkId,
        ];

        $checkProcess->getModuleId($checkId)->willReturn($moduleId);
        $module->addData($moduleId, $data)->shouldBeCalled();

        $this->addHostInfo($data);
    }
}
