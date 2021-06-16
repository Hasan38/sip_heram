<?php

namespace App\Http\Livewire\Homes;

use App\Models\Expense;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;


class Home extends Component
{

    public $izins,$pengajuans=[],$month,$sum,$periode,$split,$now;
    public $types = ['Izin Mendirikan Bangunan (IMB)',
    'Surat Rekomendasi SITU/SIUP',
    'Surat Rekomendasi (Pengurusan Sertifikat Tanah)',
    'Surat Keterangan Lokasi Tanah',
    'Surat Keterangan Nikah',
    'Surat Dispensasi Nikah',
    'Surat Keterangan Perekaman E-KTP'];
   

    public $colors = [
        'Izin Mendirikan Bangunan (IMB)' => '#0074D9',
        'Surat Rekomendasi SITU/SIUP' => '#FF4136',
        'Surat Rekomendasi (Pengurusan Sertifikat Tanah)' => '#2ECC40',
        'Surat Keterangan Lokasi Tanah' => '#FF851B',
        'Surat Keterangan Nikah' => '#7FDBFF',
        'Surat Dispensasi Nikah' => '#B10DC9',
        'Surat Keterangan Perekaman E-KTP' => '#FFDC00',
    ];

    public $firstRun = true;

    public $showDataLabels = true;

    /*protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
      
    }

    public function handleOnSliceClick($slice)
    {
      
    }

    public function handleOnColumnClick($column)
    {
        
    }
*/
    public function render()
    {
        if($this->month){
            
        $date = \DateTime::createFromFormat('m-Y', $this->month);
        $this->periode = $date->format('F Y');
        $this->split = explode('-', $this->month);
        $this->sum=\App\Models\Pemohon::with('pengajuans')->whereHas('pengajuans', function($query){
        $query->whereMonth('created_at','=',$this->split[0]);
        $query->whereYear('created_at','=',$this->split[1]);
        })->orderBy('kelurahan_id')->get();
        $this->izins=\App\Models\Izin::select('id')->get();
        $expenses = \App\Models\Pengajuan::whereIn('izin_id', $this->izins)
        ->whereMonth('created_at','=',$this->split[0])
        ->whereYear('created_at','=',$this->split[1])->get();
       
         $columnChartModel = $expenses->groupBy('izin_id')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->izins->nama_izin;
                $value = count($data);
                

                return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Jumlah Pengajuan')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors($this->colors)
                ->setColumnWidth(90)
                ->withGrid()
            );

        
        
  
        $pieChartModel = $expenses->groupBy('izin_id')->reduce(function ($pieChartModel, $data) {
            $type = $data->first()->izins->nama_izin;
            $value = count($data);

                return $pieChartModel->addSlice($type, $value, $this->colors[$type]); 
            }, LivewireCharts::pieChartModel()
                //->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors($this->colors)
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

        return view('livewire.homes.home')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                //'lineChartModel' => $lineChartModel,
                //'areaChartModel' => $areaChartModel,
                //'multiLineChartModel' => $multiLineChartModel,
                //'multiColumnChartModel' => $multiColumnChartModel,
            ]);
        }else{
        $this->month=
        $this->now = \Carbon\Carbon::now();
        $this->periode = date('F Y',strtotime($this->now));
        $this->month=$this->periode;
        $this->sum=\App\Models\Pemohon::with('pengajuans')->whereHas('pengajuans', function($query){
            $query->whereMonth('created_at','=',$this->now->month);
            $query->whereYear('created_at','=',$this->now->year);
        })->orderBy('kelurahan_id')->get();
        $this->izins=\App\Models\Izin::select('id')->get();
        $expenses = \App\Models\Pengajuan::whereIn('izin_id', $this->izins)
        ->whereMonth('created_at','=',$this->now->month)
        ->whereYear('created_at','=',$this->now->year)->get();
       
         $columnChartModel = $expenses->groupBy('izin_id')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->izins->nama_izin;
                $value = count($data);
                

                return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Jumlah Pengajuan')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors($this->colors)
                ->setColumnWidth(90)
                ->withGrid()
            );

        
        
  
        $pieChartModel = $expenses->groupBy('izin_id')->reduce(function ($pieChartModel, $data) {
            $type = $data->first()->izins->nama_izin;
            $value = count($data);

                return $pieChartModel->addSlice($type, $value, $this->colors[$type]); 
            }, LivewireCharts::pieChartModel()
                //->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors($this->colors)
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

        return view('livewire.homes.home')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                //'lineChartModel' => $lineChartModel,
                //'areaChartModel' => $areaChartModel,
                //'multiLineChartModel' => $multiLineChartModel,
                //'multiColumnChartModel' => $multiColumnChartModel,
            ]);

        }
    }
    
}

