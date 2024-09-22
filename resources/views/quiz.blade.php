<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>

    <body>

    <div id="content">
        <form class="card col-8 mx-auto mt-5">
       
         <div class="card-header">
            <h4 style="color:#24ADF3; display: inline-block">TechQuiz | </h4> 
            <h5 id="category" style="display: inline-block;" data-category="{{ $category }}"> {{ $category }}</h5>

            <h6 id="timer" style="display: inline-block; float: right">
              Time left: &nbsp;
              <span id="minutes">{{$pages/2}}</span>
              minute(s) and
              <span id="seconds" >00</span>
              second(s)
            </h6>
         </div>

         <div class="card-body">
           <h5 class="card-title" id="question" >{{$quiz['question']}}</h5>
          
           <ul class="list-group" id="choices" data-count="{{ $quiz['correctChoicesCount'] }}">
            @php $i=1; @endphp
            @foreach($quiz['choice'] as $choice)
              <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="{{$choice}}" id="checkbox{{ $i }}">
                <label id="option{{ $i }}">{{$choice}}</label>
              </li>
              @php $i++; @endphp
            @endforeach  
            </ul>
            
            <ul id="pages" class="pagination mt-2 float-start" data-pages="{{ $pages}}">
              @for($p=1; $p<= $pages; $p++)
                <li id='page{{$p}}' class="page-item @if($p==1) active @endif"><button onclick = "fetchQuiz({{$p}})" class="page-link" type="button">{{ $p }}</button></li>
              @endfor
            </ul>
                
           <button class="btn btn-primary mt-2 float-end" id="submitBtn" type="button">Submit</button>

         </div>
        </form>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     </body>
</html>