<?php

namespace App\Services;

use App\Models\AttemptSetting;
use App\Models\AttemptSettingsResult;
use App\Models\AttemptSettingsResultsUnt;
use App\Models\AttemptSettingsUnt;
use App\Models\User;
use Illuminate\Support\Carbon;

class TeacherDashboardService
{
    /**
     * @param AttemptSetting[] $attemptSettings
     * @return array
     */
    public function getTopSingleTestUsers($attemptSettings): array
    {
        $users = [];
        $data = [];
        $settingsIDS = $attemptSettings->pluck('id');
        foreach ($attemptSettings as $attemptSetting) {
            $users[] = json_encode($attemptSetting->users->pluck('id')->toArray());
        }
        $mergedArray = [];
        foreach ($users as $array) {
            $numbers = explode(',', trim($array, '[]'));
            $mergedArray = array_merge($mergedArray, $numbers);
        }
        $uniqueArray = array_values(array_unique($mergedArray, SORT_NUMERIC));
        $top_single_tests = AttemptSettingsResult::with('attempt', 'user', 'attempt_setting')
            ->whereIn('setting_id', $settingsIDS)
            ->whereIn('user_id', $uniqueArray)
            ->orderBy('created_at', 'DESC')
            ->take(7)
            ->get();
//        dd($top_single_tests);
        foreach ($top_single_tests as $top_single_test) {
            $data[$top_single_test->user->name][] = [
                'percentage' => round(($top_single_test->attempt->points/$top_single_test->attempt->max_points)*100),
                'points' => $top_single_test->attempt->points,
                'max_points' => $top_single_test->attempt->max_points,
                'subject' => $top_single_test->attempt_setting->subject->title_kk
            ];
        }

        foreach ($data as &$datum) {
            rsort($datum);
        }
        foreach ($data as $key => $value) {
            $data[$key] = $value[0];
        }
        arsort($data);
        return $data;
    }
    /**
     * @param AttemptSettingsUnt[] $attemptSettingsUnt
     * @return array
     */
    public function getTopUNTTestUsers($attemptSettingsUnt): array
    {
        $users = [];
        $data = [];
        $settingsIDS = $attemptSettingsUnt->pluck('id');
        foreach ($attemptSettingsUnt as $attemptSetting) {
            $users[] = $attemptSetting->users;
        }
        $mergedArray = [];
        foreach ($users as $array) {
            $mergedArray = array_merge($mergedArray, $array);
        }
        $uniqueArray = array_values(array_unique($mergedArray, SORT_NUMERIC));
        $top_unt_tests = AttemptSettingsResultsUnt::with('attempt', 'user')
            ->whereIn('setting_id', $settingsIDS)
            ->whereIn('user_id', $uniqueArray)
            ->orderBy('created_at', 'DESC')
            ->take(7)
            ->get();
        foreach ($top_unt_tests as $top_unt_test) {
            $data[$top_unt_test->user->name][] = [
                'percentage' => round(($top_unt_test->attempt->points/$top_unt_test->attempt->max_points)*100),
                'points' => $top_unt_test->attempt->points,
                'max_points' => $top_unt_test->attempt->max_points
            ];
        }
        foreach ($data as &$datum) {
            rsort($datum);
        }
        foreach ($data as $key => $value) {
            $data[$key] = $value[0];
        }
        arsort($data);
        return $data;
    }
}
