<div class="min-h-screen bg-gray-100" x-data="{open : false}">


    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="p-8 ">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                                MagicFill
                            </h2>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="first_name"
                                    class="block text-sm font-medium leading-5 text-gray-700">Toleranz</label>
                                <input wire:model="tolerance" type="number"
                                    class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Replace with your content -->

                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white px-4 py-8">
                        <form wire:submit.prevent="save">
                            <h1 class="text-xl font-bold leading-tight text-gray-900 mb-3 flex items-center">
                                Original
                                <div wire:loading wire:target="photo">
                                    <svg class="animate-spin ml-3 mr-3 h-5 w-5 text-indigo-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>

                                </div>
                            </h1>

                            @if ($resizedPhoto)
                            <div x-ref="container"><img style="width:500px"
                                    x-on:click="$wire.magicwand($event.pageX - $refs.container.offsetLeft, $event.pageY - $refs.container.offsetTop)"
                                    src="{{ asset($resizedPhoto) }}">
                            </div>
                            @endif

                            <input type="file" wire:model="photo" class="my-3">

                            @error('photo') <span class="error">{{ $message }}</span> @enderror
                            <br>

                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                Bild hochladen
                            </button>
                        </form>


                    </div>
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white px-4 py-8">
                        <h1 class="text-xl font-bold leading-tight text-gray-900 mb-3 flex items-center">
                            Ergebnis
                            <div wire:loading>
                                <svg class="animate-spin ml-3 mr-3 h-5 w-5 text-indigo-500"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                            </div>
                        </h1>

                        @if($resultPhoto)
                        <a target="_blank" href="{{ asset($resultPhoto) }}"><img style="width:500px"
                                src="{{ asset($resultPhoto) }}"></a>
                        @endif
                    </div>

                </div>


                <!-- /End replace -->
            </div>
        </main>
    </div>
</div>
