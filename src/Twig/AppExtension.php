<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pluralize', [$this, 'pluralize']),
            new TwigFunction('format_date', [$this, 'formatDate'],['is_safe' => ['html']]),
        ];
    }

    public function pluralize(int $count, string $singular):string
    {
        $string = $count > 1 ? $singular.'s' : $singular;

        return sprintf("%d %s", $count, $string);
    }

    public function formatDate(\DateTime $endDate){

        static $units = array(
            'y' => 'année',
            'm' => 'mois',
            'd' => 'jour',
            'h' => 'heure',
            'i' => 'minute',
            's' => 'seconde'
        );

        $dateToday = new \DateTime();


        if($dateToday->getTimestamp() < $endDate->getTimestamp())
        {
            $diff = $dateToday->diff($endDate);

            foreach ($units as $attribute => $unit) {
                $count = $diff->$attribute;
                if (0 !== $count) {
                    if($unit != "mois"){
                        $unit = $count > 1 ? $unit.'s':$unit;
                    }
                    return sprintf("%s %s restant",$count, $unit);
                }
            }
        }

        return "<strong>Arrivé à expiration</strong>";
    }

}
