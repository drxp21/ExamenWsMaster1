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

    'accepted' => 'Le champ :attribute doit être accepté.',
    'active_url' => 'Le champ :attribute doit être une URL valide.',
    'after' => 'Le champ :attribute doit être une date après :date.',
    'after_or_equal' => 'Le champ :attribute doit être une date après ou égale à :date.',
    'alpha' => 'Le champ :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'Le champ :attribute ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
    'alpha_num' => 'Le champ :attribute ne doit contenir que des lettres et des chiffres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'before' => 'Le champ :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date avant ou égale à :date.',
    'between.file' => 'Le fichier :attribute doit avoir une taille entre :min et :max kilo-octets.',
    'between.numeric' => 'Le champ :attribute doit être compris entre :min et :max.',
    'between.string' => 'Le champ :attribute doit contenir entre :min et :max caractères.',
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'Le champ :attribute doit être une date valide.',
    'date_equals' => 'Le champ :attribute doit être une date égale à :date.',
    'date_format' => 'Le champ :attribute ne correspond pas au format :format.',
    'decimal' => 'Le champ :attribute doit avoir :decimal décimales.',
    'digits' => 'Le champ :attribute doit avoir :digits chiffres.',
    'digits_between' => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions' => 'Les dimensions de l\'image :attribute sont invalides.',
    'distinct' => 'Le champ :attribute a une valeur en double.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'ends_with' => 'Le champ :attribute doit se terminer par l\'une des valeurs suivantes : :values.',
    'exists' => 'La valeur sélectionnée pour :attribute est invalide.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt.numeric' => 'Le champ :attribute doit être supérieur à :value.',
    'gt.file' => 'Le fichier :attribute doit être supérieur à :value kilo-octets.',
    'gt.string' => 'Le champ :attribute doit contenir plus de :value caractères.',
    'gt.array' => 'Le tableau :attribute doit contenir plus de :value éléments.',
    'gte.numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
    'gte.file' => 'Le fichier :attribute doit être supérieur ou égal à :value kilo-octets.',
    'gte.string' => 'Le champ :attribute doit contenir au moins :value caractères.',
    'gte.array' => 'Le tableau :attribute doit contenir :value éléments ou plus.',
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'La valeur sélectionnée pour :attribute est invalide.',
    'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
    'integer' => 'Le champ :attribute doit être un nombre entier.',
    'ip' => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le champ :attribute doit être une chaîne JSON valide.',
    'lt.numeric' => 'Le champ :attribute doit être inférieur à :value.',
    'lt.file' => 'Le fichier :attribute doit être inférieur à :value kilo-octets.',
    'lt.string' => 'Le champ :attribute doit contenir moins de :value caractères.',
    'lt.array' => 'Le tableau :attribute doit contenir moins de :value éléments.',
    'lte.numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
    'lte.file' => 'Le fichier :attribute doit être inférieur ou égal à :value kilo-octets.',
    'lte.string' => 'Le champ :attribute doit contenir au plus :value caractères.',
    'lte.array' => 'Le tableau :attribute ne doit pas contenir plus de :value éléments.',
    'max.numeric' => 'Le champ :attribute ne doit pas être supérieur à :max.',
    'max.file' => 'Le fichier :attribute ne doit pas dépasser :max kilo-octets.',
    'max.string' => 'Le champ :attribute ne doit pas contenir plus de :max caractères.',
    'max.array' => 'Le tableau :attribute ne doit pas contenir plus de :max éléments.',
    'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'min.numeric' => 'Le champ :attribute doit être au moins :min.',
    'min.file' => 'Le fichier :attribute doit être au moins de :min kilo-octets.',
    'min.string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    'min.array' => 'Le tableau :attribute doit contenir au moins :min éléments.',
    'not_in' => 'La valeur sélectionnée pour :attribute est invalide.',
    'not_regex' => 'Le format du champ :attribute est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'Le format du champ :attribute est invalide.',
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est obligatoire lorsque :other est :value.',
    'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est obligatoire lorsque :values est présent.',
    'required_with_all' => 'Le champ :attribute est obligatoire lorsque :values sont présents.',
    'required_without' => 'Le champ :attribute est obligatoire lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsqu\'aucun de :values n\'est présent.',
    'same' => 'Les champs :attribute et :other doivent correspondre.',
    'size.numeric' => 'Le champ :attribute doit être :size.',
    'size.file' => 'Le fichier :attribute doit être de :size kilo-octets.',
    'size.string' => 'Le champ :attribute doit contenir :size caractères.',
    'size.array' => 'Le tableau :attribute doit contenir :size éléments.',
    'starts_with' => 'Le champ :attribute doit commencer par l\'une des valeurs suivantes : :values.',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone' => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique' => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded' => 'Le fichier :attribute n\'a pu être téléversé.',
    'url' => 'Le format du champ :attribute est invalide.',
    'uuid' => 'Le champ :attribute doit être un UUID valide.',

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

    'attributes' => [],

];
