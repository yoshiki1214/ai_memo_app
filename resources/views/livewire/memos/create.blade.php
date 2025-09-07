<?php

use function Livewire\Volt\{state, rules, computed};
use App\Models\Memo;

state([
    'title' => '',
    'body' => '',
]);

rules([
    'title' => ['required', 'string', 'max:50'],
    'body' => ['required', 'string', 'max:2000'],
]);

$save = function () {
    $validated = $this->validate();

    $memo = new Memo();
    $memo->user_id = auth()->id();
    $memo->title = $validated['title'];
    $memo->body = $validated['body'];
    $memo->save();

    $this->redirect(route('memos.show', $memo));
};

?>

<div>
    <div class="space-y-12 sm:space-y-16">
        <div>
            <h2 class="text-base font-semibold leading-7 text-gray-900">
                新規メモ作成
            </h2>
            <p class="mt-1 text-sm leading-6 text-gray-500">
                メモのタイトルと本文を入力してください。
            </p>

            <form wire:submit="save" class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-10">
                <div class="sm:col-span-4">
                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">
                        タイトル
                    </label>
                    <div class="mt-2">
                        <input type="text" id="title" wire:model="title"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="body" class="block text-sm font-medium leading-6 text-gray-900">
                        本文
                    </label>
                    <div class="mt-2">
                        <textarea id="body" wire:model="body" rows="10"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        @error('body')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('memos.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        キャンセル
                    </a>
                    <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
