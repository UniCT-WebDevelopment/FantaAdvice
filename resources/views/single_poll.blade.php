<div class="flex p-4 border-b border-b-gray-400">
    <div class="mr-4 flex-shrink-0">
        <img src={{$poll->user->avatar}} class="rounded-full mr-2 w-10 h-10">
    </div>

    <div class="w-full">
        <div class="flex justify-between">
            <h5 class="font-bold text-blue-500 mb-8">{{$poll->user->name}}</h5>

            @if($poll->user_id == Auth()->user()->id ||Auth()->user()->is_super_admin == 1 )
            <form action="/polls/{{$poll->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <img src="https://i.ibb.co/jMR7RqQ/close.png" width="10" height="10">
                </button>
            </form>
            @endif

        </div>
        
            <form method="POST" action="/home/{{$poll->id}}/vote1" >
                @csrf
                <div class ="flex justify-between mt-6 mr-6">
                    <p class="font-bold text-gray-700 mb-8">{{$poll->player1}}</p>
                    <div class="flex">
                        
                    <button type="submit" class=" {{$poll->isVoted1By(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}} font-bold pb-4 "> {{$poll->voti1 ?: 0}}</button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-2 mb-2 w-8 {{$poll->isVoted1By(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}" width="30px" height="30px">
                            <g class="fill-current">
                                <path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"></path>
                            </g>
                        </svg>   
                    </div>        
                </div>
            </form>

        <form method="POST" action="/home/{{$poll->id}}/vote2" >
                
                @method('DELETE')
                @csrf
                <div class ="flex justify-between mt-6 mr-6">
                    <p class="font-bold text-gray-700 mb-8">{{$poll->player2}}</p>
                    <div class="flex">
                        <button type="submit" class="{{$poll->isVoted2By(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}} font-bold pb-4  ">{{$poll->voti2 ?: 0}}</button>  
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="ml-2 mb-2 w-8 {{$poll->isVoted2By(auth()->user()) ? 'text-blue-500' : 'text-gray-500'}}" width="30px" height="30px">
                            <g class="fill-current">
                                <path d="M10 3.22l-.61-.6a5.5 5.5 0 0 0-7.78 7.77L10 18.78l8.39-8.4a5.5 5.5 0 0 0-7.78-7.77l-.61.61z"></path>
                            </g>
                        </svg>
                    </div> 
                </div>
        </form>

        @if($poll->user_id == Auth()->user()->id && Auth()->user()->facebook_id)
            <form action="/publish/{{$poll->id}}" method="POST">
                @csrf
                <div class="flex justify-end mt-2">
                    <button type="submit" class="flex">
                        <span class="iconify" data-icon="raphael:slideshare" data-inline="false" style="color: #4299E1;" data-width="30px" data-height="30px"></span>
                        <p class="mt-1  text-blue-500  font-bold">Share on FB</p>
                    </button>
                </div>
                
            </form>
        @endif  
    </div>
    <hr class="mb-8">
    <div>

    </div>
</div>