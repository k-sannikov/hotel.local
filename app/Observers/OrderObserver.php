<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SettingsRepository;

class OrderObserver
{
    /**
     * @var SettingsRepository
     */
    private $settingsRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepository::class);
    }

    /**
     * Обработка ПЕРЕД созданием записи
     *
     * @param Order $order
     **/
    public function creating(Order $order)
    {
        //получение и назначение стоимости номера
        $order->room_cost = $this->settingsRepository->getRoomCost(request()->room_type);
        //назначение имени администратора создающего запись
        $order->admin_name = Auth::user()->name;
        //если поле услуг пустое, назначить услугам пустой массив
        if (!isset(request()->amenities)) {
            $order->amenities = [];
        }
    }

    /**
     * Обработка ПЕРЕД обновлением записи
     *
     * @param Order $order
     **/
    public function updating(Order $order)
    {
        //получение и назначение стоимости номера
        $order->room_cost = $this->settingsRepository->getRoomCost(request()->room_type);
        //назначение имени администратора создающего запись
        $order->admin_name = Auth::user()->name;
        //если поле услуг пустое, назначить услугам пустой массив
        if (!isset(request()->amenities)) {
            $order->amenities = [];
        }
    }

}
