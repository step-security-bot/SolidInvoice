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

namespace SolidInvoice\CoreBundle\Twig\Extension;

use Money\Money;
use SolidInvoice\CoreBundle\Form\FieldRenderer;
use SolidInvoice\MoneyBundle\Calculator;
use Symfony\Component\Form\FormView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BillingExtension extends AbstractExtension
{
    private FieldRenderer $fieldRenderer;

    private Calculator $calculator;

    public function __construct(FieldRenderer $fieldRenderer, Calculator $calculator)
    {
        $this->fieldRenderer = $fieldRenderer;
        $this->calculator = $calculator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('billing_fields', function (FormView $form) {
                return $this->fieldRenderer->render($form, 'children[items].vars[prototype]');
            }, ['is_safe' => ['html']]),
            new TwigFunction('discount', function ($entity): Money {
                return $this->calculator->calculateDiscount($entity);
            }),
        ];
    }
}
