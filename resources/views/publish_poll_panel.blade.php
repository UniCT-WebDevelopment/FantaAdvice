<div class="flex-1 ">
            <div class="border border-blue-400 rounded-lg py-3 px-8 mb-8">
                <h1 class="font-bold text-lg text-blue-500">Ask your question to the FantaAdvice community</h1>
                <form action="/polls" method="POST">
                    @csrf
                    <div class="inline relative w-50 m-2">
                        <select name="player1_selected" id="player1_selected" class=" font-bold text-gray-700 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline ">
                            <option disabled selected> SELECT PLAYER 1</option>
                            @foreach ($players as $player)
                                <option>{{$player->name}}</option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="inline relative w-50 m-2">
                        <select name="player2_selected" id="player2_selected" class="font-bold text-gray-700 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option disabled selected> SELECT PLAYER 2</option>
                            @foreach ($players as $player)
                                <option>{{$player->name}}</option>    
                            @endforeach
                            
                        </select>
                    </div>

                    <hr class="my-2">

                    <footer class="flex justify-between">
                        <img src="{{auth()->user()->avatar}}" class="rounded-full mr-2 w-10 h-10">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" type="submit">Create poll</button>
                    </footer>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="font-bold" >{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('successo'))
                    <div class="alert alert-success mt-2">
                        {{ session('successo') }}
                    </div>
                @endif
                @if (session('errore'))
                <div class="alert alert-warning  mt-2">
                    {{ session('errore') }}
                </div>
            @endif    
            </div>
        </div>