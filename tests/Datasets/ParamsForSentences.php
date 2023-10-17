<?php

dataset('params_for_sentences', function () {
    $paramsOne = [
        'word' => 'hat',
        'native_language' => 'pt-BR',
        'qtd_sentences' => 1,
        'level' => 'B2',
    ];
    $paramsTwo = [
        'word' => 'book',
        'native_language' => 'en-US',
        'qtd_sentences' => 3,
        'level' => 'A1',
    ];
    $paramsThree = [
        'word' => 'pencil',
        'native_language' => 'es-AT',
        'qtd_sentences' => 2,
        'level' => 'C1',
    ];
    return [
        [$paramsOne],
        [$paramsTwo],
        [$paramsThree],
    ];
});
