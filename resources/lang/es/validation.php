<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Líneas de idioma para la validación
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de idioma incluyen los mensajes de error de default en el caso de
    | errores de validación. Algunas de esas reglas tienen múltiples versiones, como
    | las del tamaño. Puede encontrar todos estos mensajes aqui.
    |
    */
    'unique_wallet' => 'Wallet ya elegido',
    'unique_wallet_update' => 'Wallet ya elegido',
    'accepted' => 'Captcha tiene que ser aceptado.',
    'active_url' => 'El :atributo no es un URL valido',
    'after' => 'El :atributo tiene que ser una fecha despues de :fecha.',
    'after_or_equal' => 'El :atributo tiene que ser una fecha despues de o igual a :fecha.',
    'alpha' => 'El :atributo solo puede contener letras.',
    'alpha_dash' => 'El :atributo solo puede contener letras, numeros y dashes.',
    'alpha_num' => 'El :atributo solo puede contener letras y numeros.',
    'array' => 'El :atributo tiene que ser una flecha.',
    'before' => 'El :atributo tiene que ser una fecha antes de :fecha.',
    'before_or_equal' => 'El :atributo tiene que ser una fecha antes o igual a :fecha.',
    'between' => [
        'numeric' => 'El :atributo tiene que ser entre :min y :max.',
        'file' => 'El :atributo tiene que ser entre :min y :max kilobytes.',
        'string' => 'El :atributo tiene que ser entre :min y:max caracteres.',
        'array' => 'El :atributo tiene que tener entre :min y:max items.',
    ],
    'boolean' => 'El :campo atributo tiene que ser veradero o falso.',
    'confirmed' => 'Los campos no corresponden el uno al otro.',
    'date' => 'El :atributo no es una fecha valida.',
    'date_format' => 'El :atributo no corresponde a la dimensión :dimension.',
    'different' => 'El :atributo y:oElr tiene que ser diferente.',
    'digits' => 'El :atributo tiene que ser :digits digits.',
    'digits_between' => 'El :atributo tiene que ser entre :min y:max digits.',
    'dimensions' => 'El :atributo contiene una imagen de dimensiones no válidas.',
    'distinct' => 'El :campo atributo tiene un valor duplicado.',
    'email' => 'El mail tiene que contener el símbolo "@".',
    'exists' => 'El :atributo seleccionado no es válido.',
    'file' => 'El :atributo tiene que ser un file.',
    'filled' => 'El :campo atributo tiene que contener un valor.',
    'image' => 'El :atributo tiene que ser una imagen.',
    'in' => 'El :atributo seleccionado no es válido.',
    'in_array' => 'El :campo atributo no existe en :oElr.',
    'integer' => 'El :atributo tiene que ser un numero entero.',
    'ip' => 'El :atributo tiene que ser un IP valido.',
    'ipv4' => 'El :atributo tiene que ser un IPv4 valido.',
    'ipv6' => 'El :atributo tiene que ser un IPv6 valido.',
    'json' => 'El :atributo tiene que ser un JSON string valido.',
    'max' => [
        'numeric' => 'El :atributo no tiene que ser más grande de :max.',
        'file' => 'El :atributo no tiene que ser más grande que :max kilobytes.',
        'string' => 'Este campo no tiene que ser más grande de :max caracteres.',
        'array' => 'El :atributo no tiene que tener más de :max items.',
    ],
    'mimes' => 'El :atributo tiene que ser un file de tipo: :valores.',
    'mimetypes' => 'El :atributo tiene que ser un file de tipo: :valores.',
    'min' => [
        'numeric' => 'El :atributo tiene que ser por lo menos :min.',
        'file' => 'El :atributo tiene que ser por lo menos :min kilobytes.',
        'string' => 'Este campo tiene que ser por lo menos :min caracteres.',
        'array' => 'El :atributo tiene que tener por lo menos :min items.',
    ],
    'not_in' => 'El :atributo seleccionado no es válido.',
    'numeric' => 'El :atributo tiene que ser un número.',
    'present' => 'El :campo atributo tiene que ser presente.',
    'regex' => 'El :tamaño del atributo no es válido.',
    'requesto' => 'Este campo es requerido.',
    'requesto_if' => 'El :campo atributo es requerido cuando :oElr es :valor.',
    'requesto_unless' => 'El :campo atributo es requerido a no ser que :oElr es en :valores',
    'requesto_with' => 'El :campo atributo es requerido cuando :valores es presente.',
    'requesto_with_all' => 'El :campo atributo es requerido cuando :valores es presente.',
    'requesto_without' => 'El :campo atributo es requerido cuando :valores no es presente.',
    'requesto_without_all' => 'El :campo atributo es requerido cuando ninguno de :valores son presentes.',
    'same' => 'El :atributo y:oElr tiene que corresponder.',
    'tamaño' => [
        'numeric' => 'El :atributo tienen que ser :tamaño.',
        'file' => 'El :atributo tiene que ser: tamaño kilobytes.',
        'string' => 'El :atributo tiene que ser :tamaño caracteres.',
        'array' => 'El :atributo tiene que contener :tamaño items.',
    ],
    'string' => 'El :atributo tiene que ser una string.',
    'timezone' => 'El :atributo tiene que ser una zona valida.',
    'unique' => 'El :atributo ya ha sido elegido.',
    'uploaded' => 'El :atributo no ha sido cargado.',
    'url' => 'El :tamaño del atributo no es válido.',

    /*
    |--------------------------------------------------------------------------
    | Líneas de idioma para la validación del cliente
    |--------------------------------------------------------------------------
    |
    | Aquí tienes que especificar los mensajes de validación del cliente por atributos que utilizan la convención
    | "atributo.regla" para nominar las líneas. Este hace que sea más rápido
    | especificar la línea de idioma del cliente en particular para una regla de atributo.
    |
    */

    'custom' => [
        'atributo-name' => [
            'rule-name' => 'mensaje del cliente',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de validación del cliente
    |--------------------------------------------------------------------------
    |
    | Las siguientes líneas de idioma son utilizadas para intercambiar el atributo lugar-titular
    | con algo que sea más simple para el lector, como por ejemplo correo electrónico
    | en lugar de "mail". Este simplemente nos ayuda a tener los mensajes un poquito más claros.
    |
    */

    'atributos' => [],

];
