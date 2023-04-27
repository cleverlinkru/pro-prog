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

namespace App\Services\YooKassa\Model;

use App\Services\YooKassa\Common\AbstractEnum;

/**
 * Класс с перечислением статусов доставки данных для чека в онлайн-кассу (`pending`, `succeeded` или `canceled`)
 *
 * Состояние регистрации фискального чека:
 * - `pending` - Чек ожидает доставки
 * - `succeeded` - Успешно доставлен
 * - `canceled` - Чек не доставлен
 */
class ReceiptRegistrationStatus extends AbstractEnum
{
    /** Состояние регистрации фискального чека: ожидает доставки */
    const PENDING = 'pending';
    /** Состояние регистрации фискального чека: успешно доставлен */
    const SUCCEEDED = 'succeeded';
    /** Состояние регистрации фискального чека: не доставлен */
    const CANCELED = 'canceled';

    protected static $validValues = array(
        self::PENDING => true,
        self::SUCCEEDED => true,
        self::CANCELED => true,
    );
}
