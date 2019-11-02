<?php

namespace App\Http\Controllers\Hotel\Admin\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\ReportRequest;
use App\Models\Order;
use App\Models\Settings;
use App\Repositories\OrderRepository;
use App\Repositories\SettingsRepository;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var SettingsRepository
     */
    private $settingsRepository;

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
        $this->settingsRepository = app(SettingsRepository::class);
    }

    public function index()
    {
        $hotels = $this->settingsRepository->getSettingsHotels();

        return view('hotel.admin.report.index', compact('hotels'));
    }

    public function generate(ReportRequest $request)
    {
        $hotels = $this->settingsRepository->getSettingsHotels();

        $result = $this->orderRepository->getSumOrder($request);

        $date = new Carbon;
        $date->locale('ru');

        $item = [
            'result' => $result,
            'beginning' => $request->beginning,
            'end' => $request->end,
            'readable_format_beginning' => $date->parse($request->beginning)->isoFormat('D MMM Y г.'),
            'readable_format_end' => $date->parse($request->end)->isoFormat('D MMM Y г.'),
            'hotel_name' => $request->hotel_name,
        ];

        return view('hotel.admin.report.index', compact('item', 'hotels'));
    }
}
