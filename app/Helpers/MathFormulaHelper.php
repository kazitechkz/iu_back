<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class MathFormulaHelper
{
    public static function replace(Request $request): array|string
    {
        $math = new self();
        $data = $request->all();
        $data['text'] = $math->getReplaceStr($data['text']);
        $data['context'] = $math->getReplaceStr($data['context']);
        $data['answer_a'] = $math->getReplaceStr($data['answer_a']);
        $data['answer_b'] = $math->getReplaceStr($data['answer_b']);
        $data['answer_c'] = $math->getReplaceStr($data['answer_c']);
        $data['answer_d'] = $math->getReplaceStr($data['answer_d']);
        $data['answer_e'] = $math->getReplaceStr($data['answer_e']);
        $data['answer_f'] = $math->getReplaceStr($data['answer_f']);
        $data['answer_g'] = $math->getReplaceStr($data['answer_g']);
        $data['answer_h'] = $math->getReplaceStr($data['answer_h']);
        $data['prompt'] = $math->getReplaceStr($data['prompt']);
        $data['explanation'] = $math->getReplaceStr($data['explanation']);
        return $data;
    }

    public function getReplaceStr($text): array|string
    {
        $text = str_replace('$$', '<tex>', $text);
        return str_replace('@@', '</tex>', $text);
    }
}
