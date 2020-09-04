
<ul>
    <li>
        <div class="flex justify-center my-8">
            <img src="{{auth()->user()->avatar}}" alt="" class="rounded-full">
        </div>
        <p class="text-center font-bold text-gray-700 my-3 ">{{auth()->user()->name}}</p>
        
        <div class="flex justify-center">
            <p class="text-center font-bold my-3 mr-2">{{auth()->user()->credits}} </p>
            <img src="https://i.ibb.co/GRVFmbn/coin.png" alt="" class="rounded-full  w-10 h-10">
        </div>
        <div class="flex-col ml-6 text-lg">
            
        
            <hr class="mt-3 mb-3">

            <a  href="{{ route('logout') }}" 
                class="font-bold text-gray-700 no-underline"
                onclick="event.preventDefault();
                document.getElementById('logout-button').submit();">
                {{ __('Logout') }}
            </a>

            
            <form id="logout-button" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>
    
    </li>
</ul>