<?php

namespace Terranet\Administrator\Field\Detectors;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\StringType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Terranet\Administrator\Field\Email;

class EmailDetector extends AbstractDetector
{
    /**
     * Authorize execution.
     *
     * @param string $column
     * @param Column $metadata
     * @param Model $model
     *
     * @return bool
     */
    protected function authorize(string $column, Column $metadata, Model $model): bool
    {
        return $metadata->getType() instanceof StringType && Str::contains($column, 'email');
    }

    /**
     * Detect field class.
     *
     * @param string $column
     * @param Column $metadata
     * @param Model $model
     *
     * @return mixed
     */
    protected function detect(string $column, Column $metadata, Model $model)
    {
        return Email::class;
    }
}
