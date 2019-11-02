<?php
namespace App\Repositories;

use App\Models\Order as Model;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class OrderRepository extends CoreRepository
{
    /**
     * @return string
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить список гостей для вывода пагинатором
     *
     * @param integer|null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */

    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'guest_name', 'date_of_arrival', 'date_of_departure', 'total_cost'];
        $result = $this->startConditions()
            ->paginate($perPage, $columns);

        return $result;
    }

    /**
     * Получить экземпляр модели для редактирования/вывода на страницу
     *
     * @param integer id заказа
     *
     */

    public function getOrder($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }

    /**
     * Получить экземпляр модели для редактирования/вывода на страницу
     *
     * @param object $request данные из формы
     *
     */

    public function getSumOrder($request)
    {
        $result = $this->startConditions()
            ->where('hotel_name', $request->hotel_name)
            ->where('date_of_arrival', '>=', $request->beginning)
            ->where('date_of_departure', '<=', $request->end)
            ->sum('total_cost');

        return $result;
    }
}
