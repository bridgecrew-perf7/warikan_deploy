<?php

declare(strict_types=1);

namespace App\ViewModels\Base;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * Class ViewModel ViewModelのベースクラス
 * @package App\ViewModels\Base
 */
abstract class ViewModel implements Arrayable
{
    /**
     * データをキーバリューのarrayに変換します
     * @return array
     */
    abstract public function toMap(): array;

    /**
     * 再帰的にarrayに変換します
     * @return array
     */
    final public function toArray(): array
    {
        $result = $this->toMap();
        foreach ($result as $key => $value) {
            if ($value instanceof Arrayable) {
                $result[$key] = $value->toArray();
            } elseif (is_array($value)) {
                $result[$key] = collect($value)->toArray();
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /**
     * 金額などのフォーマット用メソッド
     * @param int $number
     * @return string
     */
    final protected function formatAccountNumber(int $number): string
    {
        return '¥' . number_format($number);
    }
}
