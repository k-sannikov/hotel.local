<?php

namespace App\Http\Controllers\Hotel\Admin\Settings;

use App\Http\Controllers\Hotel\Admin\BaseController as AdminController;
use App\Http\Requests\Settings\BaseRequest as SettingsRequest;
use App\Models\Settings;
use App\Models\User;
use App\Repositories\SettingsRepository;
use App\Repositories\UserRepository;

class SettingsController extends AdminController
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->settingsRepository = app(SettingsRepository::class);
        $this->userRepository = app(UserRepository::class);
    }

    public function index()
    {
        $settings = $this->settingsRepository->getAllSettings();

        $settings['users'] = $this->userRepository->getAllUsers();

        foreach ($settings as $key => $value) {
            if (is_null($value)) {
                $settings[$key] = [];
            }
        }

        return view('hotel.admin.settings.index', compact('settings'));
    }

    public function store(SettingsRequest $request)
    {
        $item = Settings::create($request->all());

        if ($item) {
            return redirect()
                ->route('admin.settings.index')
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $item = $this->settingsRepository->getSetting($id);

        return view('hotel.admin.settings.edit', compact('item'));
    }

    public function update(SettingsRequest $request, $id)
    {
        $item = $this->settingsRepository->getSetting($id);

        $result = $item->update($request->all());

        if ($result) {
            return redirect()
                ->route('admin.settings.index')
                ->with(['message' => ['success' => 'Успешно сохранено']]);
        } else {
            return back()
                ->withErrors(['message' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $result = Settings::destroy($id);

        if ($result) {
            return redirect()
                ->route('admin.settings.index')
                ->with([
                    'message' => ['success' => "Запись id[$id] удалена"],
                ]);
        } else {
            return back()->withErrors(['message' => 'Ошибка удаления']);
        }
    }
}
