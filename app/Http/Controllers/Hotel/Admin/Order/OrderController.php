<?php

namespace App\Http\Controllers\Hotel\Admin\Order;

use App\Http\Controllers\Hotel\Admin\BaseController as AdminController;
use App\Http\Requests\Order\BaseRequest as OrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\SettingsRepository;
use App\Services\CalculationServices;

class OrderController extends AdminController
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
        parent::__construct();

        $this->orderRepository = app(OrderRepository::class);
        $this->settingsRepository = app(SettingsRepository::class);
        $this->calculationServices = app(CalculationServices::class);
    }

    public function index()
    {
        $items = $this->orderRepository->getAllWithPaginate(50);

        return view('hotel.admin.orders.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(OrderRequest $request)
    {
        $settings = $this->settingsRepository->getAllSettings();

        if ($request->button == 'calculation') {
            $item = $this->calculationServices->calculation($request);

            $trashed = $this->settingsRepository->getSettingsTrashed($item);

            return view('hotel.admin.orders.create', compact('item', 'settings', 'trashed'));
        }

        return view('hotel.admin.orders.create', compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $item = Order::create($request->all());

        if ($item) {
            return redirect()
                ->route('orders.edit', $item->id)
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, OrderRequest $request)
    {
        $settings = $this->settingsRepository->getAllSettings();

        if ($request->button == 'calculation') {
            $item = $this->calculationServices->calculation($request);
        } else {
            $item = $this->orderRepository->getOrder($id);
        }

        $trashed = $this->settingsRepository->getSettingsTrashed($item);

        return view('hotel.admin.orders.edit', compact('item', 'settings', 'trashed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $item = $this->orderRepository->getOrder($id);

        $result = $item->update($request->all());

        if ($result) {
            return redirect()
                ->route('orders.edit', $item->id)
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Order::destroy($id);

        if ($result) {
            return redirect()
                ->route('orders.index')
                ->with([
                    'message' => ['success' => "Запись id[$id] удалена"],
                ]);
        } else {
            return back()->withErrors(['message' => 'Ошибка удаления']);
        }
    }
}
