<?php

/**
 * The MIT License
 *
 * Copyright (c) 2023 "YooMoney", NBСO LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace App\Services\YooKassa\Model\Payout;

use App\Services\YooKassa\Common\AbstractEnum;
use App\Services\YooKassa\Model\PaymentMethodType;

/**
 * PayoutDestinationType - Виды выплат
 *
 * Возможные значения:
 * - `yoo_money` - Выплата в кошелек ЮMoney
 * - `bank_card` - Выплата на произвольную банковскую карту
 * - `sbp` - Выплата через СБП на счет в банке или платежном сервисе
 */
class PayoutDestinationType extends AbstractEnum
{
    protected static $validValues = array(
        PaymentMethodType::YOO_MONEY => true,
        PaymentMethodType::BANK_CARD => true,
        PaymentMethodType::SBP => true,
    );
}
