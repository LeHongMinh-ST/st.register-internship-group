<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\GroupKey;
use Illuminate\Http\Request;

class EditGroupController extends Controller
{
    public function index(string $key)
    {
        $groupKey = GroupKey::query()->where('key', $key)->firstOrFail();

        $firstKey = GroupKey::query()
            ->where('group_id', $groupKey->group_id)
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$firstKey && $firstKey?->key != $key) {
            abort(419);
        }

        if (!$groupKey->active) {
            abort(419);
        }

        if ($groupKey->isExpired()) {
            abort(419);
        }

        return view('pages.client.edit-group', [
            'key' => $key,
        ]);
    }
}
