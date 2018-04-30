# Punctuator for Laravel
A simple punctuator for texts. Adds spaces after punctuation marks and formats texts.

# How It Works
It is just a simple script that accespts a string and inspects it so that:
  The text begins with an uppercase character.
  After every fullstop(.) or question mark(?), there is a space and the next work begins with an uppercase character.
  After every comma(,), there is a space.
  
It is especially useful for formating user input before saving them to the database. It takes advantage of Laravel's model listeners through a Spacer.php trait.
  
# Usage
```php
use Roksta\Punctuator\Spacer;

class MyModel extends Model
{
    use Spacer;
    /**
    * set the columns you wish to punctuate in an array in the form shown below;
    * short defines columns where each word is to begin with an uppercase letter, eg, names, locations, etc
    * long is for sentences where spaces will be added after every comma, fullstop, etc.
    */
    public function setPunctuateColumns(): Array
    {
        return ['short' => ['name'], 'long' => ['description', 'comments']];
    }
    
    // Other model functions
}

```

# Results
sam roksta = Sam Roksta

this is very simple.really,really simple = This is very simple. Really, really simple.
