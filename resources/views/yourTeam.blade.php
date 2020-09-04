<h3 class = "font-bold text-lg text-blue-500 text-center">Your Team</h3>

<ul>
    @foreach($players as $player)
    <li class="my-3  ">
    <form action="/player/{{$player->id}}" method="POST"> 
            @csrf
            @method('DELETE')   
            <button type="submit">
                <img src="https://i.ibb.co/JmQrvXk/delete.png" class="h-8 w-8 absolute">
            </button>
        </form>

        <img src="{{$player->img}}"  class="img-thumbnail mx-12" style="height: 200px">
        <div class="  font-bold text-gray-700">
            <p class=" bg-blue-300 bg-opacity-25 rounded font-bold  text-center my-2 pt-1 ">{{$player->name}} ({{$player->role}})</p>
            <p class="  bg-blue-300 bg-opacity-25 rounded font-bold  text-center my-2 pt-1">{{$player->club}}</p>
            <p class=" bg-blue-300 bg-opacity-25 rounded font-bold  text-center my-2 pb-1">Last Score {{$player->last_score}}</p>
        </div>
        <hr>
    </li>
    @endforeach
</ul>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Start by entering your team
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" >Insert Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                        <form action="/home/insertPlayer" method="POST" autocomplete="off">
                            @csrf
                            <input type="text" name="player_name" id="player_name" class=" uppercasetypeahead form-control" placeholder="Enter player name" />
                            <div class="dropdown" id="playerList"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Player</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
      <script type="text/javascript">
            $(document).ready(function(){
                $('#player_name').keyup(function(){ 
                    var query = $(this).val();
                    if(query != ''){
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url:"{{ route('home.fetch') }}",
                            method:"POST",
                            data:{query:query, _token:_token},
                            success:function(data){
                                $('#playerList').fadeIn();  
                                $('#playerList').html(data);
                            }
                        });
                    }
                });
                $(document).on('click', 'li', function(){  
                    $('#player_name').val($(this).text());  
                    $('#playerList').fadeOut();  
                });  
            });
      </script>

