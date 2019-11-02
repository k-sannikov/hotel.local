<?php

namespace App\Services;

use App\Repositories\SettingsRepository;
use Carbon\Carbon;

class CalculationServices
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
     * Расчет стоимости проживания в отеле
     *
     * @param Request $request
     *
     * @return views
     **/
    public function calculation($request)
    {
        //кол-во дней пребывания
        $daysOfStay = Carbon::parse($request->date_of_arrival)
            ->DiffInDays($request->date_of_departure);

        // значение услуги если не выбрал пользователь
        if (!isset($request->amenities)) {
            $request->amenities = [];
        }

        //кол-во дней пребывания (если меньше суток)
        if ($daysOfStay < 1) {
            $daysOfStay = 1;
        }

        // стоимость номера (сутки)
        $request->room_cost = $this->settingsRepository->getRoomCost($request->room_type);

        //суммарная стоимость услуг
        $costAmenities = 0;
        foreach ($request->amenities as $amenitie) {
            $costAmenities += $amenitie;
        }

        // сумма скидки
        $request->amount_discounts =
            round($request->room_cost * $daysOfStay * ($request->percent_discounts / 100), 2);

        //финальная стоимость
        $request->total_cost =
            $request->room_cost * $daysOfStay - $request->amount_discounts + $costAmenities * $daysOfStay;

        return $request;
    }
}
