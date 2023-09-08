<?php

namespace App\Helpers;

use App\Models\SubjectContext;
use Illuminate\Http\Request;

class MathFormulaHelper
{
    private const SINGLE_TYPE_ID = 1;
    private const CONTEXT_TYPE_ID = 2;
    private const GROUP_ID = 1;
    public static function replace(Request $request): array|string
    {
        $math = new self();
        $data = $request->all();
        if (is_array($data['correct_answers'])) {
            $data['correct_answers'] = implode(',', json_decode($data['correct_answers']));
        }
        if (!isset($data['group_id'])) {
            $data['group_id'] = self::GROUP_ID;
        }
        $data['text'] = $math->getReplaceStr($data['text']);
        if (!isset($data['context_id'])) {
            if (isset($data['context'])) {
                if (!isset($data['type_id'])) {
                    $data['type_id'] = self::CONTEXT_TYPE_ID;
                }
                $context = SubjectContext::create([
                   'subject_id' => $data['subject_id'],
                   'context' => $math->getReplaceStr($data['context'])
                ]);
                $data['context_id'] = $context->id;
            } else {
                if (!isset($data['type_id'])) {
                    $data['type_id'] = self::SINGLE_TYPE_ID;
                }
            }
        } else {
            if (!isset($data['type_id'])) {
                $data['type_id'] = self::CONTEXT_TYPE_ID;
            }
        }
        $data['answer_a'] = $math->getReplaceStr($data['answer_a']);
        $data['answer_b'] = $math->getReplaceStr($data['answer_b']);
        $data['answer_c'] = $math->getReplaceStr($data['answer_c']);
        $data['answer_d'] = $math->getReplaceStr($data['answer_d']);
        if (isset($data['answer_e'])) {
            $data['answer_e'] = $math->getReplaceStr($data['answer_e']);
        }
        if (isset($data['answer_f'])) {
            $data['answer_f'] = $math->getReplaceStr($data['answer_f']);
        }
        if (isset($data['answer_g'])) {
            $data['answer_g'] = $math->getReplaceStr($data['answer_g']);
        }
        if (isset($data['answer_h'])) {
            $data['answer_h'] = $math->getReplaceStr($data['answer_h']);
        }
        if (isset($data['prompt'])) {
            $data['prompt'] = $math->getReplaceStr($data['prompt']);
        }
        if (isset($data['explanation'])) {
            $data['explanation'] = $math->getReplaceStr($data['explanation']);
        }
        return $data;
    }

    public function getReplaceStr($text): array|string
    {
//        $text = str_replace('$$', '<tex>', $text);
//        return str_replace('@@', '</tex>', $text);
        $text = str_replace('$$', '<pre>', $text);
        return str_replace('@@', '</pre>', $text);
    }
}
