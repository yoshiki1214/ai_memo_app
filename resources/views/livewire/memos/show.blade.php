<?php

use function Livewire\Volt\{state, mount};
use App\Models\Memo;

state(['memo' => null]);

mount(function (Memo $memo) {
    $this->memo = $memo;
});

$deleteMemo = function () {
    $this->memo->delete();
    $this->redirect(route('memos.index'));
};

?>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-4">{{ $memo->title }}</h1>
                <div class="text-sm text-gray-500 mb-4">
                    作成日: {{ $memo->created_at->format('Y年m月d日 H:i') }}
                </div>
                <div class="prose max-w-none mb-6">
                    {!! nl2br(e($memo->body)) !!}
                </div>
                <div class="flex justify-between items-center">
                    <div class="space-x-4">
                        <a href="{{ route('memos.edit', $memo) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                            編集
                        </a>
                        <button wire:click="deleteMemo" onclick="return confirm('本当に削除してもよろしいですか？')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500">
                            削除
                        </button>
                    </div>
                    <a href="{{ route('memos.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
