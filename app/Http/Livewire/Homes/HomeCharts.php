<?php

namespace App\Http\Livewire\Homes;

use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;


class HomeCharts extends Component
{

    public $izins;
    

    public $colors = [
        'Izin Mendirikan Bangunan (IMB)' => '#f6ad55',
        'Surat Rekomendasi SITU/SIUP' => '#fc8181',
        'Surat Rekomendasi (Pengurusan Sertifikat Tanah)' => '#90cdf4',
        'Surat Keterangan Lokasi Tanah' => '#66DA26',
        'Surat Keterangan Nikah' => '#cbd5e0',
        'Surat Dispensasi Nikah' => '#66DA26',
        'Surat Keterangan Perekaman E-KTP' => '#fc8181',
    ];

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function render()
    {
        $this->izins=\App\Models\Izin::get();
        $pengajuans = \App\Models\Pengajuan::whereIn('izin_id', $this->izins->id)->get();

        $columnChartModel = $pengajuans->groupBy('izin_id')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->izins->nama_izin;
                $value = count($pengajuans);

                return $columnChartModel->addColumn($type, $value, $this->colors[ $this->izins->nama_izin]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Pengajuan by Izin')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
                ->withGrid()
            );

        $pieChartModel = $pengajuans->groupBy('izin_id')
            ->reduce(function ($pieChartModel, $data) {
                $type = $data->first()->izins->nama_izin;
                $value = count($pengajuans);

                return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
            }, LivewireCharts::pieChartModel()
                //->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
            );

        /*$lineChartModel = $expenses
            ->reduce(function ($lineChartModel, $data) use ($expenses) {
                $index = $expenses->search($data);

                $amountSum = $expenses->take($index + 1)->sum('amount');

                if ($index == 6) {
                    $lineChartModel->addMarker(7, $amountSum);
                }

                if ($index == 11) {
                    $lineChartModel->addMarker(12, $amountSum);
                }

                return $lineChartModel->addPoint($index, $data->amount, ['id' => $data->id]);
            }, LivewireCharts::lineChartModel()
                //->setTitle('Expenses Evolution')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            );

        $areaChartModel = $expenses
            ->reduce(function ($areaChartModel, $data) use ($expenses) {
                $index = $expenses->search($data);
                return $areaChartModel->addPoint($index, $data->amount, ['id' => $data->id]);
            }, LivewireCharts::areaChartModel()
                //->setTitle('Expenses Peaks')
                ->setAnimated($this->firstRun)
                ->setColor('#f6ad55')
                ->withOnPointClickEvent('onAreaPointClick')
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setXAxisVisible(true)
                ->sparklined()
            );

        $multiLineChartModel = $expenses
            ->reduce(function ($multiLineChartModel, $data) use ($expenses) {
                $index = $expenses->search($data);

                return $multiLineChartModel
                    ->addSeriesPoint($data->type, $index, $data->amount,  ['id' => $data->id]);
            }, LivewireCharts::multiLineChartModel()
                //->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->multiLine()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
            );

        $multiColumnChartModel = $expenses->groupBy('type')
            ->reduce(function ($multiColumnChartModel, $data) {
                $type = $data->first()->type;

                return $multiColumnChartModel
                    ->addSeriesColumn($type, 1, $data->sum('amount'));
            }, LivewireCharts::multiColumnChartModel()
                ->setAnimated($this->firstRun)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->withOnColumnClickEventName('onColumnClick')
                ->setTitle('Revenue per Year (K)')
                ->stacked()
                ->withGrid()
            );
            */

        $this->firstRun = false;

        return view('livewire.homes.home-charts')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                //'lineChartModel' => $lineChartModel,
                //'areaChartModel' => $areaChartModel,
                //'multiLineChartModel' => $multiLineChartModel,
                //'multiColumnChartModel' => $multiColumnChartModel,
            ]);
    
}
