@props(['inputname'])

<div class="">
    <div>
        <label for="{{ $inputname }}" class="sr-only">{{ $inputname }}</label>
        <input {{ $attributes }} type="text"
               class="block w-full rounded-md border-0 py-2 px-4 ring-1 ring-inset  focus:ring-2 focus:ring-inset text-base sm:leading-6 font-open @error($inputname) text-red-900 ring-red-300 font-medium placeholder:text-red-500 focus:ring-red-500 @else text-zinc-800  font-medium ring-zinc-300 focus:ring-rawl-purple placeholder:text-zinc-400 @enderror"
               aria-invalid="true" aria-describedby="{ $inputname }}">
        <x-error field="{{ $inputname }}" class="mt-2 text-sm font-open text-red-500"/>
    </div>
</div>
