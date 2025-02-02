<?php

declare(strict_types=1);

/*
 * This file is part of SolidInvoice project.
 *
 * (c) Pierre du Plessis <open-source@solidworx.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SolidInvoice\QuoteBundle\Tests\Form\Type;

use Money\Currency;
use SolidInvoice\CoreBundle\Form\Type\DiscountType;
use SolidInvoice\CoreBundle\Tests\FormTestCase;
use SolidInvoice\MoneyBundle\Entity\Money;
use SolidInvoice\QuoteBundle\Entity\Quote;
use SolidInvoice\QuoteBundle\Form\Type\ItemType;
use SolidInvoice\QuoteBundle\Form\Type\QuoteType;
use Symfony\Component\Form\PreloadedExtension;

class QuoteTypeTest extends FormTestCase
{
    public function testSubmit(): void
    {
        $formData = [
            'client' => null,
            'discount' => 12,
            'items' => [],
            'terms' => '',
            'notes' => '',
            'total' => 0,
            'baseTotal' => 0,
            'tax' => 123,
        ];

        Money::setBaseCurrency('USD');

        $object = new Quote();

        $this->assertFormData($this->factory->create(QuoteType::class, $object), $formData, $object);
    }

    protected function getExtensions()
    {
        $type = new QuoteType(new Currency('USD'));
        $itemType = new ItemType($this->registry);

        return [
            new PreloadedExtension([$type, $itemType, new DiscountType(new Currency('USD'))], []),
        ];
    }
}
