<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlySubjectsChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($data): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Анализ подписок по предметам')
            ->addData('Математическая грамотность', $data['subject_1'])
            ->addData('История Казахстана', $data['subject_2'])
            ->addData('Грамотность чтения', $data['subject_3'])
            ->addData('Математика', $data['subject_4'])
            ->addData('Физика', $data['subject_5'])
            ->addData('Химия', $data['subject_6'])
            ->addData('Биология', $data['subject_7'])
            ->addData('География', $data['subject_8'])
            ->addData('Всемирная история', $data['subject_9'])
            ->addData('Основы права', $data['subject_10'])
            ->addData('Английский язык', $data['subject_11'])
            ->addData('Казахский язык', $data['subject_12'])
            ->addData('Казахская литература', $data['subject_13'])
            ->addData('Русский язык', $data['subject_14'])
            ->addData('Русская литература', $data['subject_15'])
            ->addData('Информатика', $data['subject_16'])
            ->setXAxis($data['dates']);
    }

}
