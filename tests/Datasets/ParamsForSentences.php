<?php

dataset('params_for_sentences', function () {
    $paramsOne = [
        'word' => 'hat',
        'qtd_sentences' => 1,
        'level' => 'B2',
    ];
    $paramsTwo = [
        'word' => 'book',
        'qtd_sentences' => 3,
        'level' => 'A1',
    ];
    $paramsThree = [
        'word' => 'pencil',
        'qtd_sentences' => 2,
        'level' => 'C1',
    ];
    return [
        [$paramsOne],
        [$paramsTwo],
        [$paramsThree],
    ];
});
