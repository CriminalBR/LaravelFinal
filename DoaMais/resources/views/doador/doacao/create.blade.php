<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fazer uma Nova Doação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('doador.doacao.store') }}">
                        @csrf

                        <!-- Selecionar Instituição -->
                        <div>
                            <x-input-label for="instituicao_id" :value="__('Para qual instituição você quer doar?')" />
                            <select id="instituicao_id" name="instituicao_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Selecione uma instituição --</option>
                                @foreach ($instituicoes as $instituicao)
                                    <option value="{{ $instituicao->id }}" {{ old('instituicao_id') == $instituicao->id ? 'selected' : '' }}>
                                        {{ $instituicao->user->name }} <!-- Mostra o nome do User associado -->
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('instituicao_id')" class="mt-2" />
                        </div>

                        <!-- Descrição do Item -->
                        <div class="mt-4">
                            <x-input-label for="descricao_item" :value="__('O que você vai doar?')" />
                            <x-text-input id="descricao_item" class="block mt-1 w-full" type="text" name="descricao_item" :value="old('descricao_item')" required placeholder="Ex: Cesta básica, 5 casacos, 10kg de arroz" />
                            <x-input-error :messages="$errors->get('descricao_item')" class="mt-2" />
                        </div>

                        <!-- Quantidade -->
                        <div class="mt-4">
                            <x-input-label for="quantidade" :value="__('Quantidade (unidades)')" />
                            <x-text-input id="quantidade" class="block mt-1 w-full" type="number" name="quantidade" :value="old('quantidade')" required min="1" />
                            <x-input-error :messages="$errors->get('quantidade')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Registrar Doação') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>