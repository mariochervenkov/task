<?php

namespace App\Rules;

use App\Models\Hotpoint;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HotpointPositionY implements ValidationRule
{
    private int|null $id;
    private int|null $x;

    public function __construct(int|null $id, int|null $x)
    {
        $this->id = $id;
        $this->x = $x;
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
        $yBufferMax = $value + Hotpoint::BUFFER;
        $yBufferMin = $value >= Hotpoint::BUFFER ? $value - Hotpoint::BUFFER : 0;
        $xBufferMax = $this->x + Hotpoint::BUFFER;
        $xBufferMin = $this->x >= Hotpoint::BUFFER ? $this->x - Hotpoint::BUFFER : 0;

        $query = Hotpoint::query()
            ->where('position_y', '<', $yBufferMax)
            ->where('position_y', '>', $yBufferMin)
            ->where('position_x', '<', $xBufferMax)
            ->where('position_x', '>', $xBufferMin);

        if($this->id) {
            $query->where('id', '!=', $this->id);
        }

        return (bool)$query->first();
    }
}
