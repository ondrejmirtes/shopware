<?php declare(strict_types=1);

namespace Shopware\Core\System\Tax\Aggregate\TaxAreaRule\Struct;

use Shopware\Core\Checkout\Customer\Aggregate\CustomerGroup\Struct\CustomerGroupBasicStruct;
use Shopware\Core\System\Country\Aggregate\CountryArea\Struct\CountryAreaBasicStruct;
use Shopware\Core\System\Country\Aggregate\CountryState\Struct\CountryStateBasicStruct;
use Shopware\Core\System\Country\Struct\CountryBasicStruct;
use Shopware\Core\System\Tax\Aggregate\TaxAreaRuleTranslation\Collection\TaxAreaRuleTranslationBasicCollection;
use Shopware\Core\System\Tax\Struct\TaxBasicStruct;

class TaxAreaRuleDetailStruct extends TaxAreaRuleBasicStruct
{
    /**
     * @var CountryAreaBasicStruct|null
     */
    protected $countryArea;

    /**
     * @var CountryBasicStruct|null
     */
    protected $country;

    /**
     * @var CountryStateBasicStruct|null
     */
    protected $countryState;

    /**
     * @var TaxBasicStruct
     */
    protected $tax;

    /**
     * @var CustomerGroupBasicStruct
     */
    protected $customerGroup;

    /**
     * @var TaxAreaRuleTranslationBasicCollection
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new TaxAreaRuleTranslationBasicCollection();
    }

    public function getCountryArea(): ?CountryAreaBasicStruct
    {
        return $this->countryArea;
    }

    public function setCountryArea(?CountryAreaBasicStruct $countryArea): void
    {
        $this->countryArea = $countryArea;
    }

    public function getCountry(): ?CountryBasicStruct
    {
        return $this->country;
    }

    public function setCountry(?CountryBasicStruct $country): void
    {
        $this->country = $country;
    }

    public function getCountryState(): ?\Shopware\Core\System\Country\Aggregate\CountryState\Struct\CountryStateBasicStruct
    {
        return $this->countryState;
    }

    public function setCountryState(?\Shopware\Core\System\Country\Aggregate\CountryState\Struct\CountryStateBasicStruct $countryState): void
    {
        $this->countryState = $countryState;
    }

    public function getTax(): TaxBasicStruct
    {
        return $this->tax;
    }

    public function setTax(TaxBasicStruct $tax): void
    {
        $this->tax = $tax;
    }

    public function getCustomerGroup(): CustomerGroupBasicStruct
    {
        return $this->customerGroup;
    }

    public function setCustomerGroup(
        \Shopware\Core\Checkout\Customer\Aggregate\CustomerGroup\Struct\CustomerGroupBasicStruct $customerGroup): void
    {
        $this->customerGroup = $customerGroup;
    }

    public function getTranslations(): TaxAreaRuleTranslationBasicCollection
    {
        return $this->translations;
    }

    public function setTranslations(TaxAreaRuleTranslationBasicCollection $translations): void
    {
        $this->translations = $translations;
    }
}
