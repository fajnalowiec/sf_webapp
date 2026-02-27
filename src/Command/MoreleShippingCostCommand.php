<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\MoreleEntity\Order;
use App\MoreleEntity\CountryShippingFee;
use App\Service\ShippingPrice\CountryShippingRule;
use App\Service\ShippingPrice\WeightShippingRule;
use App\Service\ShippingPrice\CartWorthShippingRule;
use App\Service\ShippingPrice\FridayPromotionShippingRule;
use App\Service\ShippingPrice\ShippingPriceCalculator;

#[AsCommand(name: 'morele:calculate-shipping-cost', description: 'Calculate order shipping cost')]
class MoreleShippingCostCommand extends Command
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        parent::__construct();
        $this->serializer = $serializer;
    }

    protected function configure(): void
    {
        $this->addArgument('data', InputArgument::REQUIRED, 'App\\MoreleEntity\\Order encoded as JSON');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $json = $input->getArgument('data');
        $order = $this->serializer->deserialize($json, Order::class, 'json');

        $calc = new ShippingPriceCalculator($order, [
            new CountryShippingRule(new CountryShippingFee()),
            new WeightShippingRule(),
            new CartWorthShippingRule(),
            new FridayPromotionShippingRule(),
        ]);
        $price = $calc->calculate();

        $output->writeln($price);
        return Command::SUCCESS;
    }
}