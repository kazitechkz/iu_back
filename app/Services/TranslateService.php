<?php

namespace App\Services;

use App\Helpers\StrHelper;
use App\Models\Question;
use App\Models\QuestionTranslation;
use App\Models\SubjectContext;
use App\Models\SubjectContextTranslation;
use App\Models\UserQuestion;

class TranslateService
{
    private const IAM_TOKEN = 'AQVN3U-7Xim1Vxz1hVeirOskh3m_K7aQLAui5XTL';
    private const FOLDER_ID = 'b1go8o67uis9r9bknad2';
    private const TARGET_LANGUAGE = 'ru';
    private const SOURCE_LANGUAGE = 'kk';
    private const URL = 'https://translate.api.cloud.yandex.net/translate/v2/translate';

    public static function translate($text)
    {
        $headers = [
            'Content-Type: application/json',
            "Authorization: Api-Key " . self::IAM_TOKEN
        ];
        $post_data = [
            "sourceLanguageCode" => self::SOURCE_LANGUAGE,
            "targetLanguageCode" => self::TARGET_LANGUAGE,
            "texts" => $text,
            "folderId" => self::FOLDER_ID,
        ];
        $data_json = json_encode($post_data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($curl, CURLOPT_URL, self::URL);
        curl_setopt($curl, CURLOPT_POST, true);
        $result = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($result, 1);
        return $res['translations'][0]['text'];
    }

    public static function saveOneAnswerQuestion($question): void
    {
        $question = json_decode($question, 1);
        $trn = QuestionTranslation::where('question_kk', $question['id'])->first();
        if ($trn) {
            return;
        }
        $data = self::initialData($question);
        self::saveData($data, $question);
    }

    public static function saveContextQuestion($question): void
    {
        $question = json_decode($question, 1);
        $trn = QuestionTranslation::where('question_kk', $question['id'])->first();
        if ($trn) {
            return;
        }
        $contextTrn = SubjectContextTranslation::where('context_kk', $question['context_id'])->first();
        if ($contextTrn) {
            $contextID = $contextTrn->context_ru;
        } else {
            $context = SubjectContext::create([
                'subject_id' => $question['subject_id'],
                'context' => StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['context']['context']))
            ]);
            SubjectContextTranslation::create([
                'subject_id' => $question['subject_id'],
                'context_kk' => $question['context_id'],
                'context_ru' => $context->id
            ]);
            $contextID = $context->id;
        }
        $data = self::initialData($question, $contextID);
        self::saveData($data, $question);
    }

    protected static function initialData($question, $context_id = null): array
    {
        if ($context_id) {
            $data['context_id'] = $context_id;
        }
        $data['text'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['text']));
        $data['answer_a'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_a']));
        $data['answer_b'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_b']));
        $data['answer_c'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_c']));
        $data['answer_d'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_d']));
        if ($question['answer_e']) {
            $data['answer_e'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_e']));
        }
        if ($question['answer_f']) {
            $data['answer_f'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_f']));
        }
        if ($question['answer_g']) {
            $data['answer_g'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_g']));
        }
        if ($question['answer_h']) {
            $data['answer_h'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['answer_h']));
        }
        $data['correct_answers'] = $question['correct_answers'];
        if ($question['prompt']) {
            $data['prompt'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['prompt']));
        }
        $data['locale_id'] = 2;
        if ($question['explanation']) {
            $data['explanation'] = StrHelper::getFormattedTextForTranslateService(TranslateService::translate($question['explanation']));
        }
        $data['subject_id'] = $question['subject_id'];
        $data['type_id'] = $question['type_id'];
        $data['group_id'] = $question['group_id'];
        $data['sub_category_id'] = $question['sub_category_id'];
        return $data;
    }

    protected static function saveData($data, $question): void
    {
        $questionRu = Question::add($data);
        UserQuestion::create([
            'question_id' => $questionRu->id,
            'user_id' => auth()->guard('web')->id()
        ]);
        QuestionTranslation::create([
            'subject_id' => $question['subject_id'],
            'type_id' => $question['type_id'],
            'group_id' => $question['group_id'],
            'question_kk' => $question['id'],
            'question_ru' => $questionRu->id
        ]);
    }
}
