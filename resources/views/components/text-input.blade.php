<div class="relative">
    @if ('textarea' !== $type)
        @if ($formRef)
            <button class="absolute right-0 flex h-full items-center pr-2" type="button"
                @click="$refs['input-{{ $name }}'].value = ''; $refs['{{ $formRef }}'].submit()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
        <input x-ref="input-{{ $name }}" @class([
            'w-full text-sm rounded-md border-0 py-1.5 px-2.5 ring-1 placeholder:text-slate-400 focus:ring-2',
            'pr-8' => $formRef,
            'ring-slate-300' => !$errors->has($name),
            'ring-red-500' => $errors->has($name),
            'relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-slate-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-slate-500 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-slate-100 file:px-3 file:py-[0.32rem] file:text-slate-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none' =>
                $type === 'file',
        ]) type="{{ $type }}"
            name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}">
    @else
        <textarea id="{{ $name }}" name="{{ $name }}" @class([
            'w-full rounded-md border-0 py-1.5 px-2.5 text-sm ring-1 placeholder:text-slate-400 focus:ring-2',
            'pr-8' => $formRef,
            'ring-slate-300' => !$errors->has($name),
            'ring-red-300' => $errors->has($name),
        ])>{{ old($name, $value) }}</textarea>
    @endif
    @error($name)
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
