<?php

namespace App\Imports;

use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SubscriptionImports implements ToCollection, WithHeadingRow, WithMultipleSheets, WithChunkReading, SkipsEmptyRows
{
    public int $time;
    public function __construct($time) {
        $this->time = $time;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        ini_set("memory_limit", "8192M");
        ini_set("max_execution_time", 5000);
        $subjects = [1,2,3];
        foreach ($collection as $collect) {
            $user = User::where('email', $collect['email'])->first();
            if ($user) {
                $plans = [];
                $subjects[] = $this->getSubjectIDFromTitle($collect['pervyi_profilnyi_predmet']);
                $subjects[] = $this->getSubjectIDFromTitle($collect['vtoroi_profilnyi_predmet']);
                foreach ($subjects as $subject) {
                    $plan = Plan::where('tag', $this->getPlanTag($subject, $this->time))->first();
                    $plans[] = $plan->id;
                }
                foreach ($plans as $item) {
                    $plan = Plan::find($item);
                    if (PlanSubscription::where(["subscriber_id" => $user->id, "plan_id" => $plan->id])->first()) {
                        // Check subscriber to plan
                        $user->subscription($plan->tag)->delete();
                        //                    $user->subscription($plan->tag)->renew();
                    }
                    $user->newSubscription(
                        $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
                        $plan, // Plan or PlanCombination instance your subscriber is subscribing to
                        $plan->name, // Human-readable name for your subscription
                        $plan->description // Description
                    );
                }
            }
        }
    }
    public function rules(): array
    {
        return [
            'email' => 'required',
            "pervyi_profilnyi_predmet" => 'required',
            "vtoroi_profilnyi_predmet" => 'required'
        ];
    }
    public function headingRow(): int
    {
        return 1;
    }
    public function getSubjectIDFromTitle($title): int
    {
        return match ($title) {
            'Математика' => 4,
            'Физика' => 5,
            'Химия' => 6,
            'Биология' => 7,
            'География' => 8,
            'Всемирная история' => 9,
            'Основы права' => 10,
            'Английский язык' => 11,
            'Казахский язык' => 12,
            'Казахская литература' => 13,
            'Русский язык' => 14,
            'Русская литература' => 15,
            'Информатика' => 16,
            default => 1,
        };
    }
    public function getPlanTag($subjectID, $time): string
    {
        return $subjectID . '.' . $time;
    }

    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    public function chunkSize(): int
    {
        return 1;
    }
}
