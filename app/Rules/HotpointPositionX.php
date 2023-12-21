<?php

namespace App\Rules;

use App\Models\Hotpoint;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HotpointPositionX implements ValidationRule
{
    private int|null $id;
    private int|null $y;

    public function __construct(int|null $id, int|null $y)
    {
        $this->id = $id;
        $this->y = $y;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->isCloseHotpointExist($value)) {
            $fail('The :attribute is invalid. There is another hotpoint at this place. Please change the value.');
        }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    private function isCloseHotpointExist(mixed $value): bool
    {
        $xBufferMax = $value + Hotpoint::BUFFER;
        $xBufferMin = $value >= Hotpoint::BUFFER ? $value - Hotpoint::BUFFER : 0;
        $yBufferMax = $this->y + Hotpoint::BUFFER;
        $yBufferMin = $this->y >= Hotpoint::BUFFER ? $this->y - Hotpoint::BUFFER : 0;

        $query = Hotpoint::query()
            ->where('position_x', '<', $xBufferMax)
            ->where('position_x', '>', $xBufferMin)
            ->where('position_y', '<', $yBufferMax)
            ->where('position_y', '>', $yBufferMin);

        if($this->id) {
            $query->where('id', '!=', $this->id);
        }

        return (bool)$query->first();
    }
}
