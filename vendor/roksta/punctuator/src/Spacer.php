<?php

namespace Roksta\Punctuator;


/**
 * Class SimpleTextFormater
 * @package Package
 * @author sam_roksta
 *
 */
trait Spacer
{
    protected $punctuate_columns;

    /**
     * Set the columns to punctuate
     * @return Array
     */
    abstract public function setPunctuateColumns() : Array;

    /**
     * boot the trait
     */
    protected static function bootSpacer()
    {
        static::creating(function ($model) {
            $model->punctuate();
        });

        static::updating(function ($model) {
            $model->punctuate();
        });
    }

    /**
     * The selects the punctuation depending on the set columns.
     */
    protected function punctuate()
    {
        $columns = $this->setPunctuateColumns();

        collect($columns)->each(function($column, $type) {
            collect($column)->each(function($name) use ($type) {
                if ($type == 'short') {
                    if (isset($this->$name)) {
                        $this->$name = $this->parseString($this->$name);
                    }
                }

                if ($type == 'long') {
                    if (isset($this->$name)) {
                        $this->$name = $this->parseText($this->$name);
                    }
                }
            });
        });

        return $this;
    }

    /**
     * Parse long texts. Adds spaces and uppercases where necessary.
     * @param String $text
     * @return String
     */
    public function parseText(String $text)
    {
        // Space after . and next word begin with uppercase
        $pieces = explode('.', $text);
        $new_pieces = [];
        foreach ($pieces as $piece) {
            array_push($new_pieces, ucfirst($piece));
        }
        $text = implode('. ', $new_pieces);

        // Space after ? and next word begin with uppercase
        $pieces = explode('?', $text);
        $new_pieces = [];
        foreach ($pieces as $piece) {
            array_push($new_pieces, ucfirst($piece));
        }
        $text = implode('? ', $new_pieces);

        // Space after ,
        $pieces = explode(',', $text);
        $text = implode(', ', $pieces);

        return $text;
    }

    /**
     * Parse short strings and set every word to begin with uppercase
     * @param String $text
     * @return string
     */
    public function parseString(String $text)
    {
        return ucwords($text);
    }

}
