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

namespace App\Services\YooKassa\Model\ConfirmationAttributes;

use App\Services\YooKassa\Common\AbstractObject;
use App\Services\YooKassa\Common\Exceptions\EmptyPropertyValueException;
use App\Services\YooKassa\Common\Exceptions\InvalidPropertyValueException;
use App\Services\YooKassa\Common\Exceptions\InvalidPropertyValueTypeException;
use App\Services\YooKassa\Helpers\TypeCast;
use App\Services\YooKassa\Model\ConfirmationType;

/**
 * Способ подтверждения платежа
 *
 * @property-read string $type
 */
abstract class AbstractConfirmationAttributes extends AbstractObject
{
    /**
     * @var string
     */
    private $_type;

    /**
     * @var string
     */
    private $_locale;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param string $value
     */
    protected function setType($value)
    {
        if ($value === null || $value === '') {
            throw new EmptyPropertyValueException(
                'Empty value for "type" parameter in ConfirmationAttributes',
                0,
                'confirmationAttributes.type'
            );
        }
        if (TypeCast::canCastToEnumString($value)) {
            if (ConfirmationType::valueExists($value)) {
                $this->_type = (string)$value;
            } else {
                throw new InvalidPropertyValueException(
                    'Invalid value for "type" parameter in ConfirmationAttributes',
                    0,
                    'confirmationAttributes.type',
                    $value
                );
            }
        } else {
            throw new InvalidPropertyValueTypeException(
                'Invalid value type for "type" parameter in ConfirmationAttributes',
                0,
                'confirmationAttributes.type',
                $value
            );
        }
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * @param string $value
     */
    public function setLocale($value)
    {
        if ($value === null || $value === '') {
            $this->_locale = null;
        } elseif (!TypeCast::canCastToString($value)) {
            throw new InvalidPropertyValueTypeException(
                'Invalid value type for "locale" parameter in ConfirmationAttributes',
                0,
                'confirmationAttributes.locale',
                $value
            );
        } elseif (!preg_match('/^[a-z]{2}_[A-Z]{2}$/', (string)$value)) {
            throw new InvalidPropertyValueException(
                'Invalid value type for "locale" parameter in ConfirmationAttributes',
                0,
                'confirmationAttributes.locale',
                $value
            );
        } else {
            $this->_locale = (string)$value;
        }
    }
}
