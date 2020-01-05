<?php


namespace App\Twig;

use \DateTime;
use Symfony\Component\Intl\Locales;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\Intl\Countries;

class AppExtension extends AbstractExtension
{
    private $localeCodes;
    private $locales;

    public function __construct(string $locales)
    {

        $localeCodes = explode('|', $locales);
        sort($localeCodes);
        $this->localeCodes = $localeCodes;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('_price', [$this, 'formatPrice']),
            new TwigFilter('_country_name', [$this, 'getCountryName']),
            new TwigFilter('_age', [$this, 'calculateAge']),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('locales', [$this, 'getLocales']),
        ];
    }

    /**
     * Takes the list of codes of the locales (languages) enabled in the
     * application and returns an array with the name of each locale written
     * in its own language (e.g. English, Français, Español, etc.).
     */
    public function getLocales(): array
    {
        if (null !== $this->locales) {
            return $this->locales;
        }

        $this->locales = [];
        foreach ($this->localeCodes as $localeCode) {
            $this->locales[] = ['code' => $localeCode, 'name' => Locales::getName($localeCode, $localeCode)];
        }

        return $this->locales;
    }

    public function formatPrice($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$'.$price;

        return $price;
    }

    public function getCountryName($countryCode, $locale)
    {
        $countryName = Countries::getName($countryCode, $locale);
        return $countryName;
    }

    public function calculateAge($dateTime)
    {
        if (!$dateTime instanceof DateTime) return 0;
        return $dateTime->diff(new DateTime())->format('%Y');
    }

}