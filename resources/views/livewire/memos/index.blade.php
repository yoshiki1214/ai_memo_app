<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state([
    'memos' => fn() => Memo::where('user_id', auth()->id())
        ->latest()
        ->get(),
]);

?>

<div>
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">メモ一覧</h1>
            <a href="{{ route('memos.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                新規メモ作成
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if ($memos->isEmpty())
                    <p class="text-center text-gray-500">メモがありません</p>
                @else
                    <div class="space-y-4">
                        @foreach ($memos as $memo)
                            <a href="{{ route('memos.show', $memo) }}"
                                class="block p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                <h2 class="text-lg font-medium text-gray-900">{{ $memo->title }}</h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    作成日: {{ $memo->created_at->format('Y年m月d日') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
