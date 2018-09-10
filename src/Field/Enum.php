<?php

namespace Terranet\Administrator\Field;

use Terranet\Administrator\Exception;

class Enum extends Generic
{
    protected $options = [];

    protected $colors = ['#777777', '#2574ab', '#259dab', '#5bc0de', '#e6ad5c', '#d9534f'];

    protected $palette = [];

    /**
     * @param array $options
     * @return self
     */
    public function setOptions(array $options): self
    {
        $i = 0;
        foreach ($options as $key => $value) {
            if (!array_has($this->palette, $key)) {
                $this->palette[$key] = $this->colors[$i % count($this->colors)];
                $i++;
            }
        }
        $this->options = $options;

        return $this;
    }

    /**
     * Set colors palette.
     *
     * @param string|array $colors
     * @param string|null $value
     */
    public function palette($color, string $value = null)
    {
        if (is_array($color)) {
            foreach ($color as $name => $code) {
                $this->palette($name, $code);
            }

            return $this;
        }

        if (!array_key_exists($color, $this->options)) {
            throw new Exception("Unknown option {$color}");
        }

        $this->palette[$color] = $value;

        return $this;
    }

    /**
     * @return array
     */
    protected function onEdit()
    {
        return [
            'options' => $this->options ?: [],
            'palette' => $this->palette,
        ];
    }

    /**
     * @return array
     */
    protected function onIndex()
    {
        return $this->onEdit();
    }

    /**
     * @return array
     */
    protected function onView()
    {
        return $this->onEdit();
    }
}