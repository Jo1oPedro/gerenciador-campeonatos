<div>

    <div class="flex flex-col md:table-fixed card ">
        <div class="overflow-x-auto">
            <div class="py-2 inline-block sm:px-2 lg:px-2">
                <div class="overflow-x-auto">
                    <table class=" text-center text-lg cursor-pointer">
                        <thead class="border-b bg-white">
                            <tr>
                            <th scope="col" class="text-lg font-medium text-gray-900">
                                #
                            </th>
                            <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                Nome
                            </th>
                            <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                Jogo
                            </th>
                            <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                Inicio
                            </th>
                            <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                Encerramento
                            </th>
                            <th scope="col" class="font-medium text-gray-900 px-6 py-4">
                                Ação
                            </th>
                        </thead>
                        <tbody>
                            @foreach($campeonatos as $key => $campeonato)
                                <tr class="bg-white border-b transition durante-300 ease-in-out hover:bg-gray-100 hover:scale-105">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $key+1 }}</td>
                                    <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $campeonato->nome }}
                                    </td>
                                    <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $campeonato->time1 }} VS {{ $campeonato->time2 }}
                                    </td>
                                    <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $campeonato->inicio }}
                                    </td>
                                    <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        {{ $campeonato->encerramento }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>  


