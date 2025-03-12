<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'required' => 'Das Feld ":attribute" ist ein Pflichtfeld.',
    'email' =>'Das :attribute Feld muss eine gültige E-Mail Adresse enthalten.',
    'string' => 'Das :attribute muss einen String enthalten.',

    'min' => [
        'numeric' => 'Der Wert im :attribute Feld muss mindestens :min sein.',
        'file' => 'Die Datei im :attribute Feld muss mindestens :min Lilobytes groß sein.',
        'string' => 'Die Eingabe des :attribute Feldes muss mindestens :min Zeichen lang sein.',
        'array' => 'Die Eingabe im :attribute Feld braucht mindestens :min Elemente.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'city' => 'Stadt',
        'country' => 'Land',
    ],

];
