<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $evento->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200">
                        <h4 class="font-bold text-lg mb-4 text-gray-700">💬 Faça sua Pergunta</h4>
                        
                        <form action="{{ route('eventos.perguntas.store', $evento->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="texto" class="block text-sm font-medium text-gray-700 mb-2">Texto da Pergunta</label>

                                <textarea name="texto" id="texto" rows="4" 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('texto') border-red-500 ring-red-500 @enderror"
                                    placeholder="Digite sua dúvida ou comentário para o palestrante...">{{ old('texto') }}</textarea>

                                @error('texto')
                                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold transition duration-150">
                                Enviar Pergunta
                            </button>
                        </form>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-bold text-lg text-gray-700 m-0">📋 Perguntas do Evento</h4>
                            <span class="text-gray-500 text-sm">Total visíveis: {{ $perguntas->total() ?? count($perguntas) }}</span>
                        </div>

                        <div class="space-y-4">
                            @forelse($perguntas as $pergunta)
                                <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-blue-500 mb-4">
                                    <p class="text-gray-800 text-base mb-3">{{ $pergunta->texto }}</p>
                                    
                                    <div class="flex justify-between items-center text-xs text-gray-500 border-t pt-2">
                                        <span class="font-medium text-indigo-600">
                                            Enviado por: {{ $pergunta->user->name ?? 'Anônimo' }}
                                        </span>
                                        <span>{{ $pergunta->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="bg-gray-50 text-center p-6 rounded-lg text-gray-500">
                                    Nenhuma pergunta enviada ainda. Seja o primeiro!
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-6">
                            {{ $perguntas->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>